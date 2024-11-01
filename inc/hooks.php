<?php
/**
 * Register options page
 * 
 * @return array    An array of options page for plugin.
 */

add_filter('vclg_options_page', 'vclg_options_page_content');

if ( ! function_exists( 'vclg_options_page_content' ) ) {
    function vclg_options_page_content() {
        
        // check user capabilities
        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }

        // include options page html markup
        require VCLG_LOCATION . '/admin/view.php';

    }
}