<?php

/**
 * @copyright (C) 2024, Champion Consulting, LLC.
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

class PublicController extends Controller {

    /**
     * Current plugin instance
     * @var plugin
     */
    protected plugin $runPlugin;

    /**
     * Current User
     * @var User
     */
    protected ?User $user;

    public function __construct() {
        parent::__construct();
        $pluginName = $this->core->getPluginToCall();
        if (pluginsManager::isActivePlugin($pluginName)) {
            $this->runPlugin = $this->pluginsManager->getPlugin($pluginName);
        } else {
            $this->core->error404();
        }
        if (!defined('ADMIN_MODE')) {
            define('ADMIN_MODE', false);
        }
        $this->user = UsersManager::getCurrentUser() ? UsersManager::getCurrentUser() : null;
    }

}