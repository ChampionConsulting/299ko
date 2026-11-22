<?php

/**
 * @copyright (C) 2024, Champion Consulting, LLC.
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

$router = router::getInstance();

$router->map('GET', '/admin/antispam[/?]', 'AntispamAdminController#home', 'antispam-admin');
$router->map('POST', '/admin/antispam/saveconf[/?]', 'AntispamAdminController#save', 'antispam-saveconf');