<?php

/**
 * @copyright (C) 2024, Champion Consulting, LLC.
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

abstract class Response {

    /**
     * Templates array
     * @var array Template
     */
    protected array $templates = [];

    abstract public function output() : string;

    /**
     * Construct
     */
    public function __construct() {
        
    }

    /**
     * Add a Template in content
     * @param Template $template
     * @return void
     */
    public function addTemplate(Template $template) {
        $this->templates[] = $template;
    }

    
}