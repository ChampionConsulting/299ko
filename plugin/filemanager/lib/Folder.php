<?php

/**
 * @copyright (C) 2022, Champion Consulting, LLC
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

class Folder {
    
    public string $name = '';
    
    protected string $directory = '';
    
    public function __construct($name, $directory) {
        $this->name = $name;
        $this->directory = trim($directory, '/') . '/';
    }
    
    public function delete() {
        if (!is_dir($this->directory . $this->name)) {
            return false;
        }
        $manager = new FileManager($this->directory . $this->name);
        
        $error = $manager->deleteAllFiles();
        if ($error) {
            return false;
        }
        
        $error = $manager->deleteAllFolders();
        if ($error) {
            return false;
        }
        
        return rmdir($this->directory . $this->name);        
    }
    
}