gettext's .po to .mo compiler... on-line
========================================

This is a tiny app that allow your users to upload their gettext's .po files and download them compiled into .mo files. Compilation is done via msgfmt command.

Requirements
-------

 * PHP 5+ and FileInfo extension (included in PHP 5.3+).
 * GNU/Linux (it will probably work in other OS, but has not been tested).

Install
-------

To install this app in your server, you need a working web server with PHP 5+ and, of course, the msgfmt command working (if you are using Debian/Ubuntu, you can install it with the `gettext` package). 

Clone the git repo in your public directory and edit the init.php file to meet your needs:

 * `RECAPTCHA_PUB`: put here your ReCaptcha public key. You can get one here: https://www.google.com/recaptcha/admin/create
 * `RECAPTCHA_PRIV`: your ReCaptcha private key
 * `TMP_DIR`: the absolute path to your files/ dir, where uploaded and compiled files will be stored.
 * `FILES_PUBLIC`: the public relative path to your files/ dir, usually '/files'.
 * `CONTACT`: your e-mail address, so your users can contact you if something goes wrong.
 * `MAX_FILE_SIZE`: max file size for uploaded files, in bytes.
 * `ALLOW_NOCAPTCHA`: allow bypass Captcha verification by adding the ?nocaptcha=1 argument to the app's URL.
 * `FB_APP_ID`: your Facebook app ID, if you want to enable OG app tracking
 * `FB_API_KEY`: your Facebook API Key for that App.
 * `MAIN_TITLE`: the site title, which is shown in <title> tag, meta description and some other places.

Contact me!
-----------

Any doubts or comments? Don't hesitate to contact me on isra00@gmail.com