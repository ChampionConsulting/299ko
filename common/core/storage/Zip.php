<?php

/**
 * @copyright (C) 2025, Champion Consulting, LLC
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') or exit('Access denied!');

class Zip
{

    public string $filename;

    public string $filesize;

    public function __construct($filename)
    {
        $this->filename = $filename;
        if (!file_exists($this->filename)) {
            throw new Exception("File not found: $filename");
        }
        $this->filesize = $this->humanFilesize(filesize($filename));
    }

    protected function humanFilesize($bytes, $decimals = 2)
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }

    public static function createZipFromFolder(string $folder, string $filename, array $ignoreRegex = []): bool
    {
        $zip = new ZipArchive();
        $zip->open($filename, ZipArchive::CREATE);
        $itemsToSave = util::scanDirRecursive($folder);
        foreach ($itemsToSave['dir'] as $dir) {
            $dir = trim($dir,'.');
            $dir = str_replace('\\', '/', $dir);
            $dir = trim($dir, '/');
            foreach ($ignoreRegex as $regex) {
                if (preg_match($regex, $dir)) {
                    continue 2;
                }
            }
            $zip->addEmptyDir($dir);
        }
        foreach ($itemsToSave['file'] as $file) {
            $file = trim($file,'.');
            $file = str_replace('\\', '/', $file);
            $file = trim($file, '/');
            foreach ($ignoreRegex as $regex) {
                if (preg_match($regex, $file)) {
                    continue 2;
                }
            }
            $zip->addFile($file, $file);
        }
        $zip->close();
        return true;
    }
}