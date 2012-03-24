

ImpressPages CMS plugin


INSTALL

1. Upload folder "images" to "ip_plugins" directory of your website.
2. Login to administration area
3. Go to "Developer -> Modules" and press "install".
4. Refresh the browser (F5)
5. Look for "Images -> Simple slideshow" tab in your administration panel. Add some photos there.
6. Open ip_themes/lt_pagan/main.php (or other layout) and add this code:

<?php echo $site->generateBlock('simpleSlideshow'); ?>

Enjoy slideshow.



