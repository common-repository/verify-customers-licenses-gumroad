<?php
/**
 * Register custom shortcode
 */
add_shortcode('vclg_form', 'vclg_form_shortcode');

if ( shortcode_exists('vclg_form') ) {
    function vclg_form_shortcode( $atts, $content = "") {

        // check if the user is an admin
        if( current_user_can('administrator') ) {

            // output verify customers license form on frontend only
            if ( ! is_admin() ) 
            require VCLG_LOCATION . '/frontend/view.php';

        } else {

            echo '<p>You must be <a href="' . esc_url( wp_login_url( get_permalink() ) ) . '"><u>logged</u></a> in as an administrator to be able to verify the licenses of your customers.</p>';

        }

    }
}