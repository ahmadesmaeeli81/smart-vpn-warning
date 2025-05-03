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
        
        // Load translations
        add_action('init', array($this, 'load_textdomain'));
        
        // Add settings menu
        add_action('admin_menu', array($this, 'add_settings_page'));
        add_action('admin_init', array($this, 'register_settings'));
        
        // Add styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        
        // Display warning on checkout
        add_action('woocommerce_before_checkout_form', array($this, 'display_vpn_warning'));
    }

    /**
     * Load plugin textdomain
     */
    public function load_textdomain() {
        load_plugin_textdomain('smart-vpn-warning-for-woocommerce', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    /**
     * Add settings page
     */
    public function add_settings_page() {
        add_options_page(
            __('VPN Warning Settings', 'smart-vpn-warning-for-woocommerce'),
            __('VPN Warning', 'smart-vpn-warning-for-woocommerce'),
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
            'smart_vpn_warning_options_group', 
            'smart_vpn_warning_options',
            array(
                'sanitize_callback' => array($this, 'sanitize_options')
            )
        );
        
        add_settings_section(
            'smart_vpn_warning_main_section',
            __('Main Settings', 'smart-vpn-warning-for-woocommerce'),
            array($this, 'settings_section_callback'),
            'smart-vpn-warning'
        );
        
        add_settings_field(
            'api_key',
            __('API Key', 'smart-vpn-warning-for-woocommerce'),
            array($this, 'api_key_callback'),
            'smart-vpn-warning',
            'smart_vpn_warning_main_section'
        );
        
        add_settings_field(
            'warning_message',
            __('Warning Message (English)', 'smart-vpn-warning-for-woocommerce'),
            array($this, 'warning_message_callback'),
            'smart-vpn-warning',
            'smart_vpn_warning_main_section'
        );
        
        add_settings_field(
            'warning_message_fa',
            __('Warning Message (Persian)', 'smart-vpn-warning-for-woocommerce'),
            array($this, 'warning_message_fa_callback'),
            'smart-vpn-warning',
            'smart_vpn_warning_main_section'
        );
        
        add_settings_field(
            'show_to_all',
            __('Show to All Users', 'smart-vpn-warning-for-woocommerce'),
            array($this, 'show_to_all_callback'),
            'smart-vpn-warning',
            'smart_vpn_warning_main_section'
        );
    }

    /**
     * Settings section description
     */
    public function settings_section_callback() {
        echo '<p>' . esc_html__('Configure the Smart VPN Warning plugin settings here.', 'smart-vpn-warning-for-woocommerce') . '</p>';
    }

    /**
     * API key field
     */
    public function api_key_callback() {
        $api_key = isset($this->options['api_key']) ? $this->options['api_key'] : '';
        echo '<input type="text" id="api_key" name="smart_vpn_warning_options[api_key]" value="' . esc_attr($api_key) . '" class="regular-text" />';
        echo '<p class="description">' . wp_kses(__('Get your API key from <a href="https://ipgeolocation.io/" target="_blank">ipgeolocation.io</a>.', 'smart-vpn-warning-for-woocommerce'), array('a' => array('href' => array(), 'target' => array()))) . '</p>';
    }

    /**
     * Warning message field (English)
     */
    public function warning_message_callback() {
        $warning_message = isset($this->options['warning_message']) ? $this->options['warning_message'] : 'Please turn off your VPN or proxy for successful payment.';
        echo '<textarea id="warning_message" name="smart_vpn_warning_options[warning_message]" rows="4" cols="50">' . esc_textarea($warning_message) . '</textarea>';
        echo '<p class="description">' . esc_html__('This message will be displayed to users with non-Persian language settings.', 'smart-vpn-warning-for-woocommerce') . '</p>';
    }

    /**
     * Warning message field (Persian)
     */
    public function warning_message_fa_callback() {
        $warning_message_fa = isset($this->options['warning_message_fa']) ? $this->options['warning_message_fa'] : 'لطفاً برای انجام موفق پرداخت، VPN یا فیلترشکن خود را خاموش کنید.';
        echo '<textarea id="warning_message_fa" name="smart_vpn_warning_options[warning_message_fa]" rows="4" cols="50">' . esc_textarea($warning_message_fa) . '</textarea>';
        echo '<p class="description">' . esc_html__('This message will be displayed to users with Persian language settings.', 'smart-vpn-warning-for-woocommerce') . '</p>';
    }

    /**
     * Show to all users field
     */
    public function show_to_all_callback() {
        $show_to_all = isset($this->options['show_to_all']) ? $this->options['show_to_all'] : 'no';
        echo '<input type="checkbox" id="show_to_all" name="smart_vpn_warning_options[show_to_all]" value="yes" ' . checked('yes', $show_to_all, false) . ' />';
        echo '<label for="show_to_all">' . esc_html__('Show warning to all users (without checking country)', 'smart-vpn-warning-for-woocommerce') . '</label>';
    }

    /**
     * Render settings page
     */
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('smart_vpn_warning_options_group');
                do_settings_sections('smart-vpn-warning');
                submit_button();
                ?>
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
        
        // Check if we should display the warning
        if (!$this->should_display_warning()) {
            return;
        }
        
        // Get appropriate warning message based on language
        $warning_message = $this->get_appropriate_warning_message();
        
        if (!empty($warning_message)) {
            echo '<div class="smart-vpn-warning">';
            echo '<div class="smart-vpn-warning-icon"></div>';
            echo '<div class="smart-vpn-warning-message">' . esc_html($warning_message) . '</div>';
            echo '</div>';
        }
    }

    /**
     * Get appropriate warning message based on user's language
     *
     * @return string
     */
    private function get_appropriate_warning_message() {
        $locale = get_locale();
        
        // Use Persian message for Persian users
        if (in_array($locale, array('fa_IR', 'fa_AF'))) {
            return isset($this->options['warning_message_fa']) ? $this->options['warning_message_fa'] : 'لطفاً برای انجام موفق پرداخت، VPN یا فیلترشکن خود را خاموش کنید.';
        }
        
        // Use English message for all other users
        return isset($this->options['warning_message']) ? $this->options['warning_message'] : 'Please turn off your VPN or proxy for successful payment.';
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
        
        // Check user's country
        $country_code = $this->get_user_country();
        
        // If user's country is not Iran, show the warning
        return ($country_code && $country_code !== 'IR');
    }

    /**
     * Get user's country code
     *
     * @return string|false
     */
    private function get_user_country() {
        // Check cache
        $country_code = get_transient('smart_vpn_warning_country_code');
        if ($country_code !== false) {
            return $country_code;
        }
        
        // Get API key
        $api_key = isset($this->options['api_key']) ? $this->options['api_key'] : '';
        if (empty($api_key)) {
            return false;
        }
        
        // Get user's IP
        $ip_address = $this->get_client_ip();
        if (!$ip_address) {
            return false;
        }
        
        // Make API request
        $api_url = "https://api.ipgeolocation.io/ipgeo?apiKey={$api_key}&ip={$ip_address}";
        $response = wp_remote_get($api_url);
        
        if (is_wp_error($response)) {
            return false;
        }
        
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        
        if (isset($data['country_code2'])) {
            // Cache for one hour
            set_transient('smart_vpn_warning_country_code', $data['country_code2'], HOUR_IN_SECONDS);
            return $data['country_code2'];
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
        $sanitized_input = array();
        
        // Sanitize API key
        if (isset($input['api_key'])) {
            $sanitized_input['api_key'] = sanitize_text_field($input['api_key']);
        }
        
        // Sanitize warning messages
        if (isset($input['warning_message'])) {
            $sanitized_input['warning_message'] = sanitize_textarea_field($input['warning_message']);
        }
        
        if (isset($input['warning_message_fa'])) {
            $sanitized_input['warning_message_fa'] = sanitize_textarea_field($input['warning_message_fa']);
        }
        
        // Sanitize checkbox
        $sanitized_input['show_to_all'] = isset($input['show_to_all']) ? 'yes' : 'no';
        
        return $sanitized_input;
    }
}