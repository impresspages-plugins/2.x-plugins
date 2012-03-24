<?php

/**
 * @package	ImpressPages
 * @copyright	Copyright (C) 2011 ImpressPages LTD.
 * @license	GNU/GPL, see ip_license.html
 */

namespace Modules\marketing\mailerlite;

if (!defined('BACKEND'))
exit;

require_once(__DIR__.'/config.php');
require_once(__DIR__.'/module.php');
require_once (BASE_DIR.INCLUDE_DIR.'db_system.php');



class BackendWorker {

    function work() {
        global $site;
        global $parametersMod;

        $answer = '';
        if (isset($_REQUEST['action'])) {
            switch ($_REQUEST['action']) {
                case 'config':
                    $standardForm = new \Library\Php\Form\Standard(Config::getConfigFields());
                    $errors = $standardForm->getErrors();

                    if (sizeof($errors) > 0)
                    $answer = $standardForm->generateErrorAnswer($errors);
                    else {
                        if (isset($_POST['api_key'])) {
                            $parametersMod->setValue('marketing', 'mailerlite', 'options', 'api_key', trim($_POST['api_key']));
                        }
                        if (isset($_POST['group_id'])) {
                            $parametersMod->setValue('marketing', 'mailerlite', 'options', 'group_id', trim($_POST['group_id']));
                        }


                        $buggyVersions = array (
                            '1.0.0 Alpha',
                            '1.0.1 Beta',
                            '1.0.2 Beta',
                            '1.0.3 Beta',
                            '1.0.4',
                            '1.0.5',
                            '1.0.6',
                            '1.0.7',
                            '1.0.8',
                            '1.0.9rc2',
                            '1.0.9rc3',
                            '1.0.9',
                            '1.0.10',
                            '1.0.11',
                            '1.0.12',
                            '1.0.13'
                        );

                        if (in_array(\DbSystem::getSystemVariable('version'), $buggyVersions)){
                            if(isset($_POST['auto_upload'])) {
                                $value = 1;
                            } else {
                                $value = 0;
                            }
                            $tmpModule = \Db::getModule(null, 'marketing', 'mailerlite');
                            $parameter = \Db::getParameter($tmpModule['id'], 'module_id', 'options', 'auto_upload');
                            $sql = "update `".DB_PREF."par_bool` set `value` = '".$value."' where `parameter_id` = '".(int)$parameter['id']."'";
                            $rs = mysql_query($sql);
                        } else {
                            //setValue on bool fields does not work till 1.0.14
                            if (isset($_POST['auto_upload'])) {
                                $parametersMod->setValue('marketing', 'mailerlite', 'options', 'auto_upload', 1);
                            } else {
                                $parametersMod->setValue('marketing', 'mailerlite', 'options', 'auto_upload', 0);
                            }                            
                        }






                        $_SESSION['modules']['marketing']['note'] = $parametersMod->getValue('marketing', 'mailerlite', 'translations', 'success_config_update');
                        $answer = '
                        <html><head><meta http-equiv="Content-Type" content="text/html; charset='.CHARSET.'" /></head><body>
                         <script type="text/javascript">
                           parent.document.location = parent.document.location;
                         </script>
                        </body></html>
                         ';
                    }

                    break;

                case 'upload':
                    $standardForm = new \Library\Php\Form\Standard(Config::getSynchronizationFields());
                    $errors = $standardForm->getErrors();

                    if (sizeof($errors) > 0)
                    $globalError = 'testas';
                    else {

                        if (isset($_POST['emails'])) {
                            $failed = array();
                            $emails = preg_split("/[\r\n,]+/", $_POST['emails'], -1, PREG_SPLIT_NO_EMPTY);
                            $success = Module::addSubscribers($emails, $failed);

                            if ($success) {
                                $_SESSION['modules']['marketing']['note'] = $parametersMod->getValue('marketing', 'mailerlite', 'translations', 'success_upload');
                            } else {
                                $errorMessage = $parametersMod->getValue('marketing', 'mailerlite', 'translations', 'failed_upload');
                                $errorMessage .= '<br/><br/>' .implode('<br/>', $failed);
                                $_SESSION['modules']['marketing']['error_note'] = $errorMessage;
                            }



                        }

                        $answer = '
                        <html><head><meta http-equiv="Content-Type" content="text/html; charset='.CHARSET.'" /></head><body>
                         <script type="text/javascript">
                           parent.document.location = parent.document.location;
                         </script>
                        </body></html>
                         ';
                    }

                    break;

            }

            echo $answer;
        }
    }

}

