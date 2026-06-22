<?php

use App\Router;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/helpers/helper.php';
require_once __DIR__ . '/helpers/constantes.php';
// demarrer la session lorsque le script est executer pour la premiere fois
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

Router::run();
