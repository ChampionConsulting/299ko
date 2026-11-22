<?php

/**
 * @copyright (C) 2024, Champion CMS, based on code (2010-2021) 299ko https://github.com/299Ko/
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package Champion CMS https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') or exit('No direct script access allowed');

class HighlightAdminController extends AdminController
{
    public function home() {
        $response = new AdminResponse();
        $tpl = $response->createPluginTemplate('highlight', 'config');
        $response->addTemplate($tpl);
        return $response;
    }

    public function save() {
        if (!$this->user->isAuthorized()) {
            $this->core->error404();
        }
        $this->runPlugin->setConfigVal('theme', trim($_POST['theme']));
        $this->pluginsManager->savePluginConfig($this->runPlugin);

        show::msg(Lang::get('core-changes-saved'), 'success');
        $this->core->redirect($this->router->generate('highlight-admin'));
    }
}