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

    public function getId()
    {
        return $this->id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function save()
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->insert('login,password,email,name')->into(self::$table)
            ->values($this->login, $this->password, $this->email, $this->name)
            ->execute();
    }

    public function update(){
        $queryBuilder = new QueryBuilder();
        $queryBuilder->update()->table(self::$table)->set('login', $this->login)
            ->set('email', $this->email)->set('name', $this->name)
            ->where('id', $this->id)->execute();
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

    public static function getUserByLogin($login): Model
    {
        $queryBuilder = new QueryBuilder();
        $rows = $queryBuilder->select()->from(static::$table)
            ->where('login', $login)->execute();
        return self::rowToEntity($rows[0]);
    }

    protected static function rowToEntity($row): Model
    {
        return new UserModel(
            $row['login'],
            $row['password'],
            $row['email'],
            $row['name'],
            $row['id'],
            $row['role']
        );
    }
}