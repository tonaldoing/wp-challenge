<?php
/**
 * The template for displaying all pages.
 *
 * Template name: Movies
 */

get_header(); 

$movie_args = array(
  'numberposts' => 10,
  'post_type'   => 'movies',
  'fields' => 'ids'
);
$movies = get_posts($movie_args);

?>
<section class="movies-section">
<?php
foreach ($movies as $movie) {
    $fields = get_fields($movie);
	//var_dump($fields);
	if( $fields ): ?>
		<ul>
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
					foreach ($value as $obj) {
						$name = $obj->logo_path;
				
						$html  = "<li class='production_companies'>";
						$html .=    "$name";
						$html .= "</li>";
						echo $html;
					}
				  }
				else{?>
				<li class="<?php echo $name; ?>"><?php echo $value; ?></li>
			<?php }
			endforeach; ?>
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
    let path = $('.poster');
    $('.id').hide();
	path.each(function() {
		new_html = 'https://image.tmdb.org/t/p/w500' + $( this ).html();
		$( this ).html('<img src="'+new_html+'" alt=""/>')
	});
});
</script>



