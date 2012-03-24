<?php

/**
 * @package   ImpressPages
 * @copyright Copyright (C) 2011 ImpressPages LTD.
 * @license   GNU/GPL, see ip_license.html
 */

namespace Modules\marketing\mailerlite;

if (!defined('CMS'))
exit;


require_once(__DIR__.'/nusoap/nusoap.php');

class Module {

    /**
     *
     * @param array $emails array of emails
     * @return bool true if success
     */
    public static function addSubscribers($emails, &$failed) {
        global $parametersMod;
        set_time_limit(60 + count($emails) * 1);
        
        $client = new \nusoap_client("http://mailerlite.com/soapserver.php?wsdl");
        $apiKey = $parametersMod->getValue('marketing', 'mailerlite', 'options', 'api_key');
        $groupId = $parametersMod->getValue('marketing', 'mailerlite', 'options', 'group_id');
        foreach ($emails as $key => $email) {
            $params = array(
                    "api_key" => $apiKey,
                    "group_id"  =>  $groupId,
                    "email" => $email,
                    "name" => '',
                    "fields" => array(                           
                            array("name" => "subscribe", "value" => '1')
                        )
            );

            try {
                $answer = $client->call("addSubscriberWithCustomFields", $params);
                var_dump($answer);
                if (!isset($answer['code']) || $answer['code'] != 0) {
                    $failed[] = $email.' ('.$answer['message'].')';
                }                
            } catch (\Exception $e){
                trigger_error('Can\'t register new email. Response from the server '.$client->__getLastResponse());
                $failed[] = $email;
            }


        }

        if (count($failed) == 0) {
            $parametersMod->setValue('marketing', 'mailerlite', 'options', 'last_upload', time());
            return true;
        } else {
            return false;
        }

    }

    /**
     *
     * @param array $emails array of emails
     * @return bool true if success
     */
    public static function removeSubscribers($emails, &$failed) {
        global $parametersMod;
        set_time_limit(60 + count($emails) * 1);
        $client = new \soapclient('http://mailerlite.com/soapserver.php?wsdl');
        $apiKey = $parametersMod->getValue('marketing', 'mailerlite', 'options', 'api_key');
        foreach ($emails as $key => $email) {
            $answer = $client->unsubscribeSubscriber($apiKey, $email);
            if ($answer->code != 0) {
                $failed[] = $email;
            }
        }

        if (count($failed) == 0) {
            $parametersMod->setValue('marketing', 'mailerlite', 'options', 'last_upload', time());
            return true;
        } else {
            return false;
        }

    }

}