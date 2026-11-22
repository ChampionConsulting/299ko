<?php

/**
 * @copyright (C) 2025, Champion Consulting, LLC
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

abstract class AntispamAbstractCaptcha {

    public function isGenericValid():bool {
        if (isset($_POST['ant_name_a']) && !empty($_POST['ant_name_a'])) {
            // If bot has filled the form, antispam is not valid
            return false;
        }
        return true;
    }

    public function getGenericHtml():string {
        return '<input type="text" name="ant_name_a" id="first_name_a" value="" />';
    }
}