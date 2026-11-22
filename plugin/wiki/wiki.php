<?php

/**
 * @copyright (C) 2024, Champion CMS, based on code (2010-2021) 299ko https://github.com/299Ko/
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Maddox Champion <maddox@championconsulting.com>
 * @author Andrew Champion <andrew@championconsulting.com>
 * @author Katie <kaite@championconsulting.com>
 * @author Florent Fortat <florent.fortat@maxgun.fr>
 * @author Ronald Ingraham <ronald@championconsulting.com>
 * 
 * @package Champion CMS https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

require_once PLUGINS . 'wiki/entities/wikiPage.php';

require_once PLUGINS . 'wiki/entities/wikiPageManager.php';
require_once PLUGINS . 'wiki/entities/WikiCategoriesManager.php';
require_once PLUGINS . 'wiki/entities/WikiCategory.php';
require_once PLUGINS . 'wiki/entities/wikiPageHistory.php';
require_once PLUGINS . 'wiki/entities/WikiActivityManager.php';

/**
 * Fonction d'installation du plugin Wiki
 * 
 * @return void
 */
function wikiInstall() {
    // Installation du plugin Wiki
}

/**
 * Hook pour ajouter des éléments dans le head de la page publique
 * 
 * @return string Code HTML à ajouter dans le head
 */
function wikiEndFrontHead() {
    $core = core::getInstance();
    $output = '<script src="' . $core->getConfigVal('siteUrl') . '/plugin/wiki/template/public.js"></script>' . "\n";
    
    return $output;
}

/**
 * Hook pour ajouter des éléments dans le head de la page d'administration
 * 
 * @return string Code HTML à ajouter dans le head admin
 */
function wikiEndAdminHead() {
    $core = core::getInstance();
    $output = '<link rel="stylesheet" href="' . $core->getConfigVal('siteUrl') . '/plugin/wiki/template/admin.css" media="all">' . "\n";
    $output .= '<script src="' . $core->getConfigVal('siteUrl') . '/plugin/wiki/template/admin.js"></script>' . "\n";
    
    return $output;
}

/**
 * Shortcode pour créer des liens vers des pages Wiki
 * 
 * @param array $attributes Attributs du shortcode ['id' => int, 'name' => string]
 * @return string Code HTML du lien
 */
function wikiLinkShortcode(array $attributes):string {
    $wikiPageManager = new WikiPageManager();
    $wikiPage = $wikiPageManager->create((int) $attributes['id']);
    if (!$wikiPage) {
        return '';
    }
    if (!isset($attributes['name'])) {
        $attributes['name'] = $wikiPage->getName();
    }
    return '<a href="' . router::getInstance()->generate('wiki-read', ['id' => $wikiPage->getId(), 'name' => $wikiPage->getSlug()]) . '">' . $attributes['name'] . '</a>';
}

/**
 * Hook exécuté avant le lancement du plugin
 * 
 * @return void
 */
function wikiBeforeRunPlugin() {
    ContentParser::addShortcode('wikiLink', 'wikiLinkShortcode');
    
    foreach (glob(PLUGINS . 'wiki/controllers/' . "*.php") as $file) {
        include_once $file;
    }
}




## Code relatif au plugin

