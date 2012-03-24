<?php
/**
 * @package	ImpressPages
 * @copyright	Copyright (C) 2011 ImpressPages LTD.
 * @license	GNU/GPL, see ip_license.html
 */


namespace Modules\display_content\associated_images;

if (!defined('BACKEND')) exit;  //this file can't be accessed directly

require_once(BASE_DIR.MODULE_DIR.'developer/std_mod/std_mod.php'); //include standard module to manage data records

class ItemsArea extends \Modules\developer\std_mod\Area{  //extending standard data management module area

	function __construct(){
		global $parametersMod;  //global object to get parameters

		parent::__construct(
			array(
		      'dbTable' => 'm_display_content_associated_images',  //table of data we need to manage                
		      'title' => $parametersMod->getValue('display_content', 'associated_images', 'translations', 'associated_images'), //Table title above the table (choose any)                
		      'dbPrimaryKey' => 'id',  //Primary key of that table                
		      'searchable' => true,  //User will have search button or not                
		      'orderBy' => 'row_number',  //Database field, by which the records should be ordered by default                
		      'sortable' => true,  //Does user have a right to change the order of records                
		      'sortField' => 'row_number'  //Database field which is used to sort records                
			)
		);
		 
		$element = new \Modules\developer\std_mod\ElementText(  //text field
			array(
			    'title' => $parametersMod->getValue('display_content', 'associated_images', 'translations', 'title'),  //Field name                
			    'showOnList' => true,  //Show field value in list of all records                
			    'dbField' => 'title',  //Database field name                
			    'searchable' => true  //Allow to search by this field                
			)
		);
		$this->addElement($element);

		
		

	    $copies  = array();

	    $copy = array(
	      'width' => $parametersMod->getValue('display_content', 'associated_images', 'options', 'image_big_width'),
	      'height' => $parametersMod->getValue('display_content', 'associated_images', 'options', 'image_big_height'),
	      'quality' => $parametersMod->getValue('display_content', 'associated_images', 'options', 'image_big_quality'),
	      'dbField' => 'image_big',
	      'type' => $parametersMod->getValue('display_content', 'associated_images', 'options', 'image_big_crop'),
	      'forced' => $parametersMod->getValue('display_content', 'associated_images', 'options', 'image_big_scale') ? 1 : 0,
	      'destDir' => IMAGE_DIR            
	    );
	    $copies[] = $copy;     
	    
	    
	    
	    $copy = array(
	      'width' => $parametersMod->getValue('display_content', 'associated_images', 'options', 'image_width'),
	      'height' => $parametersMod->getValue('display_content', 'associated_images', 'options', 'image_height'),
	      'quality' => $parametersMod->getValue('display_content', 'associated_images', 'options', 'image_quality'),
	      'dbField' => 'image',
	      'type' => $parametersMod->getValue('display_content', 'associated_images', 'options', 'image_crop'),
	      'forced' => $parametersMod->getValue('display_content', 'associated_images', 'options', 'image_scale') ? 1 : 0,
	      'destDir' => IMAGE_DIR            
	    );
	    $copies[] = $copy;     
	
	
	    
	    $element = new \Modules\developer\std_mod\ElementImage(
	    array(     
	    'title' => $parametersMod->getValue('display_content', 'associated_images', 'translations', 'image'),
	    'showOnList' => true,
	    'searchable' => true,
	    'copies' => $copies
	    )
	    );
	    $this->addElement($element);       		
		
		
		
		require_once(__DIR__.'/element_pages.php');
		$element = new ElementPages(
			array (
				'title' => $parametersMod->getValue('display_content', 'associated_images', 'translations', 'associated_pages'),
			    'showOnList' => false,  //Show field value in list of all records                
			    'previewLength' => 50,             
			    'searchable' => false
			)			
		);
		$this->addElement($element);
		


	}
	

}