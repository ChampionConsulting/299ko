<?php

/**
 * @copyright (C) 2023, Champion CMS, based on code (2010-2021) 299ko https://github.com/299Ko/
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * @author Ronald Ingraham <ronald@championconsulting.com>
 * 
 * @package Champion CMS https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') or exit('Access denied!');

class MarketPlaceCurl extends Curl{

    protected string $siteID = '';

	 protected string $endPoint = 'http://localhost/championcms.v5.3.12/299ko-v2.1-master/api/';
	 // protected string $endPoint = 'https://299ko-api.flexcb.fr';
	 // protected string $endPoint = 'https://api.github.com/repos/299Ko/plugins/contents/';
	

    public function __construct($url) {
        $this->endPoint = core::getInstance()->getEnv('marketplaceUrl', $this->endPoint);
        parent::__construct($this->endPoint . $url);
        $marketConfig = util::readJsonFile(DATA_PLUGIN . 'marketplace/marketplace.json');
        $this->siteID = $marketConfig['siteID'];
    }

    public function url(string $url): Curl {
        $this->url = $this->endPoint . $url;
        return $this;
    }

    public function setDatas($datas): self {
        $this->datas = $datas;
        $this->datas['siteID'] = $this->siteID;
        $this->datas['siteURL'] = core::getInstance()->getConfigVal('siteUrl');
        $this->datas['siteLang'] = core::getInstance()->getConfigVal('siteLang');
        $this->datas['siteVersion'] = VERSION;
        return $this;
    }

    public function execute(): Curl {
        if (empty($this->datas)) {
            $this->setDatas([]);
        }
        $this->addOption(CURLOPT_USERAGENT, '299ko-curl-marketplace');
        return parent::execute();

    }



}