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
 * Marketplace Theme for Champion CMS
 *
 */

defined('ROOT') or exit('Access denied!');

class ThemesMarketController extends AdminController
{
    protected MarketPlaceManager $marketManager;
    public function __construct() {
        parent::__construct();
        if(!function_exists('curl_init')) {
            show::msg(lang::get('marketplace.curl_not_installed'), 'error');
            $this->core->redirect($this->router->generate('themesmanager-list'));
        }
        $this->marketManager = new MarketPlaceManager();
    }

    public function index() {
        $themesData = $this->marketManager->getThemes() ?? [];
        $themes = [];
        foreach ($themesData as $theme) {
            $r = new MarketPlaceRessource(MarketPlaceRessource::TYPE_THEME, $theme);
            $themes[$theme->slug] = $r;
        }

        // Prepare the admin response with the themes marketplace template
        $response = new AdminResponse();
        $tpl = $response->createPluginTemplate('marketplace', 'admin-marketplace-themes');
        $response->setTitle(lang::get('marketplace.list_themes'));
        
        $themesTpl = $response->createPluginTemplate('marketplace', 'display-ressources');
        $themesTpl->set('ressources', $themes);
        $themesTpl->set('token', $this->user->token);
        $tpl->set('THEMES_TPL', $themesTpl->output());
        $response->addTemplate($tpl);
        return $response;

    }


}