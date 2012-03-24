<?php
/**
 * @package   ImpressPages
 * @copyright Copyright (C) 2009 JSC Apro media.
 * @license   GNU/GPL, see ip_license.html
 */
namespace Modules\search\popular_searches;

if (!defined('CMS')) exit;




class Module{

  
  public static function generateList(){
    global $parametersMod;
    global $site;
    
    $searchZone = $site->getZoneByModule('administrator', 'search');
    $answer = '';
    if($searchZone){
      $searchesCache = $parametersMod->getValue('search','popular_searches','cache','popular_searches');
      $searches = explode("\n", $searchesCache);
      $links = array();
      foreach($searches as $key => $search){
        $links[] = array($search, $site->generateUrl(null, $searchZone->getName(), null, array("q" => $search))); 
      }
      $site->requireTemplate('search/popular_searches/template.php');
      $answer .= Template::generateList($links);
    } else {
      trigger_error('Search zone does not exist. You need to create new zone with associated group/module administrator/search');
      return false;
    }
    return $answer;
  }

}






