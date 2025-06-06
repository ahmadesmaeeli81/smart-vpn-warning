# Smart VPN Warning for WooCommerce

Display a smart warning to users to turn off their VPN during checkout in WooCommerce.

## Features

* Display a simple and elegant warning on the checkout page
* Smart country detection using ipapi.co API (no API key required)
* Admin settings panel in WordPress dashboard
* Customizable warning message in Persian
* Option to show warning to all users or only to users outside Iran
* Option to choose between static box or popup warning
* Responsive design and mobile-friendly
* RTL support for Persian websites

## Changelog

### 1.2
* Added popup warning option when clicking on checkout button
* Separated CSS and JavaScript code into external files for better performance
* Removed dependency on external API keys for better reliability
* Added author email contact information
* Code optimization and cleanup
* Improved overall performance and loading speed

### 1.1
* Improved security with nonce for settings forms
* Changed to free API services (ipify.org and ipapi.co) - no API key required
* Added option to choose between static box or popup warning
* Enhanced error handling and logging
* Removed English warning message (Persian only)
* Updated documentation

### 1.0.2
* Initial release

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
2. Customize the warning message if needed
3. Choose how to display the warning (static box or popup)
4. If you want to show the warning to all users (without checking their country), enable the corresponding option
5. Save your settings

## Requirements

* WordPress 5.0 or higher
* WooCommerce 3.0 or higher
* PHP 7.2 or higher

## Frequently Asked Questions

### Is this plugin compatible with my Persian theme?

Yes, this plugin is fully compatible with RTL and Persian themes.

### Will this plugin slow down my website?

No, this plugin uses free and fast API services to detect user's country.

### Can I display the warning only on the checkout page?

Yes, by default, this plugin only displays the warning on the WooCommerce checkout page.

## Support

For bug reports or feature suggestions, please create an Issue or contact us at info@ahmadesmaeeli.ir

## Contributing

Your contributions to the development of this plugin are welcome. Please submit a Pull Request.

## License

This plugin is released under the GPL v2 or later license.

---

# هشدار هوشمند VPN برای ووکامرس

این افزونه یک هشدار ساده و شیک در صفحه پرداخت ووکامرس نمایش می‌دهد که به کاربران توصیه می‌کند برای انجام موفق پرداخت، VPN خود را خاموش کنند.

## ویژگی‌ها

* نمایش هشدار شیک و ساده در صفحه پرداخت
* تشخیص هوشمند کشور کاربر با استفاده از API سرویس ipapi.co (بدون نیاز به کلید API)
* پنل تنظیمات در مدیریت وردپرس
* امکان تنظیم متن هشدار دلخواه به زبان فارسی
* گزینه نمایش هشدار به همه کاربران یا فقط کاربران خارج از ایران
* امکان انتخاب بین هشدار ثابت یا پاپ‌آپ
* طراحی واکنش‌گرا و سازگار با موبایل
* پشتیبانی از طرح راست به چپ (RTL)

## تغییرات

### 1.2
* اضافه کردن گزینه هشدار پاپ‌آپ هنگام کلیک روی دکمه ثبت سفارش
* جداسازی کدهای CSS و JavaScript به فایل‌های خارجی برای عملکرد بهتر
* حذف وابستگی به کلیدهای API خارجی برای اطمینان بیشتر
* اضافه کردن اطلاعات تماس ایمیل نویسنده
* بهینه‌سازی و پاکسازی کد
* بهبود عملکرد کلی و سرعت بارگذاری

### 1.1
* بهبود امنیت با اضافه کردن nonce برای فرم‌های تنظیمات
* تغییر به سرویس‌های API رایگان (ipify.org و ipapi.co) - بدون نیاز به کلید API
* اضافه کردن امکان انتخاب بین هشدار ثابت یا پاپ‌آپ
* بهبود خطایابی و لاگ‌گذاری
* حذف پیام هشدار انگلیسی (فقط فارسی)
* به‌روزرسانی مستندات

### 1.0.2
* نسخه اولیه

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
2. متن هشدار را در صورت نیاز ویرایش کنید
3. نحوه نمایش هشدار را انتخاب کنید (باکس ثابت یا پاپ‌آپ)
4. اگر می‌خواهید هشدار به همه کاربران (بدون بررسی کشور) نمایش داده شود، گزینه مربوطه را فعال کنید
5. تنظیمات را ذخیره کنید

## پیش‌نیازها

* وردپرس 5.0 یا بالاتر
* ووکامرس 3.0 یا بالاتر
* PHP 7.2 یا بالاتر

## سوالات متداول

### آیا این افزونه با قالب فارسی من سازگار است؟

بله، این افزونه به طور کامل با قالب‌های RTL و فارسی سازگار است.

### آیا استفاده از این افزونه به سرعت سایت من آسیب می‌زند؟

خیر، این افزونه از سرویس‌های API رایگان و سریع برای تشخیص کشور کاربر استفاده می‌کند.

### آیا می‌توانم هشدار را فقط در صفحه پرداخت نمایش دهم؟

بله، این افزونه به طور پیش‌فرض فقط در صفحه پرداخت ووکامرس نمایش داده می‌شود.

## حمایت و پشتیبانی

برای گزارش مشکلات یا پیشنهادات خود، لطفاً یک Issue ایجاد کنید یا با ما از طریق ایمیل info@ahmadesmaeeli.ir تماس بگیرید.

## مشارکت

مشارکت شما در توسعه این افزونه استقبال می‌شود. لطفاً یک Pull Request ارسال کنید.

## لایسنس

این افزونه تحت لایسنس GPL v2 یا بالاتر منتشر شده است.