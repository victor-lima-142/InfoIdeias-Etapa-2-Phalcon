<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));
ini_set('display_errors', 1);
date_default_timezone_set('America/Sao_Paulo');


try {

    /**
     * Read the configuration
     */
    $config = include APP_PATH . "/app/config/config.php";

    /**
     * Read auto-loader
     */
    include APP_PATH . "/app/config/loader.php";

    /**
     * Read services
     */
    include APP_PATH . "/app/config/services.php";

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    $response = $application->handle($_SERVER['REQUEST_URI']);
    $response->send();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
