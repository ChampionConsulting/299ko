<?php
/**
 * @copyright (C) 2025,  Champion CMS, based on code (2010-2021) 299ko https://github.com/299Ko/
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Ronald Ingraham <r.ingrham@championconsultingl.com>
 * @author Andrew Champion <a.champion@championconsultingl.com>
 * @author Maddox Champion <m.champion@championconsultingl.com>
 * @author Katie Mae Champion <katie.champion@championconsultingl.com>
 * 
 * @package Champion CMS https://github.com/ChampionConsulting/champion-cms
 */

defined('ROOT') or exit('Access denied!');

$router = router::getInstance();

// Homepage
$router->map('GET', '/admin/marketplace[/?]', 'AdminMarketplaceController#index', 'admin-marketplace');

// Plugins list
$router->map('GET', '/admin/marketplace/plugins[/?]', 'PluginsMarketController#index', 'marketplace-plugins');

// Themes list
$router->map('GET', '/admin/marketplace/themes[/?]', 'ThemesMarketController#index', 'marketplace-themes');

// Ressource install
$router->map('GET', '/admin/marketplace/install/[a:type]/[a:slug]/[a:token][/?]', 'AdminMarketplaceController#installRelease', 'marketplace-install-release');

// Ressource uninstall
$router->map('GET', '/admin/marketplace/uninstall/[a:type]/[a:slug]/[a:token][/?]', 'AdminMarketplaceController#uninstallRessource', 'marketplace-uninstall-ressource');