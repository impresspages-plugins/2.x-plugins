<?php                  
                  
namespace Modules\display_content\associated_images;            
                  
if (!defined('CMS')) exit; //this file can't bee accessed directly                  
                  
class Install{                  
                  
  public function execute(){                  
                  
    $sql="                  
		CREATE TABLE IF NOT EXISTS `".DB_PREF."m_display_content_associated_images` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `row_number` int(11) NOT NULL,
		  `title` varchar(255) DEFAULT NULL,
		  `zoneName` varchar(50) DEFAULT NULL,
		  `pageId` varchar(50) DEFAULT NULL,
		  `image` varchar(255) DEFAULT NULL,
		  `image_big` varchar(255) DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=138 ;
		
    ";
                      
    $rs = mysql_query($sql);                  
                      
    if(!$rs){                   
      trigger_error($sql." ".mysql_error());                  
    }

    $sql="                  
		CREATE TABLE IF NOT EXISTS `".DB_PREF."m_display_content_associated_images_to_page` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `imageId` int(11) NOT NULL,
		  `languageId` int(11) NOT NULL,
		  `zoneName` varchar(50) DEFAULT NULL,
		  `pageId` varchar(50) DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;  
		
    ";
                      
    $rs = mysql_query($sql);                  
                      
    if(!$rs){                   
      trigger_error($sql." ".mysql_error());                  
    }

    
              
    
                      
  }                  
}