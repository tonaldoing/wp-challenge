<?php
/**
* Plugin Name: actor call
* Description: Plugin for WP Challenge.
* Author: Tomás Vilas
* Version: 0.1.0
* Author URI: http://tomasvilas.com.ar
*/

defined( 'ASBATH' );

// Create Shortcode:

add_shortcode('actor-call', 'actor_call_shortcode' );

function actor_call_shortcode() {
	?>
	<h1 class="home-title">TOP 10 - Most popular Actors</h1>
	 <div id="actor-list">

	 </div>
	<?php
	// Write AJAX to show in the shortcode

	wp_enqueue_script( 'actor-call-scripts', plugins_url('assets/js/script.js', __FILE__), ['jquery'], '0.1.0', true );

}

// Create new endpoint:

add_action('rest_api_init', 'actor_call_endpoint');

function actor_call_endpoint() {
	register_rest_route(
		'actorcall',
		'rest-ajax',
		[
			'methods' => 'GET',
			'permission_callback' => '__return_true',
			'callback' => 'actor_call_callback'
		]
	);
}

// REST Endpoint information:

function actor_call_callback() {

	$data = '';

	$response = wp_remote_get('https://api.themoviedb.org/3/person/popular?api_key=9a77c1427cc1c348d26f500358efa62b&language=en-US&page=1'); 
	$response = wp_remote_retrieve_body($response);
	$response = json_decode($response);

	return $response;

}
