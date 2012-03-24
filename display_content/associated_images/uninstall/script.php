<?php
/**
 * @package   ImpressPages
 * @copyright Copyright (C) 2009 JSC Apro media.
 * @license   GNU/GPL, see ip_license.html
 */
namespace Modules\display_content\associated_images;   

if (!defined('CMS')) exit;

class Uninstall{

    public function execute(){


        $sql = "select `image`, `image_big` from `".DB_PREF."m_display_content_associated_images` where 1";
        $rs = mysql_query($sql);
        if($rs){
            while($lock = mysql_fetch_assoc($rs)){
                if($lock['image'] != '' && file_exists(BASE_DIR.IMAGE_DIR.$lock['image'])){
                    unlink(BASE_DIR.IMAGE_DIR.$lock['image']);
                }
                if($lock['image_big'] != '' && file_exists(BASE_DIR.IMAGE_DIR.$lock['image_big'])){
                    unlink(BASE_DIR.IMAGE_DIR.$lock['image_big']);
                }
            }
        }


        $sql="
        DROP TABLE IF EXISTS `".DB_PREF."m_display_content_associated_images`;
        ";

        $rs = mysql_query($sql);

        if(!$rs){
            trigger_error($sql." ".mysql_error());
        }



        $sql="
        DROP TABLE IF EXISTS `".DB_PREF."m_display_content_associated_images_to_page`;
        ";

        $rs = mysql_query($sql);

        if(!$rs){
            trigger_error($sql." ".mysql_error());
        }
    }
}

