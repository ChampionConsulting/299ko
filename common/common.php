<?php

/**
 * @copyright (C) 2024, Champion CMS, based on code (2010-2021) 299ko https://github.com/299Ko/
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Maddox Champion <maddox@championconsulting.com>
 * @author Andrew Champion <andrew@championconsulting.com>
 * @author Katie <kaite@championconsulting.com>
 *
 * @package https://github.com/ChampionConsulting/champion-cms
 */
session_start();
defined('ROOT') or exit('Access denied!');

define('BASE_PATH', rtrim(dirname($_SERVER['SCRIPT_NAME']), DIRECTORY_SEPARATOR));

include_once(ROOT . 'common/config.php');

// Autoload class in COMMON directory
spl_autoload_register(function ($class) {
	$className = strtolower($class);
	$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(COMMON));
	foreach ($iterator as $file)
	{
		if ($file->isFile() && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
			$fileName = strtolower($file->getFilename());
			if ($fileName === "$className.php") {
				include_once($file);
				break;
			}
		}
	}
});

$router = router::getInstance();
$core = core::getInstance();
$core->init();

$pluginsManager = pluginsManager::getInstance();
foreach ($pluginsManager->getPlugins() as $plugin) {
	if ($plugin->getConfigVal('activate')) {
		$plugin->loadLangFile();
		$plugin->loadRoutes();
		if ($plugin->getLibFile() !== false) {
			include_once($plugin->getLibFile());
		}
		foreach ($plugin->getHooks() as $name => $function) {
			$core->addHook($name, $function);
		}
	}
}

lang::loadLanguageFile(THEMES . $core->getConfigVal('theme') . '/langs/');
$themeFunctionsFile = THEMES . $core->getConfigVal('theme') . '/functions.php';
if (file_exists($themeFunctionsFile)) {
	include_once($themeFunctionsFile);
}

## $runPLugin représente le plugin en cours d'execution et s'utilise avec la classe plugin & pluginsManager
$runPlugin = $pluginsManager->getPlugin($core->getPluginToCall());

Template::addGlobal('COMMON', COMMON);
Template::addGlobal('DATA', DATA);
Template::addGlobal('UPLOAD', UPLOAD);
Template::addGlobal('DATA_PLUGIN', DATA_PLUGIN);
Template::addGlobal('THEMES', THEMES);
Template::addGlobal('PLUGINS', PLUGINS);
Template::addGlobal('THEME_PATH', THEMES . $core->getConfigVal('theme') . '/');
Template::addGlobal('SITE_URL', $core->getConfigVal('siteUrl'));
Template::addGlobal('THEME_URL', util::urlBuild(THEMES . $core->getConfigVal('theme')));
Template::addGlobal('ADMIN_URL', $router->generate('admin'));
Template::addGlobal('VERSION', VERSION);
Template::addGlobal('runPlugin', $runPlugin);
Template::addGlobal('ROUTER', $router);
Template::addGlobal('pluginsManager', $pluginsManager);
Template::addGlobal('CORE', $core);
Template::addGlobal('ADMIN_PATH', ADMIN_PATH);
