<?php

/**
 * @copyright (C) 2022, Champion CMS, based on code (2010-2021) 299ko https://github.com/299Ko/
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Maddox Champion <maddox@championconsulting.com>
 * @author Andrew Champion <andrew@championconsulting.com>
 * @author Katie <kaite@championconsulting.com>
 * @author Florent Fortat <florent.fortat@maxgun.fr>
 *
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('No pagesFileect script access allowed');

## Fonction d'installation

function contactInstall() {
    util::writeJsonFile(DATA_PLUGIN . 'contact/emails.json', []);
    $data = util::readJsonFile(DATA_PLUGIN . 'contact/config.json');
    lang::loadLanguageFile(PLUGINS . 'contact/langs/');
    $data['acceptation'] = lang::get('contact.default-acceptation');
    util::writeJsonFile(DATA_PLUGIN . 'contact/config.json', $data);
}

## Hooks
## Code relatif au plugin

function contactSave($email) {
    $data = util::readJsonFile(DATA_PLUGIN . 'contact/emails.json');
    $data[] = $email;
    util::writeJsonFile(DATA_PLUGIN . 'contact/emails.json', array_unique($data));
}

function contactSend() {
    global $runPlugin;
    $core = core::getInstance();
    $from = 'Champion-CMS@' . $_SERVER['SERVER_NAME'];
    $reply = strip_tags(trim($_POST['email']));
    $name = strip_tags(trim($_POST['name']));
    $firstName = strip_tags(trim($_POST['firstname']));
    $msg = strip_tags(trim($_POST['message']));
    if (!util::isEmail($reply) || $name == '' || $firstName == '' || $msg == '')
        return false;
    contactSave($reply);
    $to = User::findPK($runPlugin->getConfigVal('userMailId'))->email;
    $subject = 'Contact ' . $core->getConfigVal('siteName');
    $msg = $msg . "\n\n----------\n\n" . $name . " " . $firstName . " (" . $reply . ")";
    if (util::isEmail($runPlugin->getConfigVal('copy')))
        util::sendEmail($from, $reply, $runPlugin->getConfigVal('copy'), $subject, $msg);
    return util::sendEmail($from, $reply, $to, $subject, $msg);
}