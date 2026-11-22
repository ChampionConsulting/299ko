<?php

/**
 * @copyright (C) 2024, Champion Consulting, LLC.
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 *
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') or exit('Access denied!');

class UsersAdminController extends AdminController {

    public function home() {

        $response = new AdminResponse();
        $tpl = $response->createPluginTemplate('users', 'userslist');

        $users = User::all();
        foreach ($users as $user) {
            $user->deleteLink = $this->router->generate("users-delete", ["id" => $user->id , "token" => $this->user->token]);
        }
        $tpl->set('users', $users);
        $tpl->set('token', $this->user->token);

        $response->addTemplate($tpl);
        return $response;
    }
}