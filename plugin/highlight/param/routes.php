<?php

/**
 * @copyright (C) 2024, Champion CMS, based on code (2010-2021) 299ko https://github.com/299Ko/
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package Champion CMS https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('No direct script access allowed');

$router = router::getInstance();

$router->map('GET', '/admin/highlight[/?]', 'HighlightAdminController#home', 'highlight-admin');
$router->map('POST', '/admin/highlight/saveconf[/?]', 'HighlightAdminController#save', 'highlight-saveconf');