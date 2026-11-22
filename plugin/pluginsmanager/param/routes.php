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

$router->map('GET', '/admin/pluginsmanager[/?]', 'PluginsManagerController#list', 'pluginsmanager-list');
$router->map('POST', '/admin/pluginsmanager/save', 'PluginsManagerController#save', 'pluginsmanager-save');
$router->map('GET', '/admin/pluginsmanager/[a:plugin]/[a:token]', 'PluginsManagerController#maintenance', 'pluginsmanager-maintenance');