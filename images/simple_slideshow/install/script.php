<?php

namespace Modules\images\simple_slideshow;

if (!defined('CMS')) exit; //this file can't bee accessed directly

class Install{

    public function execute(){

        $sql="
        CREATE TABLE IF NOT EXISTS `".DB_PREF."m_images_simple_slideshow` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `row_number` int(11) NOT NULL,
          `title` varchar(255) DEFAULT NULL,
          `description` varchar(255) DEFAULT NULL,
          `image` varchar(255) DEFAULT NULL,
          `visibility` tinyint(1) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=121 ;
        ";

        $rs = mysql_query($sql);

        if(!$rs){
            trigger_error($sql." ".mysql_error());
        }

    }
}
