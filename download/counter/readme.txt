DOWNLOAD COUNTER

ImpressPages CMS plugin


INSTALL

1. Upload folder "download" to "ip_plugins" directory of your website.
2. Login to administration area
3. Go to developer>modules and press "install".


INTEGRATE INTO TEMPLATE

you can use this code to generate download link anywhere in template:

<?php

require_once(BASE_DIR.PLUGIN_DIR.'download/counter/module.php');
$file = BASE_DIR.IMAGE_DIR.'example.jpg';
$file = BASE_DIR.VIDEO_DIR.'example.flv';
$file = BASE_DIR.FILE_DIR.'example.doc';
$link = \Modules\download\counter\Module::getDownloadLink($file);
echo ($link);

?>

These lines get count of downloads:

<?php

require_once(BASE_DIR.PLUGIN_DIR.'download/counter/module.php');
$downloadCount = \Modules\download\counter\Module::getFileCount($file);
echo ($downloadCount);

?>


You can group your downloads by your needs. You can put additional
parameter to link generation class and use another function to get count of downloads related to group:

$link = \Modules\download\counter\Module::getDownloadLink($file, (int)$groupId); //generate link associated to groupId. $groupId is any integer number.

$downloadCount = \Modules\download\counter\Module::getGroupCount($groupId); //get the number of downloads, associated to this group.



CONFIGURATION OPTIONS

You can configure which file extensions are allowed or restricted.

By default this plugin allows all type of files to be downloaded from these directories and subdirectories: 

BASE_DIR.FILE_DIR
BASE_DIR.IMAGE_DIR
BASE_DIR.AUDIO_DIR
BASE_DIR.VIDEO_DIR


If you wish to change these settings, copy config.php file to ip_configs\download\counter directory and edit required configuration options.



