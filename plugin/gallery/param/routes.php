<?php

/**
 * @copyright (C) 2024, Champion Consulting, LLC.
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

$router = router::getInstance();

$router->map('GET', '/gallery[/?]', 'GalleryController#home', 'gallery-home');

$router->map('GET', '/admin/gallery[/?]', 'GalleryAdminController#home', 'admin-gallery-home');
$router->map('GET', '/admin/gallery/edit', 'GalleryAdminController#edit', 'admin-gallery-edit');
$router->map('GET', '/admin/gallery/edit/[a:id]', 'GalleryAdminController#editId', 'admin-gallery-edit-id');
$router->map('GET', '/admin/gallery/delete/[a:id]/[a:token]', 'GalleryAdminController#delete', 'admin-gallery-delete');
$router->map('POST', '/admin/gallery/save', 'GalleryAdminController#save', 'admin-gallery-save');
$router->map('POST', '/admin/gallery/saveConf', 'GalleryAdminController#saveConf', 'admin-gallery-save-config');
