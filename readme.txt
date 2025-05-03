=== Smart VPN Warning for WooCommerce ===
Contributors: ahmadesmaeeli81
Tags: woocommerce, vpn, payment, iran, persian, farsi, rtl
Requires at least: 5.0
Tested up to: 6.8
Requires PHP: 7.2
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display a smart warning to users to turn off their VPN during checkout in WooCommerce.

== Description ==

Smart VPN Warning for WooCommerce displays a simple and elegant warning on the WooCommerce checkout page, advising users to turn off their VPN for successful payment processing.

This plugin is especially useful for Iranian online stores where international payments might be blocked due to sanctions when users are using VPNs.

= Features =

* Display a simple and elegant warning (no popup) on the checkout page
* Smart country detection using IP Geolocation API
* Admin settings panel in WordPress dashboard
* Customizable warning message (supports both English and Persian)
* Option to show warning to all users or only to users outside Iran
* Caching system to reduce API requests and improve speed
* Responsive design and mobile-friendly
* RTL support for Persian websites

= Requirements =

* WordPress 5.0 or higher
* WooCommerce 3.0 or higher
* A free API key from [ipgeolocation.io](https://ipgeolocation.io/)

== Installation ==

1. Download the plugin zip file
2. Go to your WordPress admin panel and navigate to `Plugins > Add New > Upload Plugin`
3. Select the zip file and upload it
4. Activate the plugin

Or using FTP:

1. Extract the zip file
2. Upload the `smart-vpn-warning` folder to your `/wp-content/plugins/` directory
3. Activate the plugin from your WordPress admin panel

== Configuration ==

1. After activating the plugin, go to `Settings > VPN Warning`
2. Get an API key from [ipgeolocation.io](https://ipgeolocation.io/)
3. Enter your API key in the appropriate field
4. Customize the warning message if needed (both English and Persian versions)
5. If you want to show the warning to all users (without checking their country), enable the corresponding option
6. Save your settings

== Frequently Asked Questions ==

= Is this plugin compatible with my Persian theme? =
Yes, this plugin is fully compatible with RTL and Persian themes.

= Will this plugin slow down my website? =
No, this plugin uses a caching system and only connects to the API once per hour.

= Can I display the warning only on the checkout page? =
Yes, by default, this plugin only displays the warning on the WooCommerce checkout page.

== Screenshots ==
1. Warning display on checkout page
2. Plugin settings page

== Changelog ==

= 1.0.2 =
* Fixed text domain consistency issues
* Additional security improvements

= 1.0.1 =
* Fixed text domain issues
* Improved security with proper data sanitization and escaping
* Fixed plugin URI

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0.2 =
This update fixes text domain consistency issues and includes additional security improvements.

= 1.0.0 =
Initial release of the plugin.

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