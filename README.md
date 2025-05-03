# Smart VPN Warning for WooCommerce

Display a smart warning to users to turn off their VPN during checkout in WooCommerce.

## Features

- Display a simple and elegant warning (no popup) on the checkout page
- Smart country detection using IP Geolocation API
- Admin settings panel in WordPress dashboard
- Customizable warning message (supports both English and Persian)
- Option to show warning to all users or only to users outside Iran
- Caching system to reduce API requests and improve speed
- Responsive design and mobile-friendly
- RTL support for Persian websites

## Installation

1. Download the plugin zip file
2. Go to your WordPress admin panel and navigate to `Plugins > Add New > Upload Plugin`
3. Select the zip file and upload it
4. Activate the plugin

Or using FTP:

1. Extract the zip file
2. Upload the `smart-vpn-warning` folder to your `/wp-content/plugins/` directory
3. Activate the plugin from your WordPress admin panel

## Configuration

1. After activating the plugin, go to `Settings > VPN Warning`
2. Get an API key from [ipgeolocation.io](https://ipgeolocation.io/)
3. Enter your API key in the appropriate field
4. Customize the warning message if needed (both English and Persian versions)
5. If you want to show the warning to all users (without checking their country), enable the corresponding option
6. Save your settings

## Requirements

- WordPress 5.0 or higher
- WooCommerce 3.0 or higher
- A free API key from [ipgeolocation.io](https://ipgeolocation.io/)

## Frequently Asked Questions

### Is this plugin compatible with my Persian theme?
Yes, this plugin is fully compatible with RTL and Persian themes.

### Will this plugin slow down my website?
No, this plugin uses a caching system and only connects to the API once per hour.

### Can I display the warning only on the checkout page?
Yes, by default, this plugin only displays the warning on the WooCommerce checkout page.

## Support

For bug reports or feature suggestions, please create an [Issue](https://github.com/ahmadesmaeeli81/smart-vpn-warning/issues).

## Contributing

Your contributions to the development of this plugin are welcome. Please submit a Pull Request.

## License

This plugin is released under the GPL v2 or later license.

---

# هشدار هوشمند VPN برای ووکامرس

این افزونه یک هشدار ساده و شیک در صفحه پرداخت ووکامرس نمایش می‌دهد که به کاربران توصیه می‌کند برای انجام موفق پرداخت، VPN خود را خاموش کنند.

## ویژگی‌ها

- نمایش هشدار شیک و ساده (بدون پاپ‌آپ) در صفحه پرداخت
- تشخیص هوشمند کشور کاربر با استفاده از API
- پنل تنظیمات در مدیریت وردپرس
- امکان تنظیم متن هشدار دلخواه (پشتیبانی از زبان‌های فارسی و انگلیسی)
- گزینه نمایش هشدار به همه کاربران یا فقط کاربران خارج از ایران
- سیستم کش برای کاهش تعداد درخواست‌ها به API و افزایش سرعت
- طراحی واکنش‌گرا و سازگار با موبایل
- پشتیبانی از طرح راست به چپ (RTL)

## نصب

1. فایل زیپ افزونه را دانلود کنید
2. به پنل مدیریت وردپرس بروید و به بخش `افزونه‌ها > افزودن > بارگذاری افزونه` بروید
3. فایل زیپ را انتخاب کرده و آپلود کنید
4. افزونه را فعال کنید

یا با استفاده از FTP:

1. فایل زیپ را استخراج کنید
2. پوشه `smart-vpn-warning` را به مسیر `/wp-content/plugins/` در سرور خود آپلود کنید
3. از پنل مدیریت وردپرس، افزونه را فعال کنید

## پیکربندی

1. پس از فعال‌سازی افزونه، به بخش `تنظیمات > هشدار VPN` بروید
2. یک کلید API از سایت [ipgeolocation.io](https://ipgeolocation.io/) دریافت کنید
3. کلید API را در فیلد مربوطه وارد کنید
4. متن هشدار را در صورت نیاز ویرایش کنید (هر دو نسخه فارسی و انگلیسی)
5. اگر می‌خواهید هشدار به همه کاربران (بدون بررسی کشور) نمایش داده شود، گزینه مربوطه را فعال کنید
6. تنظیمات را ذخیره کنید

## پیش‌نیازها

- وردپرس 5.0 یا بالاتر
- ووکامرس 3.0 یا بالاتر
- یک کلید API رایگان از [ipgeolocation.io](https://ipgeolocation.io/)

## سوالات متداول

### آیا این افزونه با قالب فارسی من سازگار است؟
بله، این افزونه به طور کامل با قالب‌های RTL و فارسی سازگار است.

### آیا استفاده از این افزونه به سرعت سایت من آسیب می‌زند؟
خیر، این افزونه از سیستم کش استفاده می‌کند و فقط یک بار در هر ساعت با API ارتباط برقرار می‌کند.

### آیا می‌توانم هشدار را فقط در صفحه پرداخت نمایش دهم؟
بله، این افزونه به طور پیش‌فرض فقط در صفحه پرداخت ووکامرس نمایش داده می‌شود.

## حمایت و پشتیبانی

برای گزارش مشکلات یا پیشنهادات خود، لطفاً یک [Issue](https://github.com/ahamdesmaeeli81/smart-vpn-warning/issues) ایجاد کنید.

## مشارکت

مشارکت شما در توسعه این افزونه استقبال می‌شود. لطفاً یک Pull Request ارسال کنید.

## لایسنس

این افزونه تحت لایسنس GPL v2 یا بالاتر منتشر شده است.