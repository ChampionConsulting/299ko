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

$router->map('GET', '/admin/filemanager[/?]', 'FileManagerAPIController#home', 'filemanager-home');
$router->map('POST', '/admin/filemanager/view-ajax/upload/[a:token]', 'FileManagerAPIController#upload', 'filemanager-upload');
$router->map('POST', '/admin/filemanager/view-ajax/delete/[a:token]', 'FileManagerAPIController#delete', 'filemanager-delete');
$router->map('POST', '/admin/filemanager/view-ajax/create/[a:token]', 'FileManagerAPIController#create', 'filemanager-create');

$router->map('POST', '/admin/filemanager/view', 'FileManagerAPIController#view', 'filemanager-view');
$router->map('POST', '/admin/filemanager/view-ajax', 'FileManagerAPIController#viewAjax', 'filemanager-view-ajax');
$router->map('GET', '/admin/filemanager/view-ajax/[a:token]/[*:editor]?', 'FileManagerAPIController#viewAjaxHome', 'filemanager-view-ajax-home');

$router->map('POST', '/admin/filemanager/api/upload/[a:token]', 'FileManagerAPIController#uploadAPI', 'filemanager-upload-api');
