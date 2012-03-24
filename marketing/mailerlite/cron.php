<?php
/**
 * @package	ImpressPages
 * @copyright	Copyright (C) 2011 ImpressPages LTD.
 * @license	GNU/GPL, see ip_license.html
 */
namespace Modules\marketing\mailerlite;
if (!defined('FRONTEND')&&!defined('BACKEND')) exit;


require_once (__DIR__.'/module.php');
require_once (__DIR__.'/db.php');



class Cron{

    function execute($options){
        global $parametersMod;
        global $log;
        if($options->firstTimeThisDay && $parametersMod->getValue('marketing', 'mailerlite', 'options', 'auto_upload')) {
            $emails = Db::getSubscribers($parametersMod->getValue('marketing', 'mailerlite', 'options', 'last_upload'));
            $failed = array();
            Module::addSubscribers($emails, $failed);
            if (count($failed) == 0) {
                $log->log('marketing/mailerlite', 'successfull upload', implode(',', $emails), count($emails));
            } else {
                $log->log('marketing/mailerlite', 'failed upload', implode(',', $failed), count($emails));
                $errorMessage = $parametersMod->getValue('marketing', 'mailerlite', 'translations', 'failed_upload');
                $errorMessage .= '<br/><br/>' .implode('<br/>', $failed);
                trigger_error($errorMessage);
                
            }
        }


    }

}