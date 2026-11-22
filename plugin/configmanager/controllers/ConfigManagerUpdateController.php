<?php

/**
 * @copyright (C) 2024, Champion Consulting, LLC.
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') or exit('Access denied!');

class ConfigManagerUpdateController extends AdminController {

    public function process($token) {
        $updaterManager = new UpdaterManager();
        if ($updaterManager->isReady) {
            $nextVersion = $updaterManager->getNextVersion();
        } else {
            $nextVersion = false;
        }
        if ($nextVersion && $this->user->isAuthorized()) {
            $updaterManager->update();
            show::msg(Lang::get('configmanager-updated', $nextVersion), 'success');
            $updaterManager->clearCache();
            $this->core->redirect($this->router->generate('configmanager-admin'));
        }
    }

    public function processManual($token) {
        if (!$this->user->isAuthorized()) {
            $this->core->redirect($this->router->generate('configmanager-admin'));
        }
        if (!is_dir(ROOT .'update')) {
            show::msg(Lang::get('configmanager-update-dir-not-found'), 'error');
            $this->core->redirect($this->router->generate('configmanager-admin'));
        }
        require_once PLUGINS . 'configmanager/lib/UpdaterManualManager.php';
        $updater = new UpdaterManualManager();
        if ($updater->check()) {
            $nextVersion = $updater->getNextVersion();
            $updater->update();
            show::msg(Lang::get('configmanager-updated', $nextVersion ), 'success');
            $this->core->redirect($this->router->generate('configmanager-admin'));
        } else {
            show::msg(Lang::get('configmanager-update-error'), 'error');
            $this->core->redirect($this->router->generate('configmanager-admin'));
        }
    }


}