ASSOCIATED IMAGES

ImpressPages CMS plugin


INSTALL

1. Upload folder "display_content" to "ip_plugins" directory of your website.
2. Login to administration area
3. Go to developer > modules and press "install".
4. Refresh web browser (F5).
5. Now you will see a new tab Display content -> Associated images. Here you can add images and associate them to required pages (Elements), zones or languages.



CONFIGURATION

Each time you upload new photo, plugin creates two versions of it: regular and big.
You can change cropping options on tab Developer -> Modules config -> Display content -> Associated images -> Options.

New features (v1.04):

1. Plugin is now language-aware (this is more bugfix than feature tbh)
2. In case you don't want to display elements of zone, but want zone to appear in selection, now you can append "*" - asterisk to the end of zone name in exclude option.
This gives you ability to ignore/not display elements of zone in new/update window, but show zone itself.


USAGE

IMPORTANT!!! First of all don't forget to add some photos. See step 4 and 5.


To generate left menu including images, use this code. Replace 'left' to any other
zone you like.
<?php
      require_once (BASE_DIR.PLUGIN_DIR.'display_content/associated_images/menu.php');
      $menuLeft = new \Modules\display_content\associated_images\Menu();
      echo $menuLeft->generateSubmenu('left', null, 2);  //$zoneName, $parentElementId, $depthLimit
?>
Place this code in required place of your theme (eg. ip_themes/ip_default/main.php instead
of current 'left' menu generation script).
This script simply adds images to menu list. Use CSS to style them as you like. 

   
ADD IMAGES TO THE HEADER OF WEBSITE


To print images, use these code examples.
Place them in required place of your theme (eg ip_themes/ip_default/main.php):

<?php

<?php
  //get images, associated to current language
  require_once(BASE_DIR.PLUGIN_DIR.'display_content/associated_images/db.php');
  $images = \Modules\display_content\associated_images\Db::getLanguageImages();
?>

<?php
  //get images, associated to current zone
  require_once(BASE_DIR.PLUGIN_DIR.'display_content/associated_images/db.php');
  $images = \Modules\display_content\associated_images\Db::getZoneImages();
?>

<?php
  //get images, associated to current page
  require_once(BASE_DIR.PLUGIN_DIR.'display_content/associated_images/db.php');
  $images = \Modules\display_content\associated_images\Db::getElementImages();
?>

Each of these three functions returns an array of images. Because each page might have
many images associated to it.


This script will display first immage associated to current page. So if you will
add this code to ip_themes/ip_default/main.php, you will see new image on each page
(Don't forget to add those images in DisplayContent -> AssociatedImages tab in administration panel).
<?php
  require_once(BASE_DIR.PLUGIN_DIR.'display_content/associated_images/db.php');
  $images = \Modules\display_content\associated_images\Db::getElementImages();
  if (isset($images[0])) {
     echo '<img src="'.BASE_URL.IMAGE_DIR.$images[0]['image'].'" alt="'.htmlspecialchars($images[0]['title']).'" />';
  }
?>  


This script will display all images associated to current page. 
<?php
  require_once(BASE_DIR.PLUGIN_DIR.'display_content/associated_images/db.php');
  $images = \Modules\display_content\associated_images\Db::getElementImages();
  foreach ($images as $key => $image) {
     echo 'Image<br /> <img src="'.BASE_URL.IMAGE_DIR.$image['image'].'" alt="'.htmlspecialchars($image['title']).'" /> <br />';
     echo 'Big image<br /> <img src="'.BASE_URL.IMAGE_DIR.$image['image_big'].'" alt="'.htmlspecialchars($image['title']).'" /> <br />';
     echo '-------------<br />';
  }
?>  
  


ADVANCED

You can get images not only for current, but also for specific page / zone / language 

<?php

require_once(BASE_DIR.PLUGIN_DIR.'display_content/associated_images/db.php');

$images = \Modules\display_content\associated_images\Db::getLanguageImages($languageId);
$images = \Modules\display_content\associated_images\Db::getZoneImages($languageId, $zoneName);
$images = \Modules\display_content\associated_images\Db::getElementImages($element);


?>


