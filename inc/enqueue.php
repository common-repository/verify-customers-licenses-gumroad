<?php 

/**
 * Enqueue Styles and Scripts for admin options page.
 */
if ( ! function_exists( 'vclg_admin_enqueue' ) ) {
	
	add_action( 'admin_enqueue_scripts', 'vclg_admin_enqueue' );

	function vclg_admin_enqueue() {
		wp_enqueue_style( 'vclg-admin', VCLG_ADMIN_URL . '/css/admin.css' );
		wp_enqueue_script( 'vclg-admin', VCLG_ADMIN_URL . '/js/admin.js', array( 'jquery' ), '', true );
	}

}

/**
 * Enqueue Styles and Scripts for frontend submission.
 */
if ( ! function_exists( 'vclg_frontend_enqueue' ) ) {

	add_action( 'wp_enqueue_scripts', 'vclg_frontend_enqueue' );

	function vclg_frontend_enqueue() {

		// enqueue plugin's frontend style
		if ( ! get_option('vclg_disable_styles') )
			wp_enqueue_style( 'vclg-front-app', VCLG_FRONTEND_URL . '/css/app.css' );

		// register plugin's frontend script
		wp_register_script( 'vclg_scripts', VCLG_FRONTEND_URL . '/js/app.js', array( 'jquery' ), '', true );
		
		// register WordPress AJAX file via wp_localize_script() function
		wp_localize_script( 'vclg_scripts', 'vclg_callback_params', array(
			'ajaxurl'	=> site_url() . '/wp-admin/admin-ajax.php',
			'nonce'		=> wp_create_nonce( 'vclg_nonce' ),
		) );
		
		// enqueue plugin's scripts files
		wp_enqueue_script( 'vclg_scripts' );

	}

}