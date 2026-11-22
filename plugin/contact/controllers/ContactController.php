<?php

/**
 * @copyright (C) 2024, Champion Consulting, LLC.
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') or exit('Access denied!');

class ContactController extends PublicController
{

    public function home()
    {
        $antispam = ($this->pluginsManager->isActivePlugin('antispam')) ? new antispam() : false;

        $this->runPlugin->setMainTitle($this->runPlugin->getConfigVal('label'));
        $this->runPlugin->setTitleTag($this->runPlugin->getConfigVal('label'));
        $antispamField = ($antispam) ? $antispam->show() : '';

        $response = new PublicResponse();
        $tpl = $response->createPluginTemplate('contact', 'contact');

        $tpl->set('name', htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8'));
        $tpl->set('firstname', htmlspecialchars($_POST['firstname'] ?? '', ENT_QUOTES, 'UTF-8'));
        $tpl->set('email', htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'));
        $tpl->set('message', htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8'));
        $tpl->set('acceptation', (trim($this->runPlugin->getConfigVal('acceptation')) != '') ? true : false);
        $tpl->set('antispam', $antispam);
        $tpl->set('antispamField', $antispamField);
        $tpl->set('sendUrl', $this->router->generate('contact-send'));
        $response->addTemplate($tpl);
        return $response;
    }

    public function send()
    {
        $sendError = false;
        $antispam = ($this->pluginsManager->isActivePlugin('antispam')) ? new antispam() : false;
        // quelques contrôles et temps mort volontaire avant le send...
        sleep(2);
        if ($antispam) {
            if (!$antispam->isValid()) {
                show::msg(lang::get('antispam.invalid-captcha'), 'error');
                $sendError = true;
            }
        }
        if (!$sendError) {
            if ($_POST['_name'] == '' && strchr($_SERVER['HTTP_REFERER'], 'contact') !== false) {
                if (contactSend()) {
                    show::msg(lang::get('contact.msg-sent'), 'success');
                } else {
                    show::msg(lang::get('something-wrong'), 'error');
                    $sendError = true;
                }
            } else {
                show::msg(lang::get('contact.fiels-error'), 'error');
                $sendError = true;
            }
        }
        return $this->home();
    }
}