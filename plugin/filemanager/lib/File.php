<?php

/**
 * @copyright (C) 2022, Champion Consulting, LLC
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

class File {
    
    public string $name = '';
    
    protected string $directory = '';
    
    public function __construct($name, $directory) {
        $this->name = $name;
        $this->directory = trim($directory, '/') . '/';
    }
    
    public function getUrl() {
        return util::urlBuild($this->directory . $this->name);
    }

    public function getRelUrl() {
        $parts = explode('/', $this->directory);
        $dir = '';
        foreach ($parts as $part) {
            if ($part === '.' || $part === '..' || $part === '') {
                continue;
            }
            $dir .= $part . '/';
        }
        return $dir . ltrim($this->name,'/');
    }
    
    public function isPicture() {
        if (in_array(util::getFileExtension($this->name), ['gif', 'jpg', 'jpeg','png','bmp'])) {
            return true;
        }
    }
    
    public function getFileMTime() {
        return filemtime($this->directory . $this->name);
    }
    
    public function delete() {
        return unlink($this->directory . $this->name);
    }
    
}