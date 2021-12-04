<?php
/**
 * The template for displaying all pages.
 *
 * Template name: Movies
 */

get_header(); 


$args = array( 'post_type'=>'movies', 'numberposts' => -1, 'orderby'=> 'title', 'order' => 'ASC' );
$movies = get_posts($args);

?>

<?php get_search_form(); ?>
<section class="movies-section">
<?php
get_search_form( $echo );
foreach ($movies as $movie) {
	$url = $movie->post_title;
    $fields = get_fields($movie);
	if( $fields ): ?>
		<ul>
			<a href= '../movies/<?php echo $url?>'>
			<?php foreach( $fields as $name => $value ): 
				if ($name == 'genre') {
					foreach ($value as $obj) {
						$name = $obj->name;
				
						$html  = "<li class='genre'>";
						$html .=    "$name";
						$html .= "</li>";
						echo $html;
					}
				  }
				  else if ($name == 'production_companies') {
					foreach ($value as $companie) {
						$logo_path = $companie->logo_path;
						$companie_name = $companie->name;

						if($logo_path != ''){
							
							$html  = "<li class='production_companies'>";
							$html .=    "<img src='";
							$html .= "https://image.tmdb.org/t/p/w500";
							$html .= $logo_path;
							$html .= "'/>";
							$html .= "</li>";
							echo $html;

						}else {

							$html  = "<li class='production_companies'>";
							$html .=   "<p>";
							$html .=   $companie_name;
							$html .=   "</p>";
							$html .= "</li>";
							echo $html;

						}
						
					}
				  }
				  else if ($name == 'poster') {
							
					$html  = "<li class='poster'>";
					$html .=    "<img src='";
					$html .= "https://image.tmdb.org/t/p/w500";
					$html .= $value;
					$html .= "'/>";
					$html .= "</li>";
					echo $html;

				  }
				  else if ($name == 'id') {
							
					echo '';

				  }
				else{?>
				<li class="<?php echo $name; ?>"><?php echo $value; ?></li>
			<?php }
			endforeach; ?>
			</a>
		</ul>
	<?php endif;
}

?>

</section>

<?php
get_footer(); 
?>
<script>
jQuery(document).ready(function($){
    let lang = $('.original_language');
	lang.each(function() {
		$( this ).prepend("<small>Original Language: </small>");
	});
    let popularity = $('.popularity');
	popularity.each(function() {
		$( this ).prepend("<small>Popularity: </small>");
	});
    let release_date = $('.release_date');
	release_date.each(function() {
		$( this ).prepend("<small>Release Date: </small>");
	});
});
</script>



