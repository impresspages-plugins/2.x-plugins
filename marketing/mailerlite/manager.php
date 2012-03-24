<?php

/**
 * @package	ImpressPages
 * @copyright	Copyright (C) 2011 ImpressPages LTD.
 * @license	GNU/GPL, see ip_license.html
 */

namespace Modules\marketing\mailerlite;

if (!defined('BACKEND'))
    exit;

require_once (__DIR__ . '/html_output.php');
require_once (__DIR__ . '/config.php');
require_once (BASE_DIR . INCLUDE_DIR . 'db_system.php');

class Manager {

    private $formFields;

    function __construct() {
        global $parametersMod;


    }

    function manage() {
        global $cms;
        global $parametersMod;
        global $log;

        $answer = '';

        $answer .= HtmlOutput::header();


        if (isset($_SESSION['modules']['marketing']['note'])) {
            $answer .= '
          <div class="note">
            ' . ($_SESSION['modules']['marketing']['note']) . '
          </div>
                ';  
            unset($_SESSION['modules']['marketing']['note']);
        }

        if (isset($_SESSION['modules']['marketing']['error_note'])) {
            $answer .= '
          <div class="error_note">
            ' . ($_SESSION['modules']['marketing']['error_note']) . '
          </div>
                ';  
            unset($_SESSION['modules']['marketing']['error_note']);
        }
        
        $form = new \Library\Php\Form\Standard(Config::getConfigFields());
        $tmpHtml = '<h1>' . htmlspecialchars($parametersMod->getValue('marketing', 'mailerlite', 'translations', 'configuration_title')) . '</h1>';
        $tmpHtml .= $form->generateForm($parametersMod->getValue('marketing', 'mailerlite', 'translations', 'save'), $cms->generateWorkerUrl($cms->curModId, 'action=config'));
        $answer .= HtmlOutput::block($tmpHtml);

        if ($parametersMod->getValue('marketing', 'mailerlite', 'options', 'api_key') != '' && $parametersMod->getValue('marketing', 'mailerlite', 'options', 'group_id') != '') {
            $form = new \Library\Php\Form\Standard(Config::getSynchronizationFields());
            $tmpHtml = '<h1>' . htmlspecialchars($parametersMod->getValue('marketing', 'mailerlite', 'translations', 'synchronization_title')) . '</h1>';
            $tmpHtml .= $form->generateForm($parametersMod->getValue('marketing', 'mailerlite', 'translations', 'upload'), $cms->generateWorkerUrl($cms->curModId, 'action=upload'));
            $answer .= HtmlOutput::block($tmpHtml);
            
        }
        

        $answer .= HtmlOutput::footer();

        return $answer;
    }

}

