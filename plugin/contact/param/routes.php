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

$router->map('GET', '/contact[/?]', 'ContactController#home', 'contact-home');
$router->map('POST', '/contact/send.html', 'ContactController#send', 'contact-send');

$router->map('GET', '/admin/contact[/?]', 'ContactAdminController#home', 'contact-admin-home');
$router->map('POST', '/admin/contact/saveParams', 'ContactAdminController#saveParams', 'contact-saveParams');
$router->map('POST', '/admin/contact/saveConfig', 'ContactAdminController#saveConfig', 'contact-saveConfig');
$router->map('GET', '/admin/contact/emptyMails/[a:token]', 'ContactAdminController#emptyMails', 'contact-empty-mails');