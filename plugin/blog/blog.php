<?php

/**
 * @copyright (C) 2024, Champion CMS, based on code (2010-2021) 299ko https://github.com/299Ko/
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Maddox Champion <maddox@championconsulting.com>
 * @author Andrew Champion <andrew@championconsulting.com>
 * @author Katie <kaite@championconsulting.com>
 * @author Florent Fortat <florent.fortat@maxgun.fr>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

require_once PLUGINS . 'blog/entities/news.php';
require_once PLUGINS . 'blog/entities/newsComment.php';
require_once PLUGINS . 'blog/entities/newsManager.php';
require_once PLUGINS . 'blog/entities/BlogCategoriesManager.php';
require_once PLUGINS . 'blog/entities/BlogCategory.php';



## Fonction d'installation

function blogInstall() {

}

## Hooks

function blogEndFrontHead() {
    $core = core::getInstance();
    echo '<link rel="alternate" type="application/rss+xml" href="' . router::getInstance()->generate('blog-rss') . '" title="' . $core->getConfigVal('siteName') . '">' . "\n";
}

function blogLinkShortcode(array $attributes):string {
    $newsManager = new newsManager();
    $news = $newsManager->create((int) $attributes['id']);
    if (!$news) {
        return '';
    }
    if (!isset($attributes['name'])) {
        $attributes['name'] = $news->getName();
    }
    return '<a href="' . router::getInstance()->generate('blog-read', ['id' => $news->getId(), 'name' => util::strToUrl($news->getName())]) . '">' . $attributes['name'] . '</a>';
}

function blogBeforeRunPlugin() {
    ContentParser::addShortcode('blogLink', 'BlogLinkShortcode');
}

function BlogAdminCategoriesTemplates() {
    global $runPlugin;
    if ($runPlugin->getName() !== 'blog') {
        return;
    }

    $catsManager = new BlogCategoriesManager();

    echo '<a title="' . lang::get('blog-categories-management-title') . '" id="cat_link" data-fancybox data-type="ajax" href="#" data-src="' .  $catsManager->getAjaxDisplayListUrl() . '"><i class="fa-regular fa-folder-open"></i></a>';
}


## Code relatif au plugin

