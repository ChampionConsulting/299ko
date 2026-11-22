<?php

/**
 * @copyright (C) 2022, Champion CMS, based on code (2010-2021) 299ko https://github.com/299Ko/
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Maddox Champion <maddox@championconsulting.com>
 * @author Andrew Champion <andrew@championconsulting.com>
 * @author Katie <kaite@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */

const VERSION = '0.2.2B';
const COMMON = ROOT . 'common' . DS;
const DATA = ROOT . 'data' . DS;
const UPLOAD = ROOT . 'data' . DS . 'upload' . DS;
const DATA_PLUGIN = ROOT . 'data' . DS . 'plugin' . DS;
const CACHE = ROOT . 'data' . DS . 'cache' . DS;
const THEMES = ROOT . 'theme' . DS;
const PLUGINS = ROOT . 'plugin' . DS;
const ADMIN_PATH = ROOT . 'admin' . DS;
const FONTICON = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css';
const FANCYCSS = 'https://cdnjs.cloudflare.com/ajax/libs/fancyapps-ui/4.0.31/fancybox.min.css';
const FANCYJS = 'https://cdnjs.cloudflare.com/ajax/libs/fancyapps-ui/4.0.31/fancybox.umd.min.js';

$filename = DATA . 'key.php';
if (file_exists($filename)) {
    include $filename;
}