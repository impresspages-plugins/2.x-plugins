<?php
/**
 * @package   ImpressPages
 * @copyright Copyright (C) 2009 JSC Apro media.
 * @license   GNU/GPL, see ip_license.html
 */
namespace Modules\search\popular_searches;

if (!defined('CMS')) exit;




class Cron{
  function __construct(){
  }
  
  function execute($options){
    if($options->firstTimeThisDay){
      $this->updateCache();
    }
  }
  
  public function updateCache(){
    global $parametersMod;
    global $log;
    $searchLogs = $log->lastLogs($parametersMod->getValue('search','popular_searches','options','how_old')*24*60, 'administrator/search', 'search');
    $languages = \Frontend\Db::getLanguages();
    foreach($languages as $key => $language){
      $searches = array();  
      foreach($searchLogs as $key => $searchLog){
        if($searchLog['value_int'] == $language['id'] || $searchLog['value_int'] === null){
          if(!isset($searches[$searchLog['value_str']])){
            $searches[$searchLog['value_str']] = 1;
          } else {
            $searches[$searchLog['value_str']]++;
          }
        }
        asort($searches);
        $cache = '';
        $number = 0;
        foreach($searches as $key => $search){
          $number++;
              if($number > $parametersMod->getValue('search', 'popular_searches', 'options', 'popular_searches_count')){
            break;
          }
          
          if($cache != ''){
            $cache = "\n".$cache;
          }
          $cache = $key.$cache; 
          
        }
        $parametersMod->setValue('search', 'popular_searches', 'cache', 'popular_searches', $cache, $language['id']);          
      }
    }
  }
}



