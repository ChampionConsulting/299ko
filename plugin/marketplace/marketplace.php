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
 *
 * Marketplace Plugin for Champion CMS
 *
 * This plugin provides a marketplace that allows users to install
 * plugins and themes directly from GitHub.
 *
 */

defined('ROOT') or exit('Access denied!');

require_once PLUGINS . 'marketplace/lib/MarketPlaceCurl.php';
require_once PLUGINS . 'marketplace/lib/MarketPlaceManager.php';

require_once PLUGINS . 'marketplace/entities/MarketPlaceRessource.php';

function marketplaceInstall() {
    $marketConfig = util::readJsonFile(DATA_PLUGIN . 'marketplace/marketplace.json');
    if (!$marketConfig) {
        $marketConfig = [];
    }
    if (!isset($marketConfig['siteID'])) {
        $marketConfig['siteID'] = uniqid('299ko-', true);
    }
    util::writeJsonFile(DATA_PLUGIN . 'marketplace/marketplace.json', $marketConfig);

}