<?php

namespace App\Database;

use Exception;
use PDO;

class Query
{
    private $select = null;
    private $from = null;
    private $where = null;
    private $limit = null;
    private $orderBy = null;
    private $params = null;

    public function select($columns) :Query
    {
        $this->select = $columns;
        return $this;
    }

    public function from($table) :Query
    {
        $this->from = $table;
        return $this;
    }

    public function where($condition) :Query
    {
        $this->where = $condition;
        return $this;
    }

    public function limit($limit) :Query
    {
        $this->limit = $limit;
        return $this;
    }

    public function orderBy($order) :Query
    {
        $this->orderBy = $order;
        return $this;
    }

    public function setParams($params) :Query
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function execute() :array
    {
        $query = $this->getQueryString();
        $conn = Database::getConnection();
        $cursor = $conn->prepare($query);
        $cursor->execute($this->params);
        $data = $cursor->fetchAll();
        $cursor->closeCursor();
        return $data;
    }

    public function getQueryString(): string
    {
        if (is_null($this->select) || is_null($this->from))
        {
            throw new Exception('Select or from values not set');
        }
        $query = "SELECT {$this->select} FROM {$this->from}";
        if (!is_null($this->where))
        {
            $query = $query ." WHERE {$this->where}";
        }
        if (!is_null($this->orderBy))
        {
            $query = $query . " ORDER BY {$this->orderBy}";
        }
        if (!is_null($this->limit))
        {
            $query = $query . " LIMIT {$this->limit}";
        }
        return $query . ';';
    }

    public static function create() :Query
    {
        return new Query();
    }
}