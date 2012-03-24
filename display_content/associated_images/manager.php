<?php    
/**
 * @package	ImpressPages
 * @copyright	Copyright (C) 2011 ImpressPages LTD.
 * @license	GNU/GPL, see ip_license.html
 */


namespace Modules\display_content\associated_images;    
    
if (!defined('BACKEND')) exit;  //this file can't be acessed directly    
    
require_once(__DIR__.'/items_area.php'); //include class that describes database structure and how to manage the records in it    
    
class Manager{    
  var $standardModule;     
       
  function __construct() {    
    $itemsArea = new ItemsArea();  //this class is in file items_area.php    
    $this->standardModule = new \Modules\developer\std_mod\StandardModule($itemsArea); //create management tool    
  }    
    
  function manage() {    
    return $this->standardModule->manage();  //return management tools    
  }    
}    