<?php
/**
 * Plugin Name: هشدار هوشمند VPN
 * Plugin URI: https://github.com/ahmadesmaeeli81/smart-vpn-warning
 * Description: نمایش یک هشدار ساده در صفحه پرداخت برای خاموش کردن VPN با تشخیص هوشمند کشور کاربر
 * Version: 1.0.0
 * Author: Ahmad Esmaeili
 * Author URI: https://ahmadesmaeeli.ir
 * Text Domain: smart-vpn-warning
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.0
 * WC requires at least: 3.0
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) exit;

/**
 * کلاس اصلی افزونه
 */
class Smart_VPN_Warning {
    
    /**
     * نسخه افزونه
     * @var string
     */
    const VERSION = '1.0.0';
    
    /**
     * شناسه یکتای افزونه
     * @var string
     */
    private $plugin_slug = 'smart-vpn-warning';
    
    /**
     * نمونه منحصر به فرد از این کلاس
     * @var Smart_VPN_Warning
     */
    private static $instance;

    /**
     * گرفتن نمونه منحصر به فرد - الگوی Singleton
     * @return Smart_VPN_Warning
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * سازنده
     */
    private function __construct() {
        // تنظیم مسیر ثابت افزونه
        if (!defined('SMART_VPN_WARNING_PATH')) {
            define('SMART_VPN_WARNING_PATH', plugin_dir_path(__FILE__));
        }
        
        // تعریف URL افزونه
        if (!defined('SMART_VPN_WARNING_URL')) {
            define('SMART_VPN_WARNING_URL', plugin_dir_url(__FILE__));
        }
        
        // بررسی فعال بودن ووکامرس
        add_action('plugins_loaded', array($this, 'check_woocommerce'));
        
        // بارگذاری متن‌های قابل ترجمه
        add_action('plugins_loaded', array($this, 'load_textdomain'));
        
        // تنظیمات مدیریت
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        
        // اضافه کردن لینک تنظیمات در صفحه افزونه‌ها
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'add_settings_link'));
        
        // هشدار در صفحه پرداخت
        add_action('woocommerce_before_checkout_form', array($this, 'show_vpn_warning'), 5);
        
        // استایل CSS
        add_action('wp_head', array($this, 'add_notice_styles'));
    }
    
    /**
     * بررسی فعال بودن ووکامرس
     */
    public function check_woocommerce() {
        if (!class_exists('WooCommerce')) {
            add_action('admin_notices', array($this, 'woocommerce_missing_notice'));
        }
    }
    
    /**
     * پیام خطای عدم وجود ووکامرس
     */
    public function woocommerce_missing_notice() {
        ?>
        <div class="error">
            <p><?php _e('هشدار هوشمند VPN نیاز به افزونه ووکامرس دارد. لطفاً ووکامرس را نصب و فعال کنید.', 'smart-vpn-warning'); ?></p>
        </div>
        <?php
    }
    
    /**
     * بارگذاری متن‌های قابل ترجمه
     */
    public function load_textdomain() {
        load_plugin_textdomain('smart-vpn-warning', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
    
    /**
     * افزودن لینک تنظیمات در صفحه افزونه‌ها
     */
    public function add_settings_link($links) {
        $settings_link = '<a href="options-general.php?page=' . $this->plugin_slug . '">' . __('تنظیمات', 'smart-vpn-warning') . '</a>';
        array_unshift($links, $settings_link);
        return $links;
    }
    
    /**
     * افزودن منوی تنظیمات
     */
    public function add_admin_menu() {
        add_options_page(
            __('تنظیمات هشدار VPN', 'smart-vpn-warning'),
            __('هشدار VPN', 'smart-vpn-warning'),
            'manage_options',
            $this->plugin_slug,
            array($this, 'settings_page')
        );
    }
    
    /**
     * صفحه تنظیمات
     */
    public function settings_page() {
        ?>
        <div class="wrap">
            <h1><?php _e('تنظیمات هشدار VPN', 'smart-vpn-warning'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields($this->plugin_slug . '_settings');
                do_settings_sections($this->plugin_slug);
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
    
    /**
     * ثبت تنظیمات
     */
    public function register_settings() {
        register_setting(
            $this->plugin_slug . '_settings',
            $this->plugin_slug . '_options',
            array($this, 'sanitize_settings')
        );
        
        add_settings_section(
            $this->plugin_slug . '_main',
            __('تنظیمات اصلی', 'smart-vpn-warning'),
            array($this, 'settings_section_callback'),
            $this->plugin_slug
        );
        
        add_settings_field(
            'api_key',
            __('کلید API سرویس ipgeolocation.io', 'smart-vpn-warning'),
            array($this, 'api_key_callback'),
            $this->plugin_slug,
            $this->plugin_slug . '_main'
        );
        
        add_settings_field(
            'warning_text',
            __('متن هشدار', 'smart-vpn-warning'),
            array($this, 'warning_text_callback'),
            $this->plugin_slug,
            $this->plugin_slug . '_main'
        );
        
        add_settings_field(
            'show_to_all',
            __('نمایش به همه کاربران', 'smart-vpn-warning'),
            array($this, 'show_to_all_callback'),
            $this->plugin_slug,
            $this->plugin_slug . '_main'
        );
    }
    
    /**
     * اعتبارسنجی داده‌های تنظیمات
     */
    public function sanitize_settings($input) {
        $new_input = array();
        
        if (isset($input['api_key'])) {
            $new_input['api_key'] = sanitize_text_field($input['api_key']);
        }
        
        if (isset($input['warning_text'])) {
            $new_input['warning_text'] = wp_kses_post($input['warning_text']);
        }
        
        if (isset($input['show_to_all'])) {
            $new_input['show_to_all'] = (int) $input['show_to_all'];
        } else {
            $new_input['show_to_all'] = 0;
        }
        
        return $new_input;
    }
    
    /**
     * توضیحات بخش تنظیمات
     */
    public function settings_section_callback() {
        echo __('برای استفاده از تشخیص کشور، یک کلید API از <a href="https://ipgeolocation.io/" target="_blank">ipgeolocation.io</a> دریافت کنید.', 'smart-vpn-warning');
    }
    
    /**
     * فیلد کلید API
     */
    public function api_key_callback() {
        $options = get_option($this->plugin_slug . '_options', array());
        $api_key = isset($options['api_key']) ? $options['api_key'] : '';
        
        echo '<input type="text" id="api_key" name="' . $this->plugin_slug . '_options[api_key]" value="' . esc_attr($api_key) . '" class="regular-text">';
        echo '<p class="description">' . __('این کلید برای تشخیص کشور کاربر مورد استفاده قرار می‌گیرد.', 'smart-vpn-warning') . '</p>';
    }
    
    /**
     * فیلد متن هشدار
     */
    public function warning_text_callback() {
        $options = get_option($this->plugin_slug . '_options', array());
        $default_text = __('برای انجام موفق پرداخت، لطفا از خاموش بودن VPN خود اطمینان حاصل کنید. در صورت روشن بودن VPN، ممکن است پرداخت شما با مشکل مواجه شود.', 'smart-vpn-warning');
        $warning_text = isset($options['warning_text']) ? $options['warning_text'] : $default_text;
        
        echo '<textarea id="warning_text" name="' . $this->plugin_slug . '_options[warning_text]" rows="5" cols="50" class="large-text">' . esc_textarea($warning_text) . '</textarea>';
    }
    
    /**
     * فیلد نمایش به همه کاربران
     */
    public function show_to_all_callback() {
        $options = get_option($this->plugin_slug . '_options', array());
        $checked = isset($options['show_to_all']) && $options['show_to_all'] ? 'checked' : '';
        
        echo '<input type="checkbox" id="show_to_all" name="' . $this->plugin_slug . '_options[show_to_all]" value="1" ' . $checked . '>';
        echo '<label for="show_to_all">' . __('نمایش هشدار به همه کاربران (بدون بررسی کشور)', 'smart-vpn-warning') . '</label>';
        echo '<p class="description">' . __('اگر این گزینه را انتخاب کنید، هشدار به تمام کاربران نمایش داده می‌شود، حتی اگر از داخل ایران به سایت دسترسی داشته باشند.', 'smart-vpn-warning') . '</p>';
    }
    
    /**
     * تشخیص IP کاربر
     */
    private function get_user_ip() {
        if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            return sanitize_text_field($_SERVER['HTTP_CF_CONNECTING_IP']);
        }
        
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return sanitize_text_field(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
        }
        
        if (!empty($_SERVER['REMOTE_ADDR'])) {
            return sanitize_text_field($_SERVER['REMOTE_ADDR']);
        }
        
        return null;
    }
    
    /**
     * بررسی ایرانی بودن کاربر
     */
    private function is_user_from_iran() {
        $options = get_option($this->plugin_slug . '_options', array());
        
        // اگر تنظیم شده باشد که به همه نمایش دهد
        if (isset($options['show_to_all']) && $options['show_to_all']) {
            return false; // نمایش به همه کاربران
        }
        
        $api_key = isset($options['api_key']) ? $options['api_key'] : '';
        if (empty($api_key)) {
            return false; // اگر کلید API تنظیم نشده باشد، به همه کاربران نمایش می‌دهیم
        }
        
        $ip = $this->get_user_ip();
        if (!$ip) {
            return true; // اگر نتوانیم IP را تشخیص دهیم، فرض می‌کنیم ایرانی است
        }
        
        // بررسی کش
        $cache_key = $this->plugin_slug . '_geo_' . md5($ip);
        $cached = get_transient($cache_key);
        
        if ($cached !== false) {
            return $cached === 'iran';
        }
        
        // درخواست به API
        $url = "https://api.ipgeolocation.io/ipgeo?apiKey=" . esc_attr($api_key) . "&ip=" . esc_attr($ip);
        $response = wp_remote_get($url, array('timeout' => 5));
        
        if (is_wp_error($response)) {
            // ثبت خطا در لاگ
            error_log(sprintf(__('خطا در بررسی کشور: %s', 'smart-vpn-warning'), $response->get_error_message()));
            return true; // در صورت خطا، فرض می‌کنیم ایرانی است
        }
        
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);
        
        if (empty($data) || !isset($data->country_name)) {
            // ثبت خطا در لاگ
            error_log(__('پاسخ API نامعتبر است', 'smart-vpn-warning'));
            return true;
        }
        
        $country = isset($data->country_name) ? strtolower($data->country_name) : '';
        $is_iran = ($country === 'iran');
        
        // ذخیره در کش
        set_transient($cache_key, $is_iran ? 'iran' : 'not_iran', HOUR_IN_SECONDS);
        
        return $is_iran;
    }
    
    /**
     * نمایش هشدار
     */
    public function show_vpn_warning() {
        if (!is_checkout()) {
            return;
        }
        
        // اگر کاربر ایرانی نیست یا تنظیم شده که به همه نشان دهد
        if (!$this->is_user_from_iran()) {
            $options = get_option($this->plugin_slug . '_options', array());
            $default_text = __('برای انجام موفق پرداخت، لطفا از خاموش بودن VPN خود اطمینان حاصل کنید. در صورت روشن بودن VPN، ممکن است پرداخت شما با مشکل مواجه شود.', 'smart-vpn-warning');
            $warning_text = isset($options['warning_text']) ? $options['warning_text'] : $default_text;
            
            ?>
            <div class="vpn-warning-notice">
                <div class="vpn-warning-icon">⚠️</div>
                <div class="vpn-warning-content">
                    <strong><?php _e('توجه!', 'smart-vpn-warning'); ?></strong>
                    <?php echo wp_kses_post($warning_text); ?>
                </div>
            </div>
            <?php
        }
    }
    
    /**
     * اضافه کردن استایل CSS
     */
    public function add_notice_styles() {
        if (!is_checkout()) {
            return;
        }
        ?>
        <style type="text/css">
            .vpn-warning-notice {
                background-color: #fffbeb;
                border: 1px solid #fbbf24;
                border-right: 4px solid #f59e0b;
                border-radius: 4px;
                padding: 16px;
                margin-bottom: 30px;
                display: flex;
                align-items: flex-start;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            }
            
            .vpn-warning-icon {
                font-size: 24px;
                margin-left: 16px;
                line-height: 1;
            }
            
            .vpn-warning-content {
                font-size: 14px;
                line-height: 1.6;
                color: #222;
                flex: 1;
            }
            
            .vpn-warning-content strong {
                color: #b45309;
                display: block;
                margin-bottom: 4px;
                font-size: 16px;
            }
            
            /* استایل سازگار با RTL */
            body.rtl .vpn-warning-notice {
                border-right: 1px solid #fbbf24;
                border-left: 4px solid #f59e0b;
                text-align: right;
            }
            
            body.rtl .vpn-warning-icon {
                margin-left: 16px;
                margin-right: 0;
            }
            
            /* سازگاری با موبایل */
            @media (max-width: 768px) {
                .vpn-warning-notice {
                    padding: 12px;
                }
                
                .vpn-warning-icon {
                    font-size: 20px;
                    margin-left: 12px;
                }
                
                .vpn-warning-content {
                    font-size: 13px;
                }
                
                .vpn-warning-content strong {
                    font-size: 15px;
                }
            }
        </style>
        <?php
    }
}

// راه‌اندازی افزونه
function smart_vpn_warning() {
    return Smart_VPN_Warning::get_instance();
}
smart_vpn_warning();