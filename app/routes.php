<?php

use Gears\Router;
use ZipCodesREST\Controllers\ZipCodesController;
use ZipCodesREST\Database\GermanDatabase;

Router::get('/de/{request}', function ($request) {
    header('Content-type:application/json;charset=utf-8');

    $config = include 'config.php';
    $zipCodesController = new ZipCodesController(new GermanDatabase(createPDO($config), $config['returnLimit']));
    echo $zipCodesController->show($request);
    exit;
});


/**
 * @param $config
 * @return PDO
 */
function createPDO($config): PDO
{
    $dbhost = $config['database']['host'];
    $dbname = $config['database']['dbname'];
    $dbusername = $config['database']['username'];
    $dbpassword = $config['database']['password'];

    try {
        return new \PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbusername, $dbpassword);
    } catch (\PDOException $e) {
        exit(json_encode(['Error' => 'Database Connection could not be established']));
    }
}