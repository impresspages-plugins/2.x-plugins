<?php 
/**
 * @package   ImpressPages
 * @copyright Copyright (C) 2009 JSC Apro media.
 * @license   GNU/GPL, see ip_license.html
 */

namespace Modules\search\popular_searches;  
 
if (!defined('FRONTEND')&&!defined('BACKEND')) exit;
class Template {
  
  public static function generateList($searches){
    global $site;
    $answer = '';
    if(sizeof($searches) > 0){
      $list = '';
      foreach($searches as $key => $search){
        if($search[0] != ''){
          $list .= '<li><a href="'.$search[1].'">'.htmlspecialchars($search[0]).'</a></li>';
        }
      }
      
      if($list != ''){
      $answer = '
<ul>
  '.$list.'
</ul>
';
        
      }
    }
    return $answer;
  }
}