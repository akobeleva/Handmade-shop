<?php

namespace app\models;

use core\Model;

class StaticPageModel extends Model
{
    private $id;
    private $title;
    private $text;

    protected static $table = 'static_pages';
    protected static $db;

    public function __construct($id, $title, $text)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getText()
    {
        return $this->text;
    }

    protected static function rowsToEntities($rows): array
    {
        $staticPages = [];
        foreach ($rows as $row) {
            $staticPages[$row['id']] = self::rowToEntity($row);
        }
        return $staticPages;
    }

    protected static function rowToEntity($row): Model
    {
        return new StaticPageModel(
            $row['id'],
            $row['title'],
            $row['text']
        );
    }


}