<?php

namespace App\Database;

class EntityRepository
{
    private $table;
    private $columns;
    private $entityClass;
    private EntityRepository $repository;

    public function __construct($table, $columns, $class)
    {
        $this->table = $table;
        $this->columns = $columns;
        $this->entityClass = $class;
    }

    private function createSelectString(): string
    {
        $selectString = '';
        foreach ($this->columns as $i)
        {
            $selectString = $selectString . "{$i}, ";
        }
        return substr($selectString, 0, -2);
    }

    private function processQueryConditions($conditions): array
    {
        $conditionString = '';
        $paramsBind = [];
        foreach ($conditions as $k=>$v) {
            $conditionString = $conditionString . "{$k} = :{$k}";
            $paramsBind[":{$k}"] = $v;
        }
        return [
            'conditionString' => $conditionString,
            'paramBinds' => $paramsBind
        ];
    }

    private function createQueryWithConditions($conditions): Query
    {
        $params = $this->processQueryConditions($conditions);
        $query = new Query();
        return Query::create()->select($this->createSelectString())
            ->from($this->table)
            ->where($params['conditionString'])
            ->setParams($params['paramBinds']);
    }

    public function find($conditions): ?array
    {
        if (count($conditions) == 0)
        {
            return null;
        }
        $query = $this->createQueryWithConditions($conditions);
        $data = $query->execute();
        $res = [];
        foreach ($data as $i)
        {
            array_push($res, Entity::createFromQueryResult($i, $this->entityClass));
        }
        return $res;
    }

    public function findOne($conditions): ?Entity
    {
        if (count($conditions) == 0)
        {
            return null;
        }
        $query = $this->createQueryWithConditions($conditions);
        $query->limit(1);
        $data = $query->execute();
        if (sizeof($data) != 1)
        {
            return null;
        }
        else
        {
            return Entity::createFromQueryResult($data[0], $this->entityClass);
        }
    }

    public function findAll(): array
    {
        $query = new Query();
        $data = $query->select($this->createSelectString())->from($this->table)->execute();
        $res = [];
        foreach ($data as $i)
        {
            array_push($res, Entity::createFromQueryResult($i, $this->entityClass));
        }
        return $res;
    }
}