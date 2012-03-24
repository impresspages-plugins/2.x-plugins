<?php
/**
 * @package   ImpressPages
 * @copyright Copyright (C) 2009 JSC Apro media.
 * @license   GNU/GPL, see ip_license.html
 */
namespace Modules\download\counter;

if (!defined('CMS')) exit;

class Config{
  
  public static function getAllowedExtensions(){
    return array(); //return empty array to allow all file extensions
    //return array('odt', 'docx','doc', 'xls', 'ppt', 'txt', 'bmp', 'jpg', 'jpeg', 'gif', 'png');
  }
  
  public static function getRestrictedExtensions(){
    return array(); //return empty array to allow all file extensions
    //return array('php', 'php3', 'php4', 'php5', 'jsp', 'asp', 'exe', 'bin', 'sh');
  }
  
  public static function getAllowedPaths(){ //subdirectories are automatically included
    return array(BASE_DIR.FILE_DIR, BASE_DIR.IMAGE_DIR, BASE_DIR.AUDIO_DIR, BASE_DIR.VIDEO_DIR);
  }
  
  
  
}