POPULAR SEARCHES

ImpressPages CMS plugin


INSTALL

1. Upload folder "search" to "ip_plugins" directory of your website.
2. Login to administration area
3. Go to "Developer -> Modules" and press "install".


INTEGRATE INTO TEMPLATE

<?php

require_once(BASE_DIR.PLUGIN_DIR.'/search/popular_searches/module.php');
          
echo \Modules\search\popular_searches\Module::generateList();          

?>
      

NOTE

After installation the list of popular searches will be empty.
The list is updated once a day when cron is executed.
You can update the list of searches by clearing the cache in "Administratpr -> System" tab.