<?php

/**
 * @package   ImpressPages
 * @copyright Copyright (C) 2011 ImpressPages LTD.
 * @license   GNU/GPL, see ip_license.html
 */

namespace Modules\marketing\mailerlite;

if (!defined('BACKEND'))
    exit;


class Db {

    /**
     *
     * @param int $from unix timestamp
     * @return array 
     */
    public static function getSubscribers($from) {
        $sql = "select * from `" . DB_PREF . "m_community_newsletter_subscribers` where unix_timestamp(`created_on`) > " . ((int)$from) . " and `verified`";
        $rs = mysql_query($sql);
        if ($rs) {
            $answer = array();
            while ($lock = mysql_fetch_assoc($rs))
                $answer[] = $lock['email'];
            return $answer;
        } else {
            trigger_error($sql . " " . mysql_error());
            return false;
        }
    }

}

