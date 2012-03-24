<?php
/**
 * @package   ImpressPages
 * @copyright Copyright (C) 2009 JSC Apro media.
 * @license   GNU/GPL, see ip_license.html
 */

namespace Modules\download\counter;

if (!defined('FRONTEND')&&!defined('BACKEND')) exit;


class Module{
  public static function getDownloadLink($file, $groupId = null, $requiredName = null){
    global $site;
    $params = array('module_group'=>'download', 'module_name' => 'counter', 'file' => $file);
    if($groupId !== null){
      $params['group_id'] = $groupId;
    } 
    if($requiredName !== null){
      $params['required_name'] = $requiredName;
    }
    
    return $site->generateUrl(null, null, null, $params);
  }
  
  public static function getFileCount($file){
    require_once(__DIR__.'/db.php');
    if(strpos($file, BASE_DIR) === 0){
      $relativePath = str_replace(BASE_DIR, '', $file);
    } else {
      $relativePath = $file;
    }
    return Db::getFileCount($relativePath);
  }
  
  public static function getGroupCount($groupId){
    require_once(__DIR__.'/db.php');
    return Db::getGroupCount($groupId);
  }  
  
  
  
}