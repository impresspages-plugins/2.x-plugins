<?php
/**
 * @package   ImpressPages
 * @copyright Copyright (C) 2009 JSC Apro media.
 * @license   GNU/GPL, see ip_license.html
 */

namespace Modules\search\popular_searches;  

if (!defined('CMS')) exit;


require_once (__DIR__.'/cron.php');
      

class System{


  
  public function catchEvent($moduleGroup, $moduleName, $event, $parameters){
    if($moduleGroup == 'administrator' && $moduleName == 'system' && $event == 'cache_cleared'){
      $cron = new Cron();
      $cron->updateCache();
    } 
  }
  
}