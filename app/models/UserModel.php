<?php

namespace app\models;

use core\Model;
use database\QueryBuilder;

class UserModel extends Model
{
    private $id;
    private $login;
    private $password;
    private $email;
    private $name;
    private $role;

    protected static $table = 'user';

    public function __construct(
        $login,
        $password,
        $email,
        $name,
        $id = null,
        $role = null
    ) {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
        $this->id = $id;
        $this->role = $role;
    }

    public function save()
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->insert('login,password,email,name')->into(self::$table)
            ->values($this->login, $this->password,$this->email, $this->name)
            ->execute();
    }

    public static function checkUserByLogin($login): bool
    {
        $queryBuilder = new QueryBuilder();
        $rows = $queryBuilder->select()->from(static::$table)
            ->where('login', $login)->execute();
        return $rows != [];
    }

    public static function checkUserByEmail($email): bool
    {
        $queryBuilder = new QueryBuilder();
        $rows = $queryBuilder->select()->from(static::$table)
            ->where('email', $email)->execute();
        return $rows != [];
    }
}