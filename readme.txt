=== Smart VPN Warning for WooCommerce ===
Contributors: ahmadesmaeeli
Tags: woocommerce, vpn, warning, checkout, persian, rtl
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.1
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Display a smart warning to users to turn off their VPN during checkout in WooCommerce.

== Description ==

This plugin displays a simple and elegant warning (no popup) on the WooCommerce checkout page, advising users to turn off their VPN for successful payment processing.

= Features =

* Display a simple and elegant warning (no popup) on the checkout page
* Smart country detection using IP Geolocation API
* Admin settings panel in WordPress dashboard
* Customizable warning message in Persian
* Option to show warning to all users or only to users outside Iran
* Caching system to reduce API requests and improve speed
* Rate limiting to stay within API limits
* Responsive design and mobile-friendly
* RTL support for Persian websites

= API Usage =

This plugin uses the ipgeolocation.io API to detect user's country. You need to get an API key from https://ipgeolocation.io/

The free plan includes:
* 1,000 requests per day
* 30 requests per minute

The plugin implements rate limiting to stay within these limits.

== Installation ==

1. Download the plugin zip file
2. Go to your WordPress admin panel and navigate to `Plugins > Add New > Upload Plugin`
3. Select the zip file and upload it
4. Activate the plugin

Or using FTP:

1. Extract the zip file
2. Upload the `smart-vpn-warning` folder to your `/wp-content/plugins/` directory
3. Activate the plugin from your WordPress admin panel

== Frequently Asked Questions ==

= Is this plugin compatible with my Persian theme? =

Yes, this plugin is fully compatible with RTL and Persian themes.

= Will this plugin slow down my website? =

No, this plugin uses a caching system and rate limiting to stay within API limits.

= Can I display the warning only on the checkout page? =

Yes, by default, this plugin only displays the warning on the WooCommerce checkout page.

== Screenshots ==

1. Warning message on checkout page
2. Plugin settings page
3. RTL support example

== Changelog ==

= 1.1 =
* Improved security with nonce for settings forms
* Added rate limiting for API requests (1 request per minute per IP)
* Enhanced error handling and logging
* Removed English warning message (Persian only)
* Updated documentation

= 1.0.2 =
* Initial release

== Upgrade Notice ==

= 1.1 =
This version includes security improvements, rate limiting, and better error handling. The English warning message has been removed to focus on Persian users.

== Configuration ==

1. After activating the plugin, go to `Settings > VPN Warning`
2. Get an API key from ipgeolocation.io
3. Enter your API key in the appropriate field
4. Customize the warning message if needed
5. If you want to show the warning to all users (without checking their country), enable the corresponding option
6. Save your settings

== Requirements ==

* WordPress 5.0 or higher
* WooCommerce 3.0 or higher
* A free API key from ipgeolocation.io

== Persian Description ==

=== هشدار هوشمند VPN برای ووکامرس ===

این افزونه یک هشدار ساده و شیک در صفحه پرداخت ووکامرس نمایش می‌دهد که به کاربران توصیه می‌کند برای انجام موفق پرداخت، VPN خود را خاموش کنند.

این افزونه به‌ویژه برای فروشگاه‌های آنلاین ایرانی مفید است که در آن‌ها پرداخت‌های بین‌المللی ممکن است به دلیل تحریم‌ها هنگامی که کاربران از VPN استفاده می‌کنند، مسدود شود.

= ویژگی‌ها =

* نمایش هشدار شیک و ساده (بدون پاپ‌آپ) در صفحه پرداخت
* تشخیص هوشمند کشور کاربر با استفاده از API
* پنل تنظیمات در مدیریت وردپرس
* امکان تنظیم متن هشدار دلخواه (پشتیبانی از زبان‌های فارسی و انگلیسی)
* گزینه نمایش هشدار به همه کاربران یا فقط کاربران خارج از ایران
* سیستم کش برای کاهش تعداد درخواست‌ها به API و افزایش سرعت
* طراحی واکنش‌گرا و سازگار با موبایل
* پشتیبانی از طرح راست به چپ (RTL)

= پیش‌نیازها =

* وردپرس 5.0 یا بالاتر
* ووکامرس 3.0 یا بالاتر
* یک کلید API رایگان از [ipgeolocation.io](https://ipgeolocation.io/)