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
    <div class="subheader">
        <a href="/" class="logo"><img src="/img/logo.jpg" alt=""></a>

        <div class="buttons">
            <a href="/"><img src="/img/shopping-bag.png" alt=""></a>
            <a href="/""><img src="/img/avatar.png" alt=""></a>
            <a href="/">Sign In</a>
        </div>
    </div>
    <nav class="menu">
        <?php
        $menuController = new MenuController();
        $menuController->indexAction();
        ?>
    </nav>
</header>
<div class="content">
    <?= $content ?>
</div>
<footer>
    <span>Авторские изделия ручной работы</span>
    <div class="buttons_info">
        <a href="/about" class="btn_about">О нас</a>
        <a href="/contacts" class="btn_contacts">Контакты</a>
    </div>
    <span>©2021</span>
</footer>
</body>
</html>
