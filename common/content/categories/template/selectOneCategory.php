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
        if (empty($this->imbricatedCategories)) {
            $noCategoriesText = lang::get('blog.categories.none');
            $addCategoryLink = '<a href="index.php?p=categories&plugin=' . $this->pluginId . '">' . lang::get('blog.categories.addOne') . '</a>';
            echo $noCategoriesText . ' ' . $addCategoryLink;
            return;
        }
        ?>
        <select name="<?php echo $fieldName; ?>" id="<?php echo $fieldName; ?>">
            <option value="0"><?php echo lang::get('blog.categories.none'); ?></option>
        
        <?php
        foreach ($this->imbricatedCategories as $cat) {
            $cat->outputAsSelectOne($itemId);
        }
        ?>
        </select>
        <?php
        break;
    case 'sub':
        // Categories
        ?>
        <option value="<?php echo $this->id; ?>" <?php if (in_array($itemId, $this->items)) echo ' selected'; ?> >
            <?php echo str_repeat("-", ($this->depth * 2)) . ' ' . $this->label; ?>
        </option>
        <?php if ($this->hasChildren) {
            foreach ($this->children as $child) {
                $child->outputAsSelectOne($itemId);
            }
        }
        break;
}