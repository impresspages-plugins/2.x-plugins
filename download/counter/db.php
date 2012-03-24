<?php
/**
 * @package   ImpressPages
 * @copyright Copyright (C) 2009 JSC Apro media.
 * @license   GNU/GPL, see ip_license.html
 */
namespace Modules\download\counter;

if (!defined('CMS')) exit;

class Db{

  public static function getFileCount($file){
    $sql = "select count(*) as 'count' from `".DB_PREF."m_download_counter`  
    where `file` = '".mysql_real_escape_string($file)."'";
    $rs = mysql_query($sql);
    if($rs){
      if($lock = mysql_fetch_assoc($rs)){
        return $lock['count'];
      } else {
        return false;
      }      
    }else{
      trigger_error($sql." ".mysql_error());
    }
    return false;
  }

  public static function getGroupCount($groupId){
    $sql = "select count(*) as 'count' from `".DB_PREF."m_download_counter`  
    where `group_id` = '".(int)$groupId."'";
    $rs = mysql_query($sql);
    if($rs){
      if($lock = mysql_fetch_assoc($rs)){
        return $lock['count'];
      } else {
        return false;
      }      
    }else{
      trigger_error($sql." ".mysql_error());
    }
    return false;
  }
  
  
  public static function logDownload($file, $groupId = null){
    $sql = "insert into `".DB_PREF."m_download_counter` set `group_id` = '".(int)$groupId."', `file` = '".mysql_real_escape_string($file)."'";
    $rs = mysql_query($sql);
    if(!$rs){
      trigger_error($sql.' '.mysql_error());
    } 
  }
}