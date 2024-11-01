<?php 

/**
 * a function for adding an admin menu options page.
 */

add_action( 'admin_menu', 'vclg_options_page_add_menu' );

if ( ! function_exists( 'vclg_options_page_add_menu' ) ) {

    function vclg_options_page_add_menu() {

        add_action( 'admin_init', 'vclg_settings_init' );

        add_menu_page(
            'Verify Customers Licenses for Gumroad',
            'VCLG Options',
            'manage_options',
            'vclg-options-page',
            'vclg_options_page_content',
            'dashicons-yes-alt',
            30
        );

    }

}