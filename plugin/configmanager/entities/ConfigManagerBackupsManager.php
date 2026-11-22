<?php

/**
 * @copyright (C) 2025, Champion Consulting, LLC
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') or exit('Access denied!');

class ConfigManagerBackupsManager {

    public static function getAll():array {
        $backups = [];
        $backupFiles = [];
        $files = scandir(DATA_PLUGIN . 'configmanager' . DS);
        foreach ($files as $file) {
            if (preg_match('/backup-.*\.zip/i', $file)) {
                $backupFiles[] = $file;
            }
        }
        foreach ($backupFiles as $file) {
            $obj = new ConfigManagerBackup($file);
            $timestamp = util::getTimestampFromDate($obj->date);
            $backups[$timestamp] = $obj;
        }
        krsort($backups, SORT_NUMERIC);
        return $backups;
    }
}