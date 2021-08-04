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
    private $values = [];
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

    public function insert($columns): QueryBuilder
    {
        $this->setQueryType("insert");
        $arrayColumns = explode(",", $columns);
        $this->columns = array_merge(
            $this->columns,
            $arrayColumns
        );
        return $this;
    }

    public function delete(): QueryBuilder
    {
        $this->setQueryType("delete");
        return $this;
    }

    public function select($columns = "*"): QueryBuilder
    {
        $this->setQueryType("select");
        $arrayColumns = explode(",", $columns);
        $this->columns = array_merge($this->columns, $arrayColumns);
        return $this;
    }

    private function setWhereCondition(
        $column,
        $value,
        $operator,
        $whereOperator = null
    ) {
        if ($operator == 'LIKE') {
            $condition = $whereOperator . ' ' . $column . ' ' . $operator . ' '
                . "'%" . $value . "%'";
        } elseif ($operator == "IN") {
            $condition = $whereOperator . ' ' . $column . ' ' . $operator
                . ' (' . $value . ')';
        } elseif (is_string($value)) {
            $condition = $whereOperator . ' ' . $column . $operator . "'"
                . $value . "'";
        } else {
            $condition = $whereOperator . ' ' . $column . $operator . $value;
        }
        $this->whereConditions[] = [
            'condition' => $condition,
        ];
    }

    public function where($column, $value, $operator = "="): QueryBuilder
    {
        $this->setWhereCondition($column, $value, $operator);
        return $this;
    }

    public function whereIn($column, QueryBuilder $subQuery): QueryBuilder
    {
        $this->setWhereCondition($column, $subQuery->getQueryString(), 'IN');
        return $this;
    }

    public function whereOr($column, $value, $operator): QueryBuilder
    {
        $this->setWhereCondition($column, $value, $operator, 'OR');
        return $this;
    }

    public function from($table): QueryBuilder
    {
        $this->table = $table;
        return $this;
    }

    public function into($table): QueryBuilder
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

    public function values(... $values): QueryBuilder
    {
        $this->values = $values;
        return $this;
    }

    public function getQueryString(): string
    {
        $queryString = '';
        switch ($this->queryType) {
            case "insert":
                $queryString = "INSERT INTO " . $this->table;
                if (!empty($this->columns)){
                    $queryString = $queryString ."(";
                    $queryString = $queryString . implode(",", $this->columns);
                    $queryString = $queryString .") ";
                }
                if (!empty($this->values)){
                    $queryString = $queryString ."VALUES (";
                    foreach ($this->values as &$value) {
                        if (is_string($value)) $value = "'". $value . "'";
                    }
                    $queryString = $queryString . implode(",", $this->values);
                    $queryString = $queryString .")";
                }
                break;
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
                    $queryString = $queryString . " WHERE ";
                    foreach ($this->whereConditions as $condition) {
                        $queryString = $queryString . $condition['condition'];
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
                break;
            case "delete":
                $queryString = "DELETE ";
                $queryString = $queryString . " FROM " . $this->table;
                if (count($this->whereConditions) > 0) {
                    $queryString = $queryString . " WHERE ";
                    foreach ($this->whereConditions as $condition) {
                        $queryString = $queryString . $condition['condition'];
                    }
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