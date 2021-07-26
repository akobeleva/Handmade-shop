<?php

namespace database;

class QueryBuilder
{
    private $table = null;
    private $queryType;
    private $columns = [];
    private $joinTables = [];
    private $whereConditions = [];
    private $groupByColumns = [];
    private $orderByColumns = [];
    private $limit;
    private static $db;

    public function __construct()
    {
        if (static::$db === null) {
            static::$db = DB::getInstance();
        }
    }

    private function setQueryType(string $type)
    {
        $this->queryType = $type;
    }

    private function setJoinTable($type, $table)
    {
        $this->joinTables[] = [
            'type'  => $type,
            'table' => $table,
        ];
    }

    public function update()
    {
        $this->setQueryType("update");
    }

    public function select($columns = "*"): QueryBuilder
    {
        $this->setQueryType("select");
        $arrayColumns = explode(",", $columns);
        $this->columns = array_merge($this->columns, $arrayColumns);
        return $this;
    }

    public function where($column, $value, $operator = "="): QueryBuilder
    {
        $condition = $column . $operator . $value;
        $this->whereConditions[] = [
            'condition' => $condition,
        ];
        return $this;
    }

    public function whereIn($column, QueryBuilder $subQuery): QueryBuilder
    {
        $condition = $column . ' IN (' . $subQuery->getQueryString() . ')';
        $this->whereConditions[] = [
            'condition' => $condition,
        ];
        return $this;
    }

    public function from($table): QueryBuilder
    {
        $this->table = $table;
        return $this;
    }

    public function join($table): QueryBuilder
    {
        $this->setJoinTable('INNER JOIN', $table);
        return $this;
    }

    public function orderBy($columns): QueryBuilder
    {
        $arrayColumns = explode(",", $columns);
        $this->orderByColumns = array_merge(
            $this->orderByColumns,
            $arrayColumns
        );
        return $this;
    }

    public function groupBy($columns): QueryBuilder
    {
        $arrayColumns = explode(",", $columns);
        $this->groupByColumns = array_merge(
            $this->groupByColumns,
            $arrayColumns
        );
        return $this;
    }

    public function limit($limit): QueryBuilder
    {
        $this->limit = $limit;
        return $this;
    }

    public function getQueryString(): string
    {
        $queryString = '';
        switch ($this->queryType) {
            case "select":
                $queryString = "SELECT ";
                foreach ($this->columns as $column) {
                    $queryString = $queryString . $column . " ";
                }
                $queryString = $queryString . " FROM " . $this->table;
                if (count($this->joinTables) > 0) {
                    foreach ($this->joinTables as $joinTable) {
                        $queryString = $queryString . ' ' . $joinTable['type']
                            . ' ' . $joinTable['table'];
                    }
                }
                if (count($this->whereConditions) > 0) {
                    foreach ($this->whereConditions as $condition) {
                        $queryString = $queryString . " WHERE "
                            . $condition['condition'];
                    }
                }
                if (count($this->groupByColumns) > 0) {
                    foreach ($this->groupByColumns as $groupByColumn) {
                        $queryString = $queryString . " GROUP BY "
                            . $groupByColumn;
                    }
                }
                if (count($this->orderByColumns) > 0) {
                    foreach ($this->orderByColumns as $orderByColumn) {
                        $queryString = $queryString . " ORDER BY "
                            . $orderByColumn;
                    }
                }
                if ($this->limit !== null) {
                    $queryString = $queryString . " LIMIT " . $this->limit;
                }
        }
        return $queryString;
    }

    public function execute(): array
    {
        $sql = $this->getQueryString();
        return self::$db->executeQuery($sql);
    }
}