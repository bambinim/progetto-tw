<?php

// require_once('./database/Database.php');

// load database files
$dbFiles = glob('database/*.php');
foreach ($dbFiles as $file) {
    require_once($file);
}

// load entities
$dbFiles = glob('database/Entities/*.php');
foreach ($dbFiles as $file) {
    require_once($file);
}

use App\Database\Database;

Database::setHost('');
Database::setDatabase('progettotw');
Database::setUser('');
Database::setPassword('');