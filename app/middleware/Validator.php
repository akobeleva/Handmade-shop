<?php

namespace app\middleware;

class Validator
{
    public function validateRegisterData($data): array
    {
        $messages = array();
        if (isset($data['login'])) {
            $messages = array_merge($messages, $this->validateLogin($data['login']));
        }
        if (isset($data['password'])) {
            $messages = array_merge($messages, $this->validatePassword($data['password']));
        }
        if (isset($data['email'])) {
            $messages = array_merge($messages, $this->validateEmail($data['email']));
        }
        if (isset($data['username'])) {
            $messages = array_merge($messages, $this->validateUsername($data['username']));
        }
        return $messages;
    }

    public function validateProfileSettingsData($data): array
    {
        $messages = array();
        if (isset($data['username'])) {
            $messages = array_merge($messages, $this->validateUsername($data['username']));
        }
        if (isset($data['login'])) {
            $messages = array_merge($messages, $this->validateLogin($data['login']));
        }
        if (isset($data['email'])) {
            $messages = array_merge($messages, $this->validateEmail($data['email']));
        }
        return $messages;
    }

    private function validateLogin($login): array
    {
        $messages = [];
        if (trim($login) == "") {
            $messages[] = "Введите логин";
        }
        if (mb_strlen($login) < 5 || mb_strlen($login) > 90) {
            $messages[] = "Недопустимая длина логина";
        }
        return $messages;
    }

    private function validatePassword($password): array
    {
        $messages = [];
        if (trim($password) == "") {
            $messages[] = "Введите пароль";
        }
        if (mb_strlen($password) < 6 || mb_strlen(($password) > 20)) {
            $messages[] = "Недопустимая длина пароля";
        }
        return $messages;
    }

    private function validateEmail($email): array
    {
        $messages = [];
        if (trim($email) == "") {
            $messages[] = "Введите E-mail";
        }
        if (!preg_match("/[0-9a-z_]+@[0-9a-z_^]+\.[a-z]{2,3}/i", $email)) {
            $messages[] = 'Неверно введен E-mail';
        }
        return $messages;
    }

    private function validateUsername($username): array
    {
        $messages = [];
        if (trim($username) == "") {
            $messages[] = "Введите имя пользователя";
        }
        if (mb_strlen($username) < 4 || mb_strlen(($username) > 30)) {
            $messages[] = "Недопустимая длина имени пользователя";
        }
        return $messages;
    }
}