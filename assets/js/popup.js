jQuery(document).ready(function($) {
    // Check if we should display the warning
    if (typeof smartVpnWarningData !== 'undefined') {
        // Add event listener to checkout button
        $(document).on('click', '#place_order', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            const $button = $(this);
            const $form = $button.closest('form.checkout');
            
            $button.prop('disabled', true).text(smartVpnWarningData.checking_text);
            
            // Add cache busting parameter
            const timestamp = new Date().getTime();
            
            $.ajax({
                url: 'https://api.ipify.org?format=json&nocache=' + timestamp,
                dataType: 'json',
                timeout: 5000, 
                cache: false,
                success: function(data) {
                    const ip = data.ip;
                    $.ajax({
                        url: 'https://ipapi.co/' + ip + '/json/?nocache=' + timestamp,
                        dataType: 'json',
                        timeout: 5000,
                        cache: false,
                        success: function(geoData) {
                            const countryCode = geoData.country_code || 'UNKNOWN';
                            
                            $button.prop('disabled', false).text(smartVpnWarningData.order_button_text);
                            
                            if (smartVpnWarningData.show_to_all === 'yes' || (countryCode !== 'IR' && smartVpnWarningData.show_to_all !== 'yes')) {
                                $('#smart-vpn-warning-modal').fadeIn(300);
                            } else {
                                $form.submit();
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('GeoIP API error:', textStatus, errorThrown);
                            $button.prop('disabled', false).text(smartVpnWarningData.order_button_text);
                            $form.submit(); 
                        }
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('IP API error:', textStatus, errorThrown);
                    $button.prop('disabled', false).text(smartVpnWarningData.order_button_text);
                    $form.submit(); 
                }
            });
        });
    }

    // Close popup
    $('#smart-vpn-close').on('click', function() {
        $('#smart-vpn-warning-modal').fadeOut(300);
    });

    // Close popup when clicking outside
    $('#smart-vpn-warning-modal').on('click', function(e) {
        if ($(e.target).hasClass('smart-vpn-modal')) {
            $('#smart-vpn-warning-modal').fadeOut(300);
        }
    });
}); 