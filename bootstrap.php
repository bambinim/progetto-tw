<?php
const PROJECT_ROOT = __DIR__;

// load database files
foreach (glob(PROJECT_ROOT . '/database/*.php') as $file) {
    require_once $file;
}

// load entities
foreach (glob(PROJECT_ROOT . '/database/Entities/*.php') as $file) {
    require_once $file;
}

// load security manager
require_once PROJECT_ROOT . "/SecurityManager.php";

// load Router classes
require_once PROJECT_ROOT . "/Router/SimpleRouter.php";
require_once PROJECT_ROOT . "/Router/Route.php";

use App\Database\Database;

Database::setHost('127.0.0.1');
Database::setDatabase('progettotw');
Database::setUser('root');
Database::setPassword('');

session_start();