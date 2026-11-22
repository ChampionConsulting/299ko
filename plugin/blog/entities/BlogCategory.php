<?php

/**
 * @copyright (C) 2023, Champion Consulting, LLC
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

class BlogCategory extends Category {

    protected string $pluginId = 'blog';
    protected string $name = 'categories';
    protected bool $nested = true;
    protected bool $chooseMany = true;


}