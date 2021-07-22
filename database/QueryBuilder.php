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

    private function setQueryType(string $type)
    {
        $this->queryType = $type;
    }

    public function update()
    {
        $this->setQueryType("update");
    }

    public function select($columns = "*"): QueryBuilder
    {
        $this->setQueryType("select");
        $arrayColumns = explode(",", $columns);
        $this->columns = array_merge($columns, $arrayColumns);
        return $this;
    }

    public function where($column, $value, $operator = "="): QueryBuilder
    {
        $condition = $column . $operator . $value;
        $this->whereConditions[] = [
            'condition' => $condition,
            'column'    => $column,
            'value'     => $value,
            'operator'  => $operator,
        ];
        return $this;
    }

    public function from($tableName): QueryBuilder
    {
        $this->table = $tableName;
        return $this;
    }

    public function join($tableName)
    {
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

    public function getQueryString()
    {
        switch ($this->queryType){
            case "select":
                $queryString = "SELECT ";
                foreach ($this->columns as $column){
                    $queryString = $queryString . $column . " ";
                }
                $queryString .= $queryString. "FROM " . $this->table;

                foreach ($this->whereConditions as $condition){
                    $queryString = $queryString . "WHERE " . $condition['condition'];
                }
                if (count($this->groupByColumns) > 0){
                    foreach ($this->groupByColumns as $groupByColumn)
                    $queryString = $queryString . "GROUP BY " . $groupByColumn;
                }
                if (count($this->orderByColumns)>0){
                    foreach ($this->orderByColumns as $orderByColumn)
                        $queryString = $queryString . "ORDER BY " . $orderByColumn;
                }
                if ($this->limit !== null){
                    $queryString = $queryString . "LIMIT " .$this->limit;
                }
        }
    }
}