<?php
/**
 * 
 *
 */

function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; 
   
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
    get_stylesheet_directory_uri() . '/style.css',
    array( $parent_style ),
    wp_get_theme()->get('Version')
    );

   }
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


add_action('init', 'add_genres_type');
function add_genres_type(){
	register_post_type('genres', [
		'label' => 'Genres',
		'public' => true,
		'capability_type' => 'post'
	]);
}

add_action('init', 'add_movies_type');
function add_movies_type(){
	register_post_type('movies', [
		'label' => 'Movies',
		'public' => true,
		'capability_type' => 'post'
	]);
}

/**
 * This function modifies the main WordPress query to include an array of 
 * post types instead of the default 'post' post type.
 *
 * @param object $query The main WordPress query.
 */
function tg_include_custom_post_types_in_search_results( $query ) {
    if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
        $query->set( 'post_type', array( 'movies' ) );
    }
}
add_action( 'pre_get_posts', 'tg_include_custom_post_types_in_search_results' );

add_action('wp_ajax_nopriv_get_movies', 'get_movies');
add_action('wp_ajax_get_movies', 'get_movies');
function get_movies(){

	$file = get_stylesheet_directory() . 'report-new.txt';
	$current_movie = ( ! empty($_POST['current_movie']) ) ? $_POST['current_movie'] : 63;
	$movies = [];

	$movie_results = wp_remote_retrieve_body( wp_remote_get('https://api.themoviedb.org/3/movie/'. $current_movie .'?api_key=9a77c1427cc1c348d26f500358efa62b&language=en-US') );

	file_put_contents($file, "Current movie: " . $current_movie . "\n\n", FILE_APPEND);
	$movie_results = json_decode($movie_results);

	if ( $current_movie > 996 ){
	 return false;
 	} 

    $movies[] = $movie_results;


    foreach ( $movies as $movie ){

        $movie_slug = sanitize_title($movie->title . ' - ' . $movie->id);
        
        $inserted_movie = wp_insert_post([
            'post_name' => $movie_slug,
            'post_title' => $movie_slug,
            'post_type' => 'movies',
            'post_status' => 'publish'
        ]);

        if (is_wp_error( $inserted_movie )) {
            continue;
        }

        $fillable = [
            'field_61a97dad561fa' => 'title',
            'field_61a9886a88410' => 'poster_path',
            'field_61a9887b88411' => 'genres',
            'field_61a9889888413' => 'overview',
            'field_61a988bb88414' => 'production_companies',
            'field_61a988c688415' => 'release_date',
            'field_61a988cd88416' => 'original_language',
            'field_61a988da88418' => 'popularity',
            'field_61aa2324a93c3' => 'id'
        ];

        foreach( $fillable as $key => $title ) {
            update_field( $key, $movie->$title, $inserted_movie );
        }

    }
    
	$current_movie = $current_movie + 1;
	wp_remote_post( admin_url('admin-ajax.php?action=get_movies'), [
		'blocking' => false,
		'sslverify' => false,
		'body' => [
			'current_movie' => $current_movie
		    ]
	    ] 
    );


}

add_action('wp_ajax_nopriv_get_genres', 'get_genres');
add_action('wp_ajax_get_genres', 'get_genres');
function get_genres(){

	$file = get_stylesheet_directory() . 'report.txt';
	$current_genre = ( ! empty($_POST['current_genre']) ) ? $_POST['current_genre'] : 1;
	$genres = [];

	$genre_results = wp_remote_retrieve_body( wp_remote_get('https://api.themoviedb.org/3/genre/movie/list?api_key=9a77c1427cc1c348d26f500358efa62b&language=en-US') );

	file_put_contents($file, "Current Genre: " . $current_genre . "\n\n", FILE_APPEND);

	$genre_results = json_decode($genre_results);

	if ( $current_genre > 1 ){
	 return false;
 	} 

    foreach ( $genre_results->genres as $genre ){

        $genre_slug = sanitize_title($genre->name . ' - ' . $genre->id);

        
            $inserted_genre = wp_insert_post([
                'post_name' => $genre_slug,
                'post_title' => $genre_slug,
                'post_type' => 'genres',
                'post_status' => 'publish'
            ]);
    
            if (is_wp_error( $inserted_genre )) {
                continue;
            }
    
            $fillable = [
                'field_61aa6b10de53f' => 'id',
                'field_61aa6b16de540' => 'name',
            ];
    
            foreach( $fillable as $key => $title ) {
                update_field( $key, $genre->$title, $inserted_genre );
            }

    }
    
	$current_genre = $current_genre + 1;
	wp_remote_post( admin_url('admin-ajax.php?action=get_genres'), [
		'blocking' => false,
		'sslverify' => false,
		'body' => [
			'current_genre' => $current_genre
		]
	] 
    );

}

// Custom Search Form
function html5_search_form( $form ) { 
    $form = '<section class="search"><form role="search" method="get" id="search-form" action="' . home_url( '/' ) . '" >
   <label class="screen-reader-text" for="s">' . __('',  'domain') . '</label>
    <input id="the7-search" type="search" value="' . get_search_query() . '" name="s" id="s" placeholder="Search for movie or actor" />
    <input type="submit" id="searchsubmit" value="Find" />
    </form></section>';
    return $form;
  }
  
  add_filter( 'get_search_form', 'html5_search_form' );
  