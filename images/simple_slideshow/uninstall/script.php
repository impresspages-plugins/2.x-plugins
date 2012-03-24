<?php

namespace Modules\images\simple_slideshow;

if (!defined('CMS')) exit; //this file can't bee accessed directly

class Uninstall{
    public function execute(){

        $sql = "SELECT * FROM `".DB_PREF."m_images_simple_slideshow` WHERE `image` <> '' ";
        $rs = mysql_query($sql);
        if($rs){
            while($lock = mysql_fetch_assoc($rs)){
                if ($lock['image'] == '') {
                    continue;
                }
                
                $imagePath = BASE_DIR.IMAGE_DIR.$lock['image'];
                if(file_exists($imagePath) && !is_dir($imagePath) ){
                    unlink($imagePath);
                }
            }
        }



        $sql = "DROP TABLE `".DB_PREF."m_images_simple_slideshow` ";
        $rs = mysql_query($sql);
        if(!$rs){
            trigger_error($sql." ".mysql_error());
        }

    }
}