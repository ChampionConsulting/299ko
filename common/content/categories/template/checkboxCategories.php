<?php
/**
 * @copyright (C) 2022, Champion Consulting, LLC
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

switch ($catDisplay) {
    case 'root':
        // Categories Container
        ?>
        <div class="list-item-container">
            <?php
            if (empty($this->imbricatedCategories)) {
                echo lang::get($this->getPrefix() . 'none') . ' <a data-fancybox href="#" data-src="#categories_panel">' . lang::get($this->getPrefix() . 'addOne') . '</a>';
            } else { ?>
            <ul class="list-item-list">
                <?php
                foreach ($this->imbricatedCategories as $cat) {
                    $cat->outputAsCheckbox($itemId);
                }
                ?>
            </ul>
            <?php } ?>
        </div>
        <?php
        break;
    case 'sub':
        // Categories
        if ($this->hasChildren) {
            echo "<li class='list-item-hasChildren'>";
        } else {
            echo "<li>";
        }
        echo "<div><input type='checkbox' id='cat_" . $this->id . "' name='categoriesCheckbox[]' value='" . $this->id . "' ";
        
        if (in_array($itemId, $this->items)) {
            echo ' checked';
        }
        echo "/><label for='cat_" . $this->id . "'>" . $this->label . "</label></div>";
        if ($this->hasChildren) {
            echo "<i class='fa-solid fa-caret-down'></i>";
            echo "<ul class='list-item-list-sub'>";
            foreach ($this->children as $child) {
                $child->outputAsCheckbox($itemId);
            }
            echo "</ul>";
        }
        echo "</li>";
        break;
}