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

use App\Database\Database;

Database::setHost('db.matteobambini.net');
Database::setDatabase('progettotw');
Database::setUser('matteo');
Database::setPassword('password');