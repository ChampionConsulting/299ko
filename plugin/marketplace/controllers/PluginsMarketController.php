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
 * Marketplace Plugin for 299Ko CMS
 *
 */

defined('ROOT') or exit('Access denied!');

class PluginsMarketController extends AdminController
{
    protected MarketPlaceManager $marketManager;
    public function __construct() {
        parent::__construct();
        if(!function_exists('curl_init')) {
            show::msg(lang::get('marketplace.curl_not_installed'), 'error');
            $this->core->redirect($this->router->generate('pluginsmanager-list'));
        }
        $this->marketManager = new MarketPlaceManager();
    }

    public function index() {
        $pluginsData = $this->marketManager->getPlugins() ?? [];
        $plugins = [];
        foreach ($pluginsData as $plugin) {
            $r = new MarketPlaceRessource(MarketPlaceRessource::TYPE_PLUGIN, $plugin);
            $plugins[$plugin->slug] = $r;
        }

        // Prepare the admin response with the plugins marketplace template
        $response = new AdminResponse();
        $tpl = $response->createPluginTemplate('marketplace', 'admin-marketplace-plugins');
        $response->setTitle(lang::get('marketplace.list_plugins'));
        
        $pluginsTpl = $response->createPluginTemplate('marketplace', 'display-ressources');
        $pluginsTpl->set('ressources', $plugins);
        $pluginsTpl->set('token', $this->user->token);
        $tpl->set('PLUGINS_TPL', $pluginsTpl->output());
        $response->addTemplate($tpl);
        return $response;

    }


}