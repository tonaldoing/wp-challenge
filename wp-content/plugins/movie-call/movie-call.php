<?php
/**
* Plugin Name: Movie call
* Description: Plugin for WP Challenge.
* Author: Tomás Vilas
* Version: 0.1.0
* Author URI: http://tomasvilas.com.ar
*/

defined( 'ASBATH' );

// Create Shortcode:

add_shortcode('movie-call', 'movie_call_shortcode' );

function movie_call_shortcode() {
	?>
	<h1 class="home-title">Upcoming Movies</h1>
		<div id="movie-upcoming-list">

		</div>
	<?php
	// Write AJAX to show in the shortcode

	wp_enqueue_script( 'movie-call-scripts', plugins_url('assets/js/script.js', __FILE__), ['jquery'], '0.1.0', true );

}

// Create new endpoint:

add_action('rest_api_init', 'movie_call_endpoint');

function movie_call_endpoint() {
	register_rest_route(
		'moviecall',
		'rest-ajax',
		[
			'methods' => 'GET',
			'permission_callback' => '__return_true',
			'callback' => 'movie_call_callback'
		]
	);
}

// REST Endpoint information:

function movie_call_callback() {

	$data = '';

	$page = '20';

	$response = wp_remote_get('https://api.themoviedb.org/3/movie/upcoming?api_key=9a77c1427cc1c348d26f500358efa62b&language=en-US?per_page=10'); 
	$response = wp_remote_retrieve_body($response);
	$response = json_decode($response);

	return $response;

}
