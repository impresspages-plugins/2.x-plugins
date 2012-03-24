<?php

namespace Modules\images\simple_slideshow;

if (!defined('BACKEND')) exit;  //this file can't be accessed directly                

require_once(BASE_DIR.MODULE_DIR.'developer/std_mod/std_mod.php'); //include standard module to manage data records                
                
class ItemsArea extends \Modules\developer\std_mod\Area{  //extending standard data management module area
                
  function __construct(){
    global $parametersMod;  //global object to get parameters
                
    parent::__construct(
      array(
      'dbTable' => 'm_images_simple_slideshow',  //table of data we need to manage
      'title' => 'Slideshow', //Table title above the table (choose any)
      'dbPrimaryKey' => 'id',  //Primary key of that table
      'searchable' => true,  //User will have search button or not
      'orderBy' => 'row_number',  //Database field, by which the records should be ordered by default
      'sortable' => true,  //Does user have a right to change the order of records
      'sortField' => 'row_number'  //Database field which is used to sort records
      )
    );

    $element = new \Modules\developer\std_mod\ElementText(  //text field
    array(
        'title' => 'Title',  //Field name
        'showOnList' => true,  //Show field value in list of all records
        'dbField' => 'title',  //Database field name
        'searchable' => true  //Allow to search by this field
    )
    );
    $this->addElement($element);

    $element = new \Modules\developer\std_mod\ElementText(
    array(
        'title' => 'Description',  //Field name
        'showOnList' => true,  //Show field value in list of all records
        'dbField' => 'description', //Database field name
        'searchable' => true  //Allow to search by this field
    )
    );
    $this->addElement($element);
                    
                    
    //Image field
    $copies  = array();
    
    $copy = array(
      'width' => $parametersMod->getValue('images', 'simple_slideshow', 'options', 'image_width'),
      'height' => $parametersMod->getValue('images', 'simple_slideshow', 'options', 'image_height'),
      'quality' => $parametersMod->getValue('images', 'simple_slideshow', 'options', 'quality'), //quality: 0 poor - 100 excelent
      'dbField' => 'image',
      'type' => $parametersMod->getValue('images', 'simple_slideshow', 'options', 'crop_type'), //available options fit - resize to fit, crop - crop image if it don't fit, width - resize to width,  height - resize to height   
      'forced' => 1, //force image to bee exactly 100x75 proportions.
      'destDir' => IMAGE_DIR
    );
    $copies[] = $copy;
    
   
    $element = new \Modules\developer\std_mod\ElementImage(  //text field
    array(
    'title' => 'Image',  //Field name
    'showOnList' => true,  //Show field value in list of all records
    'required' => false, //true if this field is required
    'searchable' => true,  //Allow to search by this field
    'copies' => $copies //describes how many copies of uploaded image need to be stored. Each copy has its own configuratoin (width, height, etc).
    )
    );
    $this->addElement($element);
    
        //Boolean field
    $element = new \Modules\developer\std_mod\ElementBool(  //text field
    array(
    'title' => 'Visible',  //Field name
    'showOnList' => true,  //Show field value in list of all records
    'dbField' => 'visibility',  //Database field name
    'required' => false, //true if this field is required
    'searchable' => false,  //Allow to search by this field
    'defaultValue' => 1
    )
    );
    $this->addElement($element);
  }

}
