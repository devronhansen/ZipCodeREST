<?php

use Gears\Router;
use ZipCodesREST\controllers\ZipCodesController;
use ZipCodesREST\database\GermanDatabase;

Router::get('/de/{request}', function ($request) {
    $zipCodesController = new ZipCodesController(new GermanDatabase());
    echo $zipCodesController->show($request);
});