<?php

/**
 * @package   ImpressPages
 * @copyright Copyright (C) 2011 ImpressPages LTD.
 * @license   GNU/GPL, see ip_license.html
 */

namespace Modules\marketing\mailerlite;

if (!defined('CMS'))
    exit;

require_once(BASE_DIR . LIBRARY_DIR . 'php/form/standard.php');
require_once (__DIR__ . '/db.php');


class Config {

    public static function getConfigFields() {
        global $parametersMod;

        $fields = array();

        $field = new \Library\Php\Form\FieldText();
        $field->name = 'api_key';
        $field->caption = $parametersMod->getValue('marketing', 'mailerlite', 'translations', 'api_key');
        $field->value = $parametersMod->getValue('marketing', 'mailerlite', 'options', 'api_key');
        $field->note = $parametersMod->getValue('marketing', 'mailerlite', 'translations', 'api_key_explanation');
        $field->required = true;
        $fields[] = $field;

        $field = new \Library\Php\Form\FieldText();
        $field->name = 'group_id';
        $field->caption = $parametersMod->getValue('marketing', 'mailerlite', 'translations', 'group_id');
        $field->value = $parametersMod->getValue('marketing', 'mailerlite', 'options', 'group_id');
        $field->note = $parametersMod->getValue('marketing', 'mailerlite', 'translations', 'group_id_explanation');
        $field->required = true;
        $fields[] = $field;


        $field = new \Library\Php\Form\FieldCheckbox();
        $field->name = 'auto_upload';
        $field->caption = $parametersMod->getValue('marketing', 'mailerlite', 'translations', 'auto_upload');
        $field->value = $parametersMod->getValue('marketing', 'mailerlite', 'options', 'auto_upload');
        $field->required = false;
        $fields[] = $field;        
        
        return $fields;
    }

    /** @var array fields, that are used for registration */
    public static function getSynchronizationFields() {
        global $parametersMod;
        $fields = array();

        $emails = Db::getSubscribers($parametersMod->getValue('marketing', 'mailerlite', 'options', 'last_upload'));
        
        $note = $parametersMod->getValue('marketing', 'mailerlite', 'translations', 'required_time');
        $note = str_replace('[[time]]', round(count($emails) * 5 / 60), $note);
        
        $field = new \Library\Php\Form\FieldTextarea();
        $field->name = 'emails';
        $field->note = $note;
        $field->caption = $parametersMod->getValue('marketing', 'mailerlite', 'translations', 'new_subscribers');
        $field->value = implode("\r\n", $emails);
        $field->required = true;
        $fields[] = $field;
        
        return $fields;
    }



}