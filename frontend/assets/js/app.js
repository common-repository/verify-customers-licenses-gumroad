/*
 * Let's begin with validation functions
 */
jQuery.extend(jQuery.fn, {
	/*
	 * check if field value lenth more than 3 symbols ( for name and comment ) 
	 */
	validInput: function () {
        var hasError = jQuery(this).hasClass('has-error'),
            $error = '<span class="error" style="color: #F44336;">This field is required!</span>';
		if (jQuery(this).val().length < 4) {
            jQuery(this).addClass('has-error');
            if(!hasError) {
                jQuery(this).after($error);
            }
			return false;
		} else {
			jQuery(this).removeClass('has-error');
            jQuery(this).next().closest('.error').remove();
			return true;
        }
    },
	/*
	 * check if email is correct
	 * add to your CSS the styles of .error field, for example border-color:red;
	 */
	validLicense: function () {
		var keyReg = /[0-9A-Z]{8}(-[0-9A-Z]{8}){3}/,
			licenseToValidate = jQuery(this).val(),
			hasError = jQuery(this).hasClass('has-error'),
            $error = '<span class="error" style="color: #F44336;">The field is empty or the license key is invalid!</span>';
		if (!keyReg.test( licenseToValidate ) || licenseToValidate == "") {
            jQuery(this).addClass('has-error');
            if(!hasError) {
                jQuery(this).after($error);
            }
            return false
		} else {
            jQuery(this).removeClass('has-error');
            jQuery(this).next().closest('.error').remove();
            return true
		}
	},
    
});

jQuery(function($){

    // price format function to convert from thousands to price in usd.
    function vclg_price_format(num) {
        return '$' + (num / 100).toFixed(2);
    }

	$('#vclg_submit_trigger').on('click', function(){

        // register variables
        var $button = $(this),
            $selector = $('#vclg_data_html');
            $product_permalink = $( '#vclg_product_permalink' );
            $license_key = $( '#vclg_license_key' );
            product_permalink = $product_permalink.val();
            license_key = $license_key.val();
            $response = '';

        // validate inputs
		$product_permalink.validInput();
		$license_key.validLicense();

        if (!$product_permalink.hasClass( 'has-error' ) && !$license_key.hasClass( 'has-error' )) { 
            $.ajax({
                url : vclg_callback_params.ajaxurl, // AJAX handler, declared before
                data : {
                    action:         'vclg_action',
                    _ajax_nonce:    vclg_callback_params.nonce,
                    permalink:      product_permalink,
                    key:            license_key,
                },
                dataType: 'json',
                type : 'POST',
                beforeSend : function ( xhr ) {
                    // show verifing when the response in process
                    $button.text('Verifying...');
                },
                success : function( response ){

                    // Parse data to JSON object
                    data = JSON.parse(response.body);

                    if( data.success === true ) {

                        // show verified when the response success
                        $button.text( 'Verified!' );

                        // item purchase parent property                    
                        $item = data.purchase;

                        // convert ISO date to easy to read date.              
                        newDate = new Date( $item.created_at );
                        $date = newDate.toLocaleString();

                        // response : alert message
                        $response += '<p class="alert alert-success" style="color: #4CAF50;">License key verification successful!</p>';

                        // response : informations
                        $response += '<table>';
                            $response += '<tr><th>Order No:</th><td> <b>#' + $item.order_number + '</b></td></tr>';
                            $response += '<tr><th>Paid:</th><td>' + vclg_price_format($item.price) + ' via <span class="uk-text-capitalize">' + ($item.card.type ? $item.card.type : "Free purchase") + '</span></td></tr>';
                            $response += '<tr><th>Email:</th><td> ' + $item.email + '</td></tr>';
                            $response += '<tr><th>Product Name:</th><td> ' + $item.product_name + ($item.variants ? ' - ' + $item.variants : '') + ' x ' + $item.quantity + '</td></tr>';
                            $response += '<tr><th>Date purchased:</th><td> ' + $date + '</td></tr>';
                            $response += '<tr><th>Refunded:</th><td> ' + ($item.refunded ? '<span class="uk-text-danger">Yes</span>' : 'No') + '</td></tr>';
                            $response += '<tr><th>Disputed:</th><td> ' + ($item.disputed ? '<span class="uk-text-danger">Yes</span>' : 'No') + '</td></tr>';
                            $response += '<tr><th>Chargebacked:</th><td> ' + ($item.chargebacked ? '<span class="uk-text-danger">Yes</span>' : 'No') + '</td></tr>';
                        $response += '</table>';

                    } else {

                        // show not valid when the response failed
                        $button.text( 'Verification failed!' );

                        // failed response : alert message
                        $response += '<p class="alert alert-error" style="color: #F44336;">' + data.message + '</p>';

                    }

                    // print results
                    $selector.html( $response );

                    // show back "verify" text after 2 seconds
                    setTimeout(function(){
                        $button.text( 'Verify' );
                    }, 2000);

                }
            });
        }

        return false;
        
	});

});