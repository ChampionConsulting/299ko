<?php

/**
 * @copyright (C) 2022, Champion CMS, based on code (2010-2021) 299ko https://github.com/299Ko/
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package Champion CMS https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('No direct script access allowed');

## Fonction d'installation

function mdeditorInstall() {
    //Désactiver tinymce
    if (pluginsManager::isActivePlugin('tinymce')) {
        $pluginsManager = pluginsManager::getInstance();
        $tiny = $pluginsManager->getPlugin('tinymce');
        $tiny->setConfigVal('activate', 0);
        $pluginsManager->savePluginConfig($tiny);
    }
}

## Hooks

function mdeditorAdmin() {
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css'>
        <script src='https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js'></script>
        <script>
            var editors = document.getElementsByClassName('editor');
            if (!!editors){
                for (let editor of editors) {
                    const easyMDE = new EasyMDE({
                        toolbar: ['bold','italic','heading','|',
                        'code','quote','unordered-list','ordered-list','table','horizontal-rule','|',
                        'link','image','|',
                        'preview','side-by-side','fullscreen','|',
                        'guide'],
                        spellChecker: false,
                        inputStyle: 'contenteditable',
                                    nativeSpellcheck: true,
                        element: editor
                    });
            	}
            }
        </script>";
}

function mdeditorBeforeEdit($content = '') {
    require_once PLUGINS . '/mdeditor/Markdownify.php';
    $converter = new \Markdownify\ConverterExtra;
    return $converter->parseString($content);
}

function mdeditorBeforeSave($content) {
    require_once PLUGINS . '/mdeditor/Parsedown.php';
    $converter = new ParsedownExtra();
    return $converter->text($content);
}
