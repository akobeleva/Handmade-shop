<?php


namespace app\models;


use database\QueryBuilder;

class SearchModel extends ProductModel
{
    public static function search($query): array
    {
        $queryBuilder = new QueryBuilder();
        $rows = $queryBuilder->select()->from(self::$table)->where(
            'name',
            $query,
            'LIKE'
        )->whereOr('description', $query, 'LIKE')->execute();
        return self::rowsToEntities($rows);
    }
}