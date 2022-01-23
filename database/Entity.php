<?php

namespace App\Database;

use App\Database\Query;

abstract class Entity
{
    protected bool $isNew = true;

    public function __construct($isNew = true)
    {
        $this->isNew = $isNew;
    }

    /**
     * Converts entity in associative array
     */
    public function toArray(): array
    {
        $arr = [];
        $class = get_class($this);
        foreach ($class::_getColumns() as $i) {
            if ($i == $class::_getPrimaryKeyColName() && $this->isNew) {
                $arr[$i] = -1;
            } else {
                $arr[$i] = $this->{Entity::toCamelCase("get_" . $i)}();
            }
        }
        return $arr;
    }

    /**
     * Creates entity object from query result
     */
    public static function createFromQueryResult($queryResult, $entityClass): Entity
    {
        $columns = $entityClass::_getColumns();
        $res = new $entityClass(false);
        foreach ($columns as $i) {
            $res->{Entity::toCamelCase("set_" . $i)}($queryResult[$i]);
        }
        return $res;
    }

    public abstract static function _getColumns(): array;

    public abstract static function _getPrimaryKeyColName(): string;

    public abstract static function _getTableName(): string;

    /**
     * If the entity exists in the database updates it, else creates a new record
     */
    public function save()
    {
        $class = get_class($this);
        $values = $this->toArray();
        $pk = $class::_getPrimaryKeyColName();
        $table = $class::_getTableName();
        $columns = $class::_getColumns();
        $insertPk = $values[$pk] != -1;

        // create params
        $params = [];
        foreach ($values as $k => $v) {
            if ($k != $pk || $insertPk) {
                $params[":$k"] = $v;
            }
        }
        if ($this->isNew) {
            // create insert query string
            $query = "INSERT INTO $table (";
            // create columns string
            foreach ($columns as $i) {
                if ($i != $pk || $insertPk) {
                    $query = $query . "$i, ";
                }
            }
            $query = substr($query, 0, -2) . ") VALUES (";
            // create values string
            foreach($columns as $i) {
                if ($i != $pk || $insertPk) {
                    $query = $query . ":$i, ";
                }
            }
            $query = substr($query, 0, -2) . ");";
            $this->isNew = false;
        } else {
            $query = "UPDATE $table SET ";
            foreach ($columns as $i) {
                $query = $query . "$i = :$i, ";
            }
            $query = substr($query, 0, -2) . " WHERE $pk = :second_$pk";
            $params[":second_" . $pk] = $values[$pk];
        }
        $conn = Database::getConnection();
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        $this->{Entity::toCamelCase("set_" . $pk)}(intval($conn->lastInsertId()));
    }

    /**
     * Remove this entity from the database
     */
    public function delete() {
        $class = get_class($this);
        $pk = $class::_getPrimaryKeyColName();
        $table = $class::_getTableName();
        $values = $this->toArray();
        if ($values[$pk] != -1) {
            $query = "DELETE FROM $table WHERE $pk = $values[$pk];";
            $conn = Database::getConnection();
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $this->{Entity::toCamelCase("set_" . $pk)}(-1);
        }

    }

    private static function toCamelCase(string $str): string
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $str)));
    }
}