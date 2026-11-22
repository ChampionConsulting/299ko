<?php

/**
 * @copyright (C) 2023, Champion Consulting, LLC
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') or exit('Access denied!');

class PageController extends PublicController
{
    /**
     * page Object
     * @var page
     */
    protected page $page;

    /**
     * pageItem Object
     * @var pageItem
     */
    protected pageItem $pageItem;

    public function home()
    {
        $this->page = new page();
        $this->pageItem = $this->page->createHomepage();

        return $this->renderPage();
    }

    public function read($name, $id)
    {
        $this->page = new page();
        $this->pageItem = $this->page->create($id);

        return $this->renderPage();
    }

    protected function renderPage()
    {
        if ($this->pageItem->targetIs() != 'page' || $this->pageItem === false) {
            $this->core->error404();
        }
        $action = (isset($_POST['unlock'])) ? 'unlock' : '';
        $url = $this->page->makeUrl($this->pageItem);
        if ($action === 'unlock' && isset($_POST['password'])) {
            sleep(2);
            $result = $this->page->unlock($this->pageItem, $_POST['password']);
            error_log("Unlock attempt for page ID: " . $this->pageItem->getId() . " - Result: " . ($result ? 'success' : 'failed'));
            header('Location: ' . $url);
            die();
        }

        $this->setPageMetas();
        if ($this->page->isUnlocked($this->pageItem)) {
            $pageFile = ($this->pageItem->getFile()) ? THEMES . $this->core->getConfigVal('theme') . '/' . $this->pageItem->getFile() : false;
        }

        if (isset($pageFile) && $pageFile !== false) {
            if (util::getFileExtension($this->pageItem->getFile()) === 'tpl') {
                $response = new PublicResponse();
                $filephp = preg_replace('"\.tpl$"', '.php', $this->pageItem->getFile());
                $tpl = new Template($pageFile);
                if (file_exists(THEMES . $this->core->getConfigVal('theme') . '/' . $filephp)) {
                    require THEMES . $this->core->getConfigVal('theme') . '/' . $filephp;
                }
            } else {
                $core = $this->core;
                include_once(THEMES . $this->core->getConfigVal('theme') . '/header.php');
                include_once(THEMES . $this->core->getConfigVal('theme') . '/' . $this->pageItem->getFile());
                include_once(THEMES . $this->core->getConfigVal('theme') . '/footer.php');
                die();
            }
        } else {
            $response = new PublicResponse();
            $tpl = $response->createPluginTemplate('page', 'read');
        }

        $tpl->set('page', $this->page);
        $tpl->set('pageItem', $this->pageItem);
        $tpl->set('sendUrl', $url);

        $response->addTemplate($tpl);
        return $response;
    }

    protected function setPageMetas()
    {
        if ($this->page->isUnlocked($this->pageItem)) {
            if ($this->runPlugin->getConfigVal('hideTitles'))
                $this->runPlugin->setMainTitle('');
            else
                $this->runPlugin->setMainTitle(($this->pageItem->getMainTitle() != '') ? $this->pageItem->getMainTitle() : $this->pageItem->getName());
            if ($this->pageItem->getMetaTitleTag())
                $this->runPlugin->setTitleTag($this->pageItem->getMetaTitleTag());
            else
                $this->runPlugin->setTitleTag($this->pageItem->getName());
            if ($this->pageItem->getMetaDescriptionTag())
                $this->runPlugin->setMetaDescriptionTag($this->pageItem->getMetaDescriptionTag());
        } else {
            $this->runPlugin->setTitleTag('Restricted Access');
            $this->runPlugin->setMainTitle('Restricted Access');
        }
    }
}