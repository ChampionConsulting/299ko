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

$router->map('GET', '/admin/configmanager[/?]', 'ConfigManagerAdminController#home', 'configmanager-admin');
$router->map('POST', '/admin/configmanager/save', 'ConfigManagerAdminController#save', 'configmanager-admin-save');
$router->map('GET', '/admin/configmanager/cacheclear/[a:token]', 'ConfigManagerAdminController#clearCache', 'configmanager-admin-cache-clear');

$router->map('GET', '/admin/configmanager/update/[a:token]', 'ConfigManagerUpdateController#process', 'configmanager-update');
$router->map('GET', '/admin/configmanager/update-manual/[a:token]', 'ConfigManagerUpdateController#processManual', 'configmanager-manual-update');
$router->map('GET', '/admin/configmanager/delete-install/[a:token]', 'ConfigManagerAdminController#deleteInstall', 'configmanager-delete-install');


// Backups
$router->map('GET', '/admin/configmanager/backup', 'ConfigManagerBackupAdminController#home', 'configmanager-backup');
$router->map('GET', '/admin/configmanager/create-backup/[a:token]', 'ConfigManagerBackupAdminController#create', 'configmanager-create-backup');
$router->map('GET', '/admin/configmanager/dl-backup/[a:token]/[i:timestamp]', 'ConfigManagerBackupAdminController#download', 'configmanager-dl-backup');
$router->map('POST', '/admin/configmanager/delete-backup', 'ConfigManagerBackupAdminController#delete', 'configmanager-delete-backup');