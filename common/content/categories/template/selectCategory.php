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
        <select name="<?php echo $fieldName; ?>" id="<?php echo $fieldName; ?>">
            <option value="0" <?php if ($parentId == 0) echo ' selected'; ?> >-- Categories Container</option>
        
        <?php
        foreach ($this->imbricatedCategories as $cat) {
            if ($cat->id == $categoryId) {
                // We dont display itself
                continue;
            }
            $cat->outputAsSelect($parentId, $categoryId);
        }
        ?>
        </select>
        <?php
        break;
    case 'sub':
        // Categories
        ?>
        <option value="<?php echo $this->id; ?>" <?php if ($parentId == $this->id) echo ' selected'; ?> >
            <?php echo str_repeat("-", ($this->depth * 2)) . ' ' . $this->label; ?>
        </option>
        <?php if ($this->hasChildren) {
            foreach ($this->children as $child) {
                if ($child->id == $categorieId) {
                    // We dont display the current categorie xor his children
                    continue;
                }
                $child->outputAsSelect($parentId, $categoryId);
            }
        }
        break;
}