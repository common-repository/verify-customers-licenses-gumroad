<?php 

if ( ! function_exists( 'vclg_settings_init' ) ) {

    function vclg_settings_init() {

        // Create sections
        add_settings_section('vclg-general-options', 'API Authentication', 'vclg_general_options', 'vclg-options-page');

        // register settings
        register_setting( 'vclg-settings-group', 'vclg_secret_token', 'vclg_secret_token_sanitize_handler' );
        register_setting( 'vclg-settings-group', 'vclg_disable_styles' );

        // register fields
        add_settings_field('vclg-secret-token', 'Access Token', 'vclg_secret_token_field', 'vclg-options-page', 'vclg-general-options');
        add_settings_field('vclg-disable-styles', 'Disable Styles?', 'vclg_disable_styles_field', 'vclg-options-page', 'vclg-general-options');

    }

}

// Section: Options
function vclg_general_options () {}

// Field: Access Token Sanitize
function vclg_secret_token_sanitize_handler( $input ) {
    $output = sanitize_text_field( $input );
    return $output;
}

// Field: Access Token
function vclg_secret_token_field() {
    $value = esc_attr( get_option('vclg_secret_token') );
    echo '<input class="widefat" type="text" id="vclg_secret_token" name="vclg_secret_token" value="' . esc_attr( $value ) . '"/>';
    echo '<p>The API key for connecting with your Gumroad account. <a href="https://gumroad.com/settings/advanced#application-form" target="_blank">Get your API key here</a>.</p>';
}

// Field: Access Token
function vclg_disable_styles_field() {
    $value = esc_attr( get_option('vclg_disable_styles') );
    echo '<input type="checkbox" id="vclg_disable_styles" name="vclg_disable_styles" ' . ( esc_attr( $value ) ? "checked" : "" ) . '/>';
}