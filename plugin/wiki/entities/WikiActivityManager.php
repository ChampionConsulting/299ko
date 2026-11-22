<?php

/**
 * @copyright (C) 2024, Champion CMS, based on code (2010-2021) 299ko https://github.com/299Ko/
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * @author Ronald Ingraham <ronald@championconsulting.com>
 * 
 * @package Champion CMS https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

/**
 * Gestionnaire des activités du Wiki
 * 
 * Gère l'enregistrement et l'affichage des dernières activités du wiki
 */
class WikiActivityManager {

    private string $activityFile;
    private array $activities = [];

    public function __construct() {
        $this->activityFile = DATA_PLUGIN . 'wiki/activities.json';
        $this->loadActivities();
    }

    /**
     * Charger les activités depuis le fichier JSON
     * 
     * @return void
     */
    private function loadActivities() {
        if (file_exists($this->activityFile)) {
            $this->activities = util::readJsonFile($this->activityFile);
        } else {
            $this->activities = [];
        }
    }

    /**
     * Sauvegarder les activités dans le fichier JSON
     * 
     * @return void
     */
    private function saveActivities() {
        util::writeJsonFile($this->activityFile, $this->activities);
    }

    /**
     * Ajouter une nouvelle activité
     * 
     * @param string $action Type d'action ('add', 'edit', 'delete', 'welcome')
     * @param string $pageName Nom de la page concernée
     * @param string $categoryName Nom de la catégorie (optionnel)
     * @param int $pageId ID de la page (optionnel)
     * @return void
     */
    public function addActivity(string $action, string $pageName, string $categoryName = '', int $pageId = 0) {
        $activity = [
            'action' => $action,
            'pageName' => $pageName,
            'categoryName' => $categoryName,
            'pageId' => $pageId,
            'timestamp' => time(),
            'date' => date('Y-m-d H:i:s')
        ];

        array_unshift($this->activities, $activity);

        $this->activities = array_slice($this->activities, 0, 50);

        $this->saveActivities();
    }

    /**
     * Obtenir la dernière activité enregistrée
     * 
     * @return array|null Dernière activité ou null si aucune
     */
    public function getLastActivity() {
        if (empty($this->activities)) {
            return null;
        }
        return $this->activities[0];
    }

    /**
     * Formater la dernière activité pour l'affichage
     * 
     * @return array|null Activité formatée ou null si aucune
     */
    public function getFormattedLastActivity() {
        $activity = $this->getLastActivity();
        if (!$activity) {
            return null;
        }

        $date = util::getDate($activity['timestamp']);
        
        switch ($activity['action']) {
            case 'add':
                $text = "Adding the page <strong>{$activity['pageName']}</strong>";
                break;
            case 'edit':
                $text = "Editing the page <strong>{$activity['pageName']}</strong>";
                break;
            case 'delete':
                $text = "Page removal <strong>{$activity['pageName']}</strong>";
                break;
            case 'welcome':
                $text = "Welcome to the <strong>{$activity['pageName']}</strong>";
                break;
            default:
                $text = "Action on the page <strong>{$activity['pageName']}</strong>";
        }

        if (!empty($activity['categoryName'])) {
            $text .= " In <em>{$activity['categoryName']}</em>";
        }

        $text .= " le {$date}";

        return [
            'text' => $text,
            'timestamp' => $activity['timestamp'],
            'date' => $date
        ];
    }

    /**
     * Obtenir toutes les activités (pour debug)
     * 
     * @return array Liste de toutes les activités
     */
    public function getAllActivities() {
        return $this->activities;
    }
} 