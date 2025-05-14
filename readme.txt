=== Smart VPN Warning for WooCommerce ===
Contributors: ahmadesmaeeli
Tags: woocommerce, vpn, warning, checkout, persian, rtl
Requires at least: 5.0
Tested up to: 6.8
Stable tag: 1.2
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Display a smart warning to users to turn off their VPN during checkout in WooCommerce.

== Description ==

This plugin displays a simple and elegant warning on the WooCommerce checkout page, advising users to turn off their VPN for successful payment processing.

For support or feature requests, please contact us at info@ahmadesmaeeli.ir

= Features =

* Display a simple and elegant warning on the checkout page
* Smart country detection using ipapi.co API (no API key required)
* Admin settings panel in WordPress dashboard
* Customizable warning message in Persian
* Option to show warning to all users or only to users outside Iran
* Option to choose between static box or popup warning
* Responsive design and mobile-friendly
* RTL support for Persian websites

= How It Works =

This plugin uses free API services (ipify.org and ipapi.co) to detect user's country. No API key is required.

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

No, this plugin uses free and fast API services to detect user's country.

= Can I display the warning only on the checkout page? =

Yes, by default, this plugin only displays the warning on the WooCommerce checkout page.

== Screenshots ==

1. Warning message on checkout page
2. Plugin settings page
3. RTL support example

== Changelog ==

= 1.2 =
* Added popup warning option when clicking on checkout button
* Separated CSS and JavaScript code into external files for better performance
* Removed dependency on external API keys for better reliability
* Added author email contact information
* Code optimization and cleanup
* Improved overall performance and loading speed

= 1.1 =
* Improved security with nonce for settings forms
* Changed to free API services (ipify.org and ipapi.co) - no API key required
* Added option to choose between static box or popup warning
* Enhanced error handling and logging
* Removed English warning message (Persian only)
* Updated documentation

= 1.0.2 =
* Initial release

== Upgrade Notice ==

= 1.2 =
This version adds popup warning option when clicking on checkout button, improves code organization with separate CSS and JS files, removes dependency on external API keys, and includes various performance optimizations.

= 1.1 =
This version includes security improvements, free API services (no key required), and the option to choose between static box or popup warning.

== Configuration ==

1. After activating the plugin, go to `Settings > VPN Warning`
2. Customize the warning message if needed
3. Choose how to display the warning (static box or popup)
4. If you want to show the warning to all users (without checking their country), enable the corresponding option
5. Save your settings

== Requirements ==

* WordPress 5.0 or higher
* WooCommerce 3.0 or higher
* PHP 7.2 or higher

== Persian Description ==

=== هشدار هوشمند VPN برای ووکامرس ===

این افزونه یک هشدار ساده و شیک در صفحه پرداخت ووکامرس نمایش می‌دهد که به کاربران توصیه می‌کند برای انجام موفق پرداخت، VPN خود را خاموش کنند.

این افزونه به‌ویژه برای فروشگاه‌های آنلاین ایرانی مفید است که در آن‌ها پرداخت‌های بین‌المللی ممکن است به دلیل تحریم‌ها هنگامی که کاربران از VPN استفاده می‌کنند، مسدود شود.

برای پشتیبانی یا درخواست ویژگی‌های جدید، لطفاً با ما از طریق ایمیل info@ahmadesmaeeli.ir تماس بگیرید.

= تغییرات نسخه 1.2 =
* اضافه کردن گزینه هشدار پاپ‌آپ هنگام کلیک روی دکمه ثبت سفارش
* جداسازی کدهای CSS و JavaScript به فایل‌های خارجی برای عملکرد بهتر
* حذف وابستگی به کلیدهای API خارجی برای اطمینان بیشتر
* اضافه کردن اطلاعات تماس ایمیل نویسنده
* بهینه‌سازی و پاکسازی کد
* بهبود عملکرد کلی و سرعت بارگذاری

= ویژگی‌ها =

* نمایش هشدار شیک و ساده در صفحه پرداخت
* تشخیص هوشمند کشور کاربر با استفاده از API سرویس ipapi.co (بدون نیاز به کلید API)
* پنل تنظیمات در مدیریت وردپرس
* امکان تنظیم متن هشدار دلخواه به زبان فارسی
* گزینه نمایش هشدار به همه کاربران یا فقط کاربران خارج از ایران
* امکان انتخاب بین هشدار ثابت یا پاپ‌آپ
* طراحی واکنش‌گرا و سازگار با موبایل
* پشتیبانی از طرح راست به چپ (RTL)