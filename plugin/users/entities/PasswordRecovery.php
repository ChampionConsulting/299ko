<?php

/**
 * @copyright (C) 2024, Champion Consulting, LLC.
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') or exit('Access denied!');

class PasswordRecovery
{

    protected string $file;

    protected array $data;

    const EXPIRATION_TIME = 60 * 60 * 3;

    public function __construct()
    {
        $this->file = DATA_PLUGIN . 'users/pwd.json';
        if (!file_exists($this->file)) {
            util::writeJsonFile($this->file, []);
        }
        $this->data = util::readJsonFile($this->file);
        $this->sanitizeExpiredTokens();
    }

    protected function sanitizeExpiredTokens()
    {
        foreach ($this->data as $k => &$token) {
            if ($token['expiration'] < time()) {
                unset($this->data[$k]);
            }
        }
        $this->saveTokens();
    }

    protected function saveTokens()
    {
        util::writeJsonFile($this->file, $this->data);
    }

    public function insertToken(string $mail, string $token, string $pwd)
    {
        $this->data[] = [
            'mail' => $mail,
            'token' => $token,
            'pwd' => $pwd,
            'expiration' => time() + self::EXPIRATION_TIME
        ];
        $this->saveTokens();
    }

    public function deleteToken(string $token) {
        foreach ($this->data as $k => &$dToken) {
            if ($dToken['token'] == $token) {
                unset($this->data[$k]);
            }
        }
        $this->saveTokens();
    }

    /**
     * 
     */
    public function getTokenFromToken(string $token)
    {
        foreach ($this->data as $tk) {
            if ($tk['token'] === $token) {
                return $tk;
            }
        }
        return false;
    }

    public function generatePassword(): string
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars), 0, 8);
    }
}
