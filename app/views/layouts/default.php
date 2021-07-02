<?php

use app\controllers\MenuController;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/main.css" rel="stylesheet">

    <title>Handmade shop</title>
</head>
<body>
<header>
    <a href="/" class="logo"><img src="/img/logo.jpg" alt=""></a>

    <div class="buttons">
        <a href="/"><img src="/img/shopping-bag.png" alt=""></a>
        <a href="/""><img src="/img/avatar.png" alt=""></a>
        <a href="/">Sign In</a>
    </div>

</header>
    <?php
    $menuController = new MenuController();
    $menuController->indexAction();
    ?>
<div class="content">
    <?= $content ?>
</div>
<footer>
    Авторские изделия ручной работы
    <div class="buttons_info">
        <a href="/about" class="btn_about">О нас</a>
        <a href="/contacts" class="btn_contacts">Контакты</a>
    </div>
    ©2021
</footer>
</body>
</html>
