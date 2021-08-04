<?php

namespace app\middleware;

class Validator
{
    public function validateRegisterData($data): array
    {
        $messages = array();
        if (isset($data['login'])) {
            if (trim($data['login']) == "") {
                $messages[] = "Введите логин";
            }
            if (mb_strlen($data['login']) < 5 || mb_strlen($data['login']) > 90) {
                $messages[] = "Недопустимая длина логина";
            }
        }
        if (isset($data['password'])) {
            if (trim($data['password']) == "") {
                $messages[] = "Введите пароль";
            }
            if (mb_strlen($data['password']) < 6 || mb_strlen(($data['password']) > 20)) {
                $messages[] = "Недопустимая длина пароля";
            }
        }
        if (isset($data['email'])) {
            if (trim($data['email']) == "") {
                $messages[] = "Введите E-mail";
            }
            if (!preg_match(
                "/[0-9a-z_]+@[0-9a-z_^]+\.[a-z]{2,3}/i",
                $data['email']
            )
            ) {
                $messages[] = 'Неверно введен E-mail';
            }
        }
        if (isset($data['username'])) {
            if (trim($data['username']) == "") {
                $messages[] = "Введите имя пользователя";
            }
            if (mb_strlen($data['username']) < 4 || mb_strlen(($data['username']) > 30)) {
                $messages[] = "Недопустимая длина имени пользователя";
            }
        }
        return $messages;
    }
}