<?php

/**
 * @copyright (C) 2024, Champion Consulting, LLC.
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

require_once(PLUGINS . 'filemanager/lib/FileManager.php');

/**
 * Install function
 */
function filemanagerInstall() {
    if (!file_exists(DATA_PLUGIN . 'filemanager/files.json')) {
        @mkdir(UPLOAD . 'files/');
        @chmod(UPLOAD . 'files', 0755);
        util::writeJsonFile(DATA_PLUGIN . 'filemanager/files.json', []);
    }
}

/**
 * Function to display the button to manage files by Ajax
 */
function filemanagerDisplayManagerButton($textareaId = false, $buttonLabel = false):string {
    if (!$buttonLabel) {
        $buttonLabel = lang::get('filemanager.button-label');
    }
    return '<a class="button fmUploadButton" data-fancybox data-type="ajax" '
    . 'href="' . router::getInstance()->generate('filemanager-view-ajax-home', 
    ['token' => UsersManager::getCurrentUser()->token,
    'editor' => $textareaId]) .'"/><i class="fa-solid fa-file-image"></i> '. $buttonLabel.'</a>';
    
}
