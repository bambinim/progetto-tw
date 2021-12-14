<?php

namespace App\Database;

use PDO;

class Database
{
    private static $host = '127.0.0.1';
    private static $port = 3306;
    private static $database = null;
    private static $user = null;
    private static $password = null;

    private function __construct(){}

    public static function setHost($host)
    {
        Database::$host = $host;
    }

    public static function setPort($port)
    {
        Database::$port = $port;
    }

    public static function setDatabase($database)
    {
        Database::$database = $database;
    }

    public static function setUser($user)
    {
        Database::$user = $user;
    }

    public static function setPassword($password)
    {
        Database::$password = $password;
    }

    public static function getConnection() :PDO
    {
        $conn = new PDO('mysql:host=' . Database::$host . ';port=' . Database::$port . ';dbname=' . Database::$database,
            Database::$user, Database::$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    /**
     * Returns repository configured from current entity
     * @param $class
     * @return EntityRepository
     */
    public static function getRepository($class): EntityRepository {
        return new EntityRepository($class::_getTableName(), $class::_getColumns(), $class);
    }
}