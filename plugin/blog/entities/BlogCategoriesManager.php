<?php

/**
 * @copyright (C) 2024, Champion Consulting, LLC.
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

class BlogCategoriesManager extends CategoriesManager {

    protected string $pluginId = 'blog';
    protected string $name = 'categories';
    protected string $className = 'BlogCategory';
    protected bool $nested = true;
    protected bool $chooseMany = true;

    public function getAddCategoryUrl():string {
        return router::getInstance()->generate('admin-blog-add-category');
    }

    public function getDeleteUrl() :string {
        return router::getInstance()->generate('admin-blog-delete-category');
    }

    public function getAjaxDisplayListUrl():string {
        return router::getInstance()->generate('admin-blog-list-ajax-categories');
    }

    public function getEditUrl():string {
        return router::getInstance()->generate('admin-blog-edit-category');
    }

    public function outputAsList() {
        echo '<section id="categories_panel">';
        echo '<header>'. lang::get('blog-categories-management-title').'</header>';
        echo parent::outputAsList();
        echo '</section>';
    }
}