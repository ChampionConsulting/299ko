<?php

/**
 * @copyright (C) 2023, Champion Consulting, LLC
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') or exit('Access denied!');

class GalleryController extends PublicController
{

    public function home()
    {
        $gallery = new gallery();
        $this->runPlugin->setTitleTag($this->runPlugin->getConfigVal('label'));
        if($this->runPlugin->getIsDefaultPlugin()){
            $this->runPlugin->setTitleTag($this->core->getConfigVal('siteName'));
            $this->runPlugin->setMetaDescriptionTag($this->core->getConfigVal('siteDescription'));
        }
        $this->runPlugin->setMainTitle($this->runPlugin->getConfigVal('label'));

        $response = new PublicResponse();
        $tpl = $response->createPluginTemplate('gallery', 'gallery');

        $tpl->set('gallery', $gallery);

        $response->addTemplate($tpl);
        return $response;
    }
}