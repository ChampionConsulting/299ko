<?php

/**
 * @copyright (C) 2024, Champion Consulting, LLC.
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

class router extends AltoRouter {

    /**
     * 
     * @var \router
     */
    private static $instance;

    protected static $url;

    private function __construct() {
        if (!empty($_SERVER['REQUEST_URL'])) {
            $url = $this->stripFbclid($_SERVER['REQUEST_URL']);
        } else {
            $url = $this->stripFbclid($_SERVER['REQUEST_URI']);
        }
        $url = str_replace('index.php', '', $url);
        $url = str_replace('//', '/', $url);
        self::$url = $url;
        parent::__construct();
        $this->setBasePath(str_replace('\\', '/', BASE_PATH));
        $this->map('GET', '/', 'CoreController#renderHome', 'home');
        $this->map('GET', '/index.php[/?]', 'CoreController#renderHome');
        $this->map('GET', '/admin/', 'CoreController#renderAdminHome', 'admin');
    }
    
    public function getCleanURI() {
        $requestUrl = self::$url;
        return substr($requestUrl, strlen($this->basePath));
    }

    protected function stripFbclid($url) {
        $patterns = array(
                '/(\?|&)fbclid=[^&]*$/' => '',
                '/\?fbclid=[^&]*&/' => '?',
                '/&fbclid=[^&]*&/' => '&'
        );
        $search = array_keys($patterns);
        $replace = array_values($patterns);
        return preg_replace($search, $replace, $url);
    }

    /**
     * Return Core Instance
     * 
     * @return \self
     */
    public static function getInstance() {
        if (is_null(self::$instance))
            self::$instance = new router();
        return self::$instance;
    }

    public function generate($routeName, array $params = []):string {
        return parent::generate($routeName, $params);
    }

    public function match ($requestUrl = null, $requestMethod = null) {
        return parent::match(self::$url);
    }

    public function getUri():string {
        return self::$url;
    }

}