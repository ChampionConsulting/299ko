<?php

/**
 * @copyright (C) 2025, Champion Consulting, LLC
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') or exit('Access denied!');

class ConfigManagerBackupAdminController extends AdminController {

    public function home(): AdminResponse {

        $response = new AdminResponse();
        $tpl = $response->createPluginTemplate('configmanager', 'backup');
        $response->setTitle(lang::get('configmanager-backup-desc'));
        $backups = ConfigManagerBackupsManager::getAll();
        $tpl->set('backups', $backups);
        $tpl->set('token', $this->user->token);
        $tpl->set('emptyBackups', empty($backups));
        
        $response->addTemplate($tpl);
        return $response;
    }

    public function create($token) {
        if (!$this->user->isAuthorized()) {
            $this->core->redirect($this->router->generate('configmanager-backup'));
        }
        $filename = DATA_PLUGIN . 'configmanager' . DS . 'backup-' . date('Y-m-d-H-i-s') . '.zip';
        $ignore = [
            '/.*backup-.*\.zip/i',
            '/.*\.git.*/i'
        ];
        $result = Zip::createZipFromFolder(ROOT, $filename, $ignore);
        if ($result) {
            show::msg(lang::get('configmanager-backup-done-success'), 'success');
        } else {
            show::msg(lang::get('configmanager-backup-done-error'), 'error');
        }
        $this->core->redirect($this->router->generate('configmanager-backup'));
    }

    public function download($token, $timestamp) {
        if (!$this->user->isAuthorized()) {
            $this->core->redirect($this->router->generate('configmanager-backup'));
        }
        $filename = DATA_PLUGIN . 'configmanager' . DS . 'backup-' . date('Y-m-d-H-i-s', $timestamp) . '.zip';
        header('Content-Type: application/zip');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"" . basename($filename) . "\""); 
        readfile($filename); 
    }

    public function delete()
    {
        $response = new ApiResponse();
        if (!$this->user->isAuthorized()) {
            $response->status = ApiResponse::STATUS_NOT_AUTHORIZED;
            return $response;
        }
        $backups = ConfigManagerBackupsManager::getAll();
        $id = (int) $this->jsonData['timestamp'] ?? 0;
        if (isset($backups[$id])) {
            $res = $backups[$id]->delete();
        } else {
            $response->status = ApiResponse::STATUS_NOT_FOUND;
            return $response;
        }
        if ($res) {
            $response->status = ApiResponse::STATUS_NO_CONTENT;
        } else {
            $response->status = ApiResponse::STATUS_BAD_REQUEST;
        }
        return $response;
    }
        
}