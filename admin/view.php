<div id="vclg_admin_page_options" class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <?php settings_errors(); ?>
    <form action="options.php" method="post">

        <?php
        // output security fields for the registered setting
        settings_fields( 'vclg-settings-group' ); ?>

        <div class="row">
            <div class="col-right col-2-3">
                <div class="col-wrap">
                    <?php
                        // output setting sections and their fields
                        do_settings_sections( 'vclg-options-page' );
                    ?>
                    <br>
                    <br>
                    <?php
                        // output save settings button
                        submit_button();
                    ?>
                </div>
            </div>
            <div class="col-left col-1-3">
                <div class="col-wrap">
                    <div class="card">
                        <h2>How it works:</h2>
                        <p><b>STEP 1:</b> <br> Create a <a href="https://gumroad.com/settings/advanced#application-form" target="_blank">Gumroad App</a> on your profile settings and generate your access token to get connected via Gumroad API.</p>
                        <p><b>STEP 2:</b> <br> Copy/Paste this shortcode <code>[vclg_form]</code> on whatever place you want.</p>
                        <p>That's it!! Well done.</p>
                        <p><a href="http://paypal.me/bouyardane" target="_blank">Donate if you like it!</a></p>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>