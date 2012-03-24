<?php
/**
 * @package   ImpressPages
 * @copyright Copyright (C) 2009 JSC Apro media.
 * @license   GNU/GPL, see ip_license.html
 */
namespace Modules\download\counter;

if (!defined('CMS')) exit;

class Install{

  public function execute(){
    $sql="
CREATE TABLE IF NOT EXISTS `".DB_PREF."m_download_counter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";
    
    $rs = mysql_query($sql);
    
    if(!$rs){ 
      trigger_error($sql." ".mysql_error());
    }
    
    
    

  }
}
