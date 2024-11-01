<?php

add_action( 'wp_ajax_vclg_action', 'vclg_http_api_callback' ); // wp_ajax_{action} for registered user
add_action( 'wp_ajax_nopriv_vclg_action', 'vclg_http_api_callback' ); // wp_ajax_nopriv_{action} for not registered users

function vclg_http_api_callback(){

	// check ajax nonce
	check_ajax_referer('vclg_nonce');

	// validate and sanitize data inputs
	if ( isset($_POST['permalink']) ) {
		$product_permalink = sanitize_text_field( $_POST['permalink'] );
	}
	if ( isset($_POST['key']) ) {
		$license_key = sanitize_text_field( $_POST['key'] );
	}

	// Gumroad API url, endpoints and get access token option
	$auth = get_option('vclg_secret_token');
	$url = 'https://api.gumroad.com/v2/licenses/verify?product_permalink=' . esc_attr( $product_permalink ) . '&license_key=' . esc_attr( $license_key );
	
	// WP HTTP API post call
	$args = array(
		'method' => 'POST',
		'headers' => array(
			'access_token' => $auth,
		),
	);
	
	$response = wp_remote_post($url, $args);
	$response = json_encode($response);

	// print response with json encoded
	echo $response;
	
	die();
}