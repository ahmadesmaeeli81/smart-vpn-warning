<?php
/**
 * Main class for Smart VPN Warning plugin
 *
 * @package Smart_VPN_Warning
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main plugin class
 */
class Smart_VPN_Warning {

    /**
     * Plugin options
     *
     * @var array
     */
    private $options;

    /**
     * Initialize plugin
     */
    public function init() {
        // Load options
        $this->options = get_option('smart_vpn_warning_options', array());
        
        // Add settings menu
        add_action('admin_menu', array($this, 'add_settings_page'));
        add_action('admin_init', array($this, 'register_settings'));
        
        // Add styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        
        // Display warning on checkout
        add_action('woocommerce_before_checkout_form', array($this, 'display_vpn_warning'));
        
        // Display popup warning
        add_action('wp_footer', array($this, 'display_vpn_warning_popup'));
    }

    /**
     * Add settings page
     */
    public function add_settings_page() {
        add_options_page(
            esc_html__('تنظیمات هشدار VPN', 'smart-vpn-warning-for-woocommerce'),
            esc_html__('هشدار VPN', 'smart-vpn-warning-for-woocommerce'),
            'manage_options',
            'smart-vpn-warning',
            array($this, 'render_settings_page')
        );
    }

    /**
     * Register settings
     */
    public function register_settings() {
        register_setting(
            'smart_vpn_warning_options',
            'smart_vpn_warning_options',
            array($this, 'sanitize_options')
        );

        add_settings_section(
            'smart_vpn_warning_main',
            esc_html__('تنظیمات اصلی', 'smart-vpn-warning-for-woocommerce'),
            null,
            'smart_vpn_warning_options'
        );
    }

    /**
     * Render settings page
     */
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html__('تنظیمات هشدار VPN', 'smart-vpn-warning-for-woocommerce'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('smart_vpn_warning_options');
                do_settings_sections('smart_vpn_warning_options');
                wp_nonce_field('smart_vpn_warning_settings', 'smart_vpn_warning_nonce');
                ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="smart_vpn_warning_message_fa"><?php echo esc_html__('پیام هشدار', 'smart-vpn-warning-for-woocommerce'); ?></label>
                        </th>
                        <td>
                            <textarea id="smart_vpn_warning_message_fa" name="smart_vpn_warning_options[warning_message_fa]" rows="3" class="large-text"><?php echo esc_textarea($this->options['warning_message_fa']); ?></textarea>
                            <p class="description">
                                <?php echo esc_html__('متن هشدار را به زبان فارسی وارد کنید.', 'smart-vpn-warning-for-woocommerce'); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php echo esc_html__('نمایش هشدار', 'smart-vpn-warning-for-woocommerce'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <label>
                                    <input type="radio" name="smart_vpn_warning_options[show_to_all]" value="no" <?php checked($this->options['show_to_all'], 'no'); ?>>
                                    <?php echo esc_html__('فقط به کاربران خارج از ایران', 'smart-vpn-warning-for-woocommerce'); ?>
                                </label>
                                <br>
                                <label>
                                    <input type="radio" name="smart_vpn_warning_options[show_to_all]" value="yes" <?php checked($this->options['show_to_all'], 'yes'); ?>>
                                    <?php echo esc_html__('به همه کاربران', 'smart-vpn-warning-for-woocommerce'); ?>
                                </label>
                            </fieldset>
                            <p class="description">
                                <?php echo esc_html__('انتخاب کنید که هشدار به چه کاربرانی نمایش داده شود.', 'smart-vpn-warning-for-woocommerce'); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php echo esc_html__('نوع نمایش هشدار', 'smart-vpn-warning-for-woocommerce'); ?>
                        </th>
                        <td>
                            <fieldset>
                                <label>
                                    <input type="radio" name="smart_vpn_warning_options[warning_type]" value="box" <?php checked(isset($this->options['warning_type']) ? $this->options['warning_type'] : 'box', 'box'); ?>>
                                    <?php echo esc_html__('باکس ثابت در صفحه پرداخت', 'smart-vpn-warning-for-woocommerce'); ?>
                                </label>
                                <br>
                                <label>
                                    <input type="radio" name="smart_vpn_warning_options[warning_type]" value="popup" <?php checked(isset($this->options['warning_type']) ? $this->options['warning_type'] : 'box', 'popup'); ?>>
                                    <?php echo esc_html__('پاپ‌آپ بعد از کلیک روی دکمه ثبت سفارش', 'smart-vpn-warning-for-woocommerce'); ?>
                                </label>
                            </fieldset>
                            <p class="description">
                                <?php echo esc_html__('انتخاب کنید که هشدار به چه صورتی نمایش داده شود.', 'smart-vpn-warning-for-woocommerce'); ?>
                            </p>
                            <p class="description" style="color: #d63638;">
                                <?php echo esc_html__('توجه: این افزونه در حال توسعه است و تلاش می‌کنیم شناسایی وضعیت VPN را به‌صورت دقیق در هر دو حالت انجام دهیم.
در حال حاضر، حالت پاپ‌آپ هنگام کلیک روی دکمه «ثبت سفارش» فعال می‌شود و برای کاربران خارج از ایران دقت بالاتری دارد.
حالت نمایش ثابت بدون بررسی موقعیت کاربر اجرا می‌شود و ممکن است برای همه کاربران نمایش داده شود.', 'smart-vpn-warning-for-woocommerce'); ?>
                            </p>
                        </td>
                    </tr>
                </table>
                <?php submit_button(esc_html__('ذخیره تنظیمات', 'smart-vpn-warning-for-woocommerce')); ?>
            </form>
        </div>
        <?php
    }

    /**
     * Enqueue styles
     */
    public function enqueue_styles() {
        if (is_checkout()) {
            wp_enqueue_style('smart-vpn-warning-style', SMART_VPN_WARNING_PLUGIN_URL . 'assets/css/style.css', array(), SMART_VPN_WARNING_VERSION);
            wp_enqueue_style('smart-vpn-warning-modal', SMART_VPN_WARNING_PLUGIN_URL . 'assets/css/modal.css', array(), SMART_VPN_WARNING_VERSION);
            
            // Enqueue script only for popup functionality
            if (isset($this->options['warning_type']) && $this->options['warning_type'] === 'popup') {
                wp_enqueue_script('smart-vpn-warning-popup', SMART_VPN_WARNING_PLUGIN_URL . 'assets/js/popup.js', array('jquery'), SMART_VPN_WARNING_VERSION, true);
                
                // Pass data to script
                wp_localize_script('smart-vpn-warning-popup', 'smartVpnWarningData', array(
                    'checking_text' => __('در حال بررسی...', 'smart-vpn-warning-for-woocommerce'),
                    'order_button_text' => __('ثبت سفارش', 'smart-vpn-warning-for-woocommerce'),
                    'show_to_all' => isset($this->options['show_to_all']) ? $this->options['show_to_all'] : 'no'
                ));
            }
        }
    }

    /**
     * Display VPN warning
     */
    public function display_vpn_warning() {
        // Check if we're on checkout page
        if (!is_checkout()) {
            return;
        }
        
        // Check warning type
        $warning_type = isset($this->options['warning_type']) ? $this->options['warning_type'] : 'box';
        if ($warning_type === 'popup') {
            return; // Don't show box if popup is selected
        }
        
        // Check if we should display the warning
        if (!$this->should_display_warning()) {
            return;
        }
        
        // Get appropriate warning message
        $warning_message = $this->get_appropriate_warning_message();
        
        if (!empty($warning_message)) {
            echo '<div class="smart-vpn-warning">';
            echo '<div class="smart-vpn-warning-icon"></div>';
            echo '<div class="smart-vpn-warning-message">' . esc_html($warning_message) . '</div>';
            echo '</div>';
        }
    }

    /**
     * Display VPN warning popup
     */
    public function display_vpn_warning_popup() {
        // Check if we're on checkout page
        if (!is_checkout()) {
            return;
        }
        
        // Check warning type
        $warning_type = isset($this->options['warning_type']) ? $this->options['warning_type'] : 'box';
        if ($warning_type !== 'popup') {
            return; // Only show popup if popup is selected
        }
        
        // Get appropriate warning message
        $warning_message = $this->get_appropriate_warning_message();
        
        // Display popup HTML structure
        ?>
        <div id="smart-vpn-warning-modal" class="smart-vpn-modal" style="display: none;">
            <div class="smart-vpn-modal-content">
                <h4><?php echo esc_html__('هشدار', 'smart-vpn-warning-for-woocommerce'); ?></h4>
                <p><?php echo esc_html($warning_message); ?></p>
                <div class="smart-vpn-modal-buttons">
                    <button id="smart-vpn-close" class="button"><?php echo esc_html__('باشه', 'smart-vpn-warning-for-woocommerce'); ?></button>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#smart-vpn-close').on('click', function(e) {
                e.preventDefault();
                $('#smart-vpn-warning-modal').fadeOut(300);
            });
        });
        </script>
        <?php
    }

    /**
     * Get appropriate warning message
     *
     * @return string
     */
    private function get_appropriate_warning_message() {
        return isset($this->options['warning_message_fa']) ? $this->options['warning_message_fa'] : 'لطفاً برای انجام موفق پرداخت، VPN یا فیلترشکن خود را خاموش کنید.';
    }

    /**
     * Check if we should display the warning
     *
     * @return bool
     */
    private function should_display_warning() {
        // If show to all users option is enabled
        if (isset($this->options['show_to_all']) && $this->options['show_to_all'] === 'yes') {
            return true;
        }
        
        // For box display, we'll assume we should show it
        // For popup, we'll check the country in JavaScript
        $warning_type = isset($this->options['warning_type']) ? $this->options['warning_type'] : 'box';
        if ($warning_type === 'popup') {
            return true;
        }
        
        // For box display with country check
        return $this->is_user_outside_iran();
    }

    /**
     * Check if user is outside Iran
     *
     * @return bool
     */
    private function is_user_outside_iran() {
        // Get user's IP
        $ip_address = $this->get_client_ip();
        if (!$ip_address) {
            return false;
        }
        
        // Make API request to ipapi.co with cache busting parameter
        $api_url = "https://ipapi.co/{$ip_address}/json/?nocache=" . time();
        $response = wp_remote_get($api_url, array(
            'timeout' => 5,
            'sslverify' => true,
            'headers' => array(
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            )
        ));
        
        if (is_wp_error($response)) {
            error_log('Smart VPN Warning: API request failed - ' . $response->get_error_message());
            return false;
        }
        
        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code !== 200) {
            error_log('Smart VPN Warning: API returned error code ' . $response_code);
            return false;
        }
        
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        
        if (isset($data['country_code'])) {
            return ($data['country_code'] !== 'IR');
        }
        
        return false;
    }

    /**
     * Get client IP
     *
     * @return string|false
     */
    private function get_client_ip() {
        $ip_keys = array(
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        );
        
        foreach ($ip_keys as $key) {
            if (isset($_SERVER[$key])) {
                $ip = wp_unslash($_SERVER[$key]);
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return sanitize_text_field($ip);
                }
            }
        }
        
        return false;
    }

    /**
     * Sanitize plugin options
     *
     * @param array $input The input options array.
     * @return array Sanitized options array.
     */
    public function sanitize_options($input) {
        // Verify nonce
        if (!isset($_POST['smart_vpn_warning_nonce']) || !wp_verify_nonce($_POST['smart_vpn_warning_nonce'], 'smart_vpn_warning_settings')) {
            add_settings_error('smart_vpn_warning_options', 'nonce_error', esc_html__('خطای امنیتی رخ داده است. لطفا دوباره تلاش کنید.', 'smart-vpn-warning-for-woocommerce'), 'error');
            return get_option('smart_vpn_warning_options', array());
        }
        
        $sanitized_input = array();
        
        // Sanitize warning message
        if (isset($input['warning_message_fa'])) {
            $sanitized_input['warning_message_fa'] = sanitize_textarea_field($input['warning_message_fa']);
        }
        
        // Sanitize show to all
        $sanitized_input['show_to_all'] = isset($input['show_to_all']) ? sanitize_text_field($input['show_to_all']) : 'no';
        
        // Sanitize warning type
        $sanitized_input['warning_type'] = isset($input['warning_type']) && in_array($input['warning_type'], array('box', 'popup')) ? $input['warning_type'] : 'box';
        
        return $sanitized_input;
    }
}