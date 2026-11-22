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
defined('ROOT') OR exit('Access denied!');

## Fonction d'installation

function antispamInstall() {
    
}

## Hooks
## Code relatif au plugin

class antispam {

    protected $captcha;

    public function __construct() {
        $pluginManager = pluginsManager::getInstance();
        $typeCaptcha = $pluginManager->getPluginConfVal('antispam', 'type');
        if ($typeCaptcha === 'useText') {
            // UseText lib
            require_once PLUGINS . 'antispam' . DS . 'lib' . DS . 'AntispamAbstractCaptcha.php';
            require_once PLUGINS . 'antispam' . DS . 'lib' . DS . 'AntispamTextCaptcha.php';
            $this->captcha = new AntispamTextCaptcha();
        } elseif ($typeCaptcha === 'useRecaptcha') {
            // ReCaptcha lib
            require_once PLUGINS . 'antispam' . DS . 'lib' . DS . 'AntispamReCaptcha.php';
            $public = $pluginManager->getPluginConfVal('antispam', 'recaptchaPublicKey');
            $secret = $pluginManager->getPluginConfVal('antispam', 'recaptchaSecretKey');
            $this->captcha = new AntispamReCaptcha($public, $secret);
        } elseif ($typeCaptcha === 'useIcon') {
            require_once PLUGINS . 'antispam' . DS . 'lib' . DS . 'AntispamAbstractCaptcha.php';
            require_once PLUGINS . 'antispam' . DS . 'lib' . DS . 'AntispamIconCaptcha.php';
            $this->captcha = new AntispamIconCaptcha();
        }
    }

    public function show() {
        return $this->captcha->getText();
    }

    public function isValid() {
        return $this->captcha->isValid();
    }

}

