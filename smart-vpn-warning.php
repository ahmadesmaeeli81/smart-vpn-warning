<?php
/**
 * Plugin Name: Smart VPN Warning for WooCommerce
 * Description: Display a smart warning to users to turn off their VPN during checkout in WooCommerce
 * Version: 1.0.2
 * Author: Your Name
 * Author URI: https://ahmadesmaeeli.ir
 * Text Domain: smart-vpn-warning-for-woocommerce
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.2
 * WC requires at least: 3.0
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define plugin constants
define('SMART_VPN_WARNING_VERSION', '1.0.2');
define('SMART_VPN_WARNING_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SMART_VPN_WARNING_PLUGIN_URL', plugin_dir_url(__FILE__));

// Load main plugin files
require_once SMART_VPN_WARNING_PLUGIN_DIR . 'includes/class-smart-vpn-warning.php';

// Initialize plugin
function smart_vpn_warning_init() {
    // Check if WooCommerce is active
    if (!class_exists('WooCommerce')) {
        add_action('admin_notices', 'smart_vpn_warning_wc_missing_notice');
        return;
    }
    
    // Initialize main class
    $smart_vpn_warning = new Smart_VPN_Warning();
    $smart_vpn_warning->init();
}
add_action('plugins_loaded', 'smart_vpn_warning_init');

// Display error message if WooCommerce is not active
function smart_vpn_warning_wc_missing_notice() {
    ?>
    <div class="error">
        <p><?php esc_html_e('Smart VPN Warning requires WooCommerce plugin to be installed and activated.', 'smart-vpn-warning-for-woocommerce'); ?></p>
    </div>
    <?php
}

// Plugin activation
register_activation_hook(__FILE__, 'smart_vpn_warning_activate');
function smart_vpn_warning_activate() {
    // Default settings
    $default_options = array(
        'api_key' => '',
        'warning_message' => 'Please turn off your VPN or proxy for successful payment.',
        'warning_message_fa' => 'لطفاً برای انجام موفق پرداخت، VPN یا فیلترشکن خود را خاموش کنید.',
        'show_to_all' => 'no',
    );
    
    // Save default settings if they don't exist
    if (!get_option('smart_vpn_warning_options')) {
        update_option('smart_vpn_warning_options', $default_options);
    }
}

// Plugin deactivation
register_deactivation_hook(__FILE__, 'smart_vpn_warning_deactivate');
function smart_vpn_warning_deactivate() {
    // Clear cache
    delete_transient('smart_vpn_warning_country_code');
}

// Plugin uninstall
register_uninstall_hook(__FILE__, 'smart_vpn_warning_uninstall');
function smart_vpn_warning_uninstall() {
    // Remove settings
    delete_option('smart_vpn_warning_options');
    delete_transient('smart_vpn_warning_country_code');
}