<?php

/**
 * @copyright (C) 2024, Champion Consulting, LLC.
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') or exit('Access denied!');

class GalleryAdminController extends AdminController
{

    public function home()
    {
        $gallery = new gallery();
        $response = new AdminResponse();
        $tpl = $response->createPluginTemplate('gallery', 'admin');

        $tpl->set('gallery', $gallery);
        $tpl->set('mode', 'list');
        $tpl->set('token', $this->user->token);
        $response->addTemplate($tpl);
        return $response;
    }

    public function edit() {
        $item = new galleryItem();
        return $this->renderEdit($item);
    }

    public function editId($id) {
        $gallery = new gallery();
        $item = $gallery->createItem($id);
        if ($item === false) {
            $this->core->error404();
        }
        return $this->renderEdit($item);
    }

    public function delete($id, $token) {
        if (!$this->user->isAuthorized()) {
            return $this->home();
        }
        $gallery = new gallery();
        $item = $gallery->createItem($id);
        if ($item !== false) {
            if ($gallery->delItem($item)) {
                show::msg(lang::get('core-item-deleted'), 'success');
            } else {
                show::msg(lang::get('core-item-not-deleted'), 'error');
            }
        } else {
            show::msg(lang::get('core-item-not-deleted'), 'error');
        }
        return $this->home();
    }

    public function save() {
        if (!$this->user->isAuthorized()) {
            return $this->home();
        }
        $gallery = new gallery();
        $contentEditor = new Editor('galContent', '', lang::get('gallery.content'));

        $item = ($_REQUEST['id']) ? $gallery->createItem($_REQUEST['id']) : new galleryItem();
        $item->setCategory($_REQUEST['category']);
        $item->setTitle($_REQUEST['title']);
        $item->setContent($contentEditor->getPostContent());
        $item->setDate($_REQUEST['date']);
        $item->setHidden((isset($_POST['hidden'])) ? 1 : 0);
        if ($gallery->saveItem($item)) {
            show::msg(lang::get('core-changes-saved'), 'success');
        } else {
            show::msg(lang::get('core-changes-not-saved'), 'error');
        }
        return $this->editId($item->getId());
    }

    public function saveConf() {
        if (!$this->user->isAuthorized()) {
            return $this->home();
        }
        $introEditor = new Editor('introduction', '', lang::get('gallery.introduction'), true);
        $this->runPlugin->setConfigVal('label', trim($_POST['label']));
        $this->runPlugin->setConfigVal('order', trim($_POST['order']));
        $this->runPlugin->setConfigVal('introduction', $introEditor->getPostContent() );
        $this->runPlugin->setConfigVal('showTitles', (isset($_POST['showTitles']) ? 1 : 0));
        $this->runPlugin->setConfigVal('size', trim($_POST['size']));
        if ($this->pluginsManager->savePluginConfig($this->runPlugin)) {
            show::msg(lang::get('core-changes-saved'), 'success');
        } else {
            show::msg(lang::get('core-changes-not-saved'), 'error');
        }
        return $this->home();
    }

    protected function renderEdit(galleryItem $item) {
        $response = new AdminResponse();
        $tpl = $response->createPluginTemplate('gallery', 'admin');
        $contentEditor = new Editor('galContent', $item->getContent(), lang::get('gallery.content'));

        $gallery = new gallery();
        if ($item->getDate() == '')
            $item->setDate('');
        
        $tpl->set('contentEditor', $contentEditor);
        $tpl->set('gallery', $gallery);
        $tpl->set('item', $item);
        $tpl->set('mode', 'edit');
        $tpl->set('token', $this->user->token);
        $response->addTemplate($tpl);
        return $response;
    }
}