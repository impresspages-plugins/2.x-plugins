<?php
/**
 * @package	ImpressPages
 * @copyright	Copyright (C) 2011 ImpressPages LTD.
 * @license	GNU/GPL, see ip_license.html
 */


namespace Modules\display_content\associated_images;

if (!defined('BACKEND')) exit;

require_once(__DIR__.'/db.php');

class ElementPages extends \Modules\developer\std_mod\Element { //data element in area

	public $recordToOptionTable; //record to option many to many relation table
	public $recordToOptionRecordReference; //reference field to record
	public $recordToOptionOptionReference1; //reference field to option
	public $recordToOptionOptionReference2; //reference field to option
	public $recordToOptionOptionReference3; //reference field to option
	
	function __construct($variables) {
		parent::__construct($variables);
		
		$this->recordToOptionTable = 'm_display_content_associated_images_to_page';
		$this->recordToOptionRecordReference = 'imageId';
		$this->recordToOptionOptionReference1 = 'pageId';
		$this->recordToOptionOptionReference2 = 'zoneName';
		$this->recordToOptionOptionReference3 = 'languageId';
		
		$this->options = $this->_getOptions(); //get available options from database
	}

	/**
	 * HTML in new record form.
	 * @param string $prefix unique field name prefix
	 * @param int $parentId reference to another table if this record belongs to it.
	 * @param Area $area area class of currently editable table
	 * @return string HTML
	 */
	function printFieldNew($prefix, $parentId, $area) {
		$html = new \Modules\developer\std_mod\StdModHtmlOutput();
		foreach ($this->options as $languageKey => $language) {
			$name = $prefix . '_' . $language['id'] . '_';
			$html->html('<br /><input type="checkbox" class="stdModBox" name="' . htmlspecialchars($name) . '" />');
			$html->html('<span class="label">' . htmlspecialchars($language['title']) . '</span><br />');
			foreach ($language['zones'] as $zoneKey => $zone) {

				$name = $prefix . '_' . $language['id']. '_' . $zoneKey . '_';
				
				$html->html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="stdModBox" name="' . htmlspecialchars($name) . '" />');
				$html->html('<span class="label">' . htmlspecialchars($zone['title']) . '</span><br />');
                if (count($zone['options']) == 0) {
                    continue;
                }
				foreach ($zone['options'] as $optionKey => $value) {
		
					$name = $prefix . '_' . $language['id']. '_' . $zoneKey. '_' . $value[0];
					$html->html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="stdModBox" name="' . htmlspecialchars($name) . '" />');
					$html->html('<span class="label">' . htmlspecialchars($value[1]) . '</span>');
					$html->html('<br />');
				}
			}
		}
		return $html->html;
	}

	/**
	 * HTML in field update form
	 * @param string $prefix unique field name prefix
	 * @param int $parentId reference to another table if this record belongs to it.
	 * @param Area $area area class of currently editable table
	 * @return string HTML
	 */
	function printFieldUpdate($prefix, $record, $area) {
		$html = new \Modules\developer\std_mod\StdModHtmlOutput();

		$valueIndex = array();
		$sql = "select * from `" . DB_PREF . $this->recordToOptionTable . "` where `" . $this->recordToOptionRecordReference . "` = " . (int) $record[$area->dbPrimaryKey] . " ";
		$rs = mysql_query($sql);
		if ($rs) {
			while ($lock = mysql_fetch_assoc($rs)) {
				$valueIndex[$lock['languageId'].'_'.$lock['zoneName'].'_'.$lock['pageId']] = 1;
			}
		} else {
			trigger_error($sql . ' ' . mysql_error());
		}


		foreach ($this->options as $languageKey => $language) {
			$name = $prefix . '_' . $language['id'] . '_';
			if (isset($valueIndex[$language['id'].'__'])) {
				$html->html('<br /><input checked="checked" type="checkbox" class="stdModBox" name="' . htmlspecialchars($name) . '" />');
			} else {
				$html->html('<br /><input type="checkbox" class="stdModBox" name="' . htmlspecialchars($name) . '" />');
			}
			$html->html('<span class="label">' . htmlspecialchars($language['title']) . '</span><br />');
			foreach ($language['zones'] as $zoneKey => $zone) {
				$name = $prefix . '_' . $language['id']. '_' . $zoneKey . '_';
				if (isset($valueIndex[$language['id'].'_'.$zoneKey.'_'])) {
					$html->html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input checked="checked" type="checkbox" class="stdModBox" name="' . htmlspecialchars($name) . '" />');
				} else {
					$html->html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="stdModBox" name="' . htmlspecialchars($name) . '" />');
				}
				$html->html('<span class="label">' . htmlspecialchars($zone['title']) . '</span><br />');
                if (count($zone['options']) == 0) {
                    continue;
                }
				foreach ($zone['options'] as $optionKey => $value) {
		
					$name = $prefix . '_' . $language['id']. '_' . $zoneKey. '_' . $value[0];
		
					if (isset($valueIndex[$language['id'].'_'.$zoneKey.'_'.$value[0]])) {
						$html->html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input checked type="checkbox" class="stdModBox" name="' . htmlspecialchars($name) . '" />');
					} else {
						$html->html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="stdModBox" name="' . htmlspecialchars($name) . '" />');
					}
		
					$html->html('<span class="label">' . htmlspecialchars($value[1]) . '</span>');
					$html->html('<br />');
				}
			}
		}
		
		


		return $html->html;
	}

	/**
	 * Check field value after post. Return non empty string on error.
	 * @param string $prefix unique field name prefix
	 * @param int $parentId reference to another table if this record belongs to it.
	 * @param Area $area area class of currently editable table
	 * @return string - error message
	 */
	function checkField($prefix, $action, $area) {
		global $parametersMod;

		if ($action != 'update' || !$this->disabledOnUpdate && $this->visibleOnUpdate) {
			if ($this->required && (!isset($_POST[$prefix]) || $_POST[$prefix] == ''))
			return $std_par = $parametersMod->getValue('developer', 'std_mod', 'admin_translations', 'error_required');
		}
	}

	/**
	 * Generate preview HTML of field value. Used in list of records.
	 * @param array $record table record array
	 * @param Area $area area class of currently editable table
	 * @return string Field value preview
	 */
	function previewValue($record, $area) {
		return '';
	}





	/**
	 * Process update of existing row.
	 * @param string $prefix unique field name prefix
	 * @param int $rowId id of updated record
	 * @param Area $area area class of currently editable table
	 * @return null
	 */
	function processUpdate($prefix, $rowId, $area) {

		$sql = "delete from `" . DB_PREF . $this->recordToOptionTable . "` where `" . $this->recordToOptionRecordReference . "` = " . (int) $rowId . " ";
		$rs = mysql_query($sql);
		if ($rs) {
			foreach ($this->options as $languageKey => $language) {
				if (isset($_REQUEST['' . $prefix . '_' . $language['id'] . '_'])) {
					Db::insertLanguageImage($language['id'], (int) $rowId);
				}
		
				foreach ($language['zones'] as $zoneKey => $zone) {
					if (isset($_REQUEST['' . $prefix . '_' . $language['id'] . '_' . $zoneKey . '_'])) {
						Db::insertZoneImage($language['id'], $zoneKey, (int) $rowId);
					}
					foreach ($zone['options'] as $optionKey => $value) {
						if (isset($_REQUEST['' . $prefix . '_' . $language['id']. '_' . $zoneKey. '_' . $value[0]])) {
							Db::insertPageImage($language['id'], $zoneKey, $value[0], (int) $rowId);
						}
						
					}
				}
			}
		} else {
			trigger_error($sql . ' ' . mysql_error());
		}
	}

	/**
	 * Process new row insertion
	 * @param string $prefix unique field name prefix
	 * @param int $lastInsertId id of recently inserted row
	 * @param Area $area area class of currently editable table
	 * @return null
	 */
	function processInsert($prefix, $lastInsertId, $area) {

		$rowId = $lastInsertId;
		$sql = "delete from `" . DB_PREF . $this->recordToOptionTable . "` where `" . $this->recordToOptionRecordReference . "` = " . (int) $rowId . " ";
		$rs = mysql_query($sql);
		if ($rs) {
			foreach ($this->options as $languageKey => $language) {
				if (isset($_REQUEST['' . $prefix . '_' . $language['id'] . '_'])) {
					Db::insertLanguageImage($language['id'], (int) $rowId);
				}
		
				foreach ($language['zones'] as $zoneKey => $zone) {
					if (isset($_REQUEST['' . $prefix . '_' . $language['id'] . '_' . $zoneKey . '_'])) {
						Db::insertZoneImage($language['id'], $zoneKey, (int) $rowId);
					}
					foreach ($zone['options'] as $optionKey => $value) {
						if (isset($_REQUEST['' . $prefix . '_' . $language['id']. '_' . $zoneKey. '_' . $value[0]])) {
							Db::insertPageImage($language['id'], $zoneKey, $value[0], (int) $rowId);
						}
						
					}
				}
			}
		} else {
			trigger_error($sql . ' ' . mysql_error());
		}
	}

	/**
	 * Delete existing record
	 * @param Area $area area class of currently editable table
	 * @param int $id deleted record id
	 * @return null
	 */
	function processDelete($area, $id) {
		
		$sql = "delete from `" . DB_PREF . $this->recordToOptionTable . "` where `" . $this->recordToOptionRecordReference . "` = " . (int) $id . " ";
		$rs = mysql_query($sql);
		if (!$rs) {
			trigger_error($sql . ' ' . mysql_error());
		}
	}

	/**
	 * Return array of fields and values that need to be set on update or insert.
	 *
	 * reutrn example:
	 * array("name"=>"dbFieldName", "value"=>"Lorem ipsum")
	 *
	 * we process insert / update / delete manually by overriding appropriate methods.
	 * We don't need to add any values to current table so this method implementation is empty.
	 *
	 * @param string $action update or insert
	 * @param string $prefix unique field name prefix
	 * @param Area $area area class of currently editable table
	 * @return array of database key and value need to be inserted / updated
	 */
	public function getParameters($action, $prefix, $area) {

	}
	
	
	//option values. Eg. array(array("key", "value"), array("key2", "value2"), array("key3", "value3")...).
	/**
	* Get option values from database
	* Returning array example:
	* array(
	* 	array("key1", "value1"),
	*  array("key2", "value2"),
	*  array("key3", "value3"),
	*  ...
	* )
	*
	* @return array array of key and value paris.
	*/
	private function _getOptions($parent = null, $prefix = '') {
		global $site;
		global $parametersMod;
		
		
		$tmpExcludedZones = explode("\n", $parametersMod->getValue('display_content', 'associated_images', 'options', 'excluded_zones'));		
		$excludedZones = array();
        $excludedZonesChilds = array();
		foreach($tmpExcludedZones as $excludedZone) {
            if(substr($excludedZone,-1)=='*')
            {
                $excludedZone=str_replace("*","",$excludedZone);
                $excludedZonesChilds[trim($excludedZone)]= 1;
                continue;
            }
			$excludedZones[trim($excludedZone)] = 1;
		}
		$languages = $site->getLanguages();//get all languages including hidden
		
		$answer = array();
		$zones = $site->getZones();

		foreach($languages as $language) {
			$answer[$language->getId()] = array('id' => $language->getId(), 'title' => $language->getShortDescription());
			$answer[$language->getId()]['zones'] = array();
			foreach($zones as $key => $zone) {
				if (!isset($excludedZones[$zone->getName()])) {
					$answer[$language->getId()]['zones'][$zone->getName()] = array('title' => $zone->getTitle(), 'name' => $zone->getName());
                    $answer[$language->getId()]['zones'][$zone->getName()]['options'] = (!isset($excludedZonesChilds[$zone->getName()]) ? $this->_getPages($zone, $language->getId()) : array());
				}
			}
		}
		return $answer;
	}

	private function _getPages($zone, $language_id, $parent = null, $prefix = ''){
		$answer = array();
		$elements = $zone->getElements($language_id, $parent);

    if ($elements) {
  		foreach($elements as $elementKey => $element) {
  			$answer[] = array($element->getId(), $prefix .  $element->getButtonTitle());
  			$answer = array_merge($answer, $this->_getPages($zone, $language_id, $element->getId(), '—'.$prefix));
  		}
		}
		//'—'.$prefix

		return $answer;
		 

	}	

}