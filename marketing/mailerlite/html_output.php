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

class HtmlOutput {

    public static function header() {
        global $parametersMod;
        return '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>MailerLite</title>
        <link href="' . BASE_URL . BACKEND_DIR . 'design/common.css" rel="stylesheet" type="text/css" />  
        <link href="' . BASE_URL . PLUGIN_DIR . 'marketing/mailerlite/design/style.css" rel="stylesheet" type="text/css" />  
        <link REL="SHORTCUT ICON" HREF="backend_design/favicon.ico" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="' . LIBRARY_DIR . 'js/default.js"></script>
    </head>   
    <body>
        <div class="header">
            <img src="' . BASE_URL . PLUGIN_DIR . 'marketing/mailerlite/design/mailerlite.png" alt="' . htmlspecialchars($parametersMod->getValue('marketing', 'mailerlite', 'translations', 'mailerlite')) . '"/>
        </div>

      ';
    }

    public static function footer() {
        return "
    </body>
</html>";
    }
    
    public static function block($content) {
        $answer = '
        <div class="content">
            '.$content.'
        </div>
        ';
              
        return $answer;
    }

}

