<div id="vclg_license_verify_wrap">
    <form id="vclg_license_verify_form">
        <div>
            <label for="vclg_product_permalink"><?php _e('Product shortlink', 'vclg'); ?>:</label>
            <span>https://gum.co/</span>
            <input type="text" id="vclg_product_permalink" class="small" />
        </div>
        <div style="margin-top: 24px">
            <label for="vclg_license_key"><?php _e('License Key', 'vclg'); ?>:</label>
            <input type="text" id="vclg_license_key" placeholder="<?php _e('Your customer license key', 'vclg'); ?>" />
        </div>
        <div style="margin-top: 24px">
            <button id="vclg_submit_trigger" class="submit" style="width: 100%;"><?php _e('Verify', 'vclg'); ?></button>
        </div>
    </form>
    <div id="vclg_data_html" style="margin-top: 40px;"></div>
</div>
<style>
    input[type="text"]::-webkit-input-placeholder {
        color: #c5c5c5;
    }
</style>