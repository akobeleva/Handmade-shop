<?php

if (isset($title)) : ?>
    <h1> <?php
        echo $title; ?></h1>
<?php
endif; ?>
<?php
if (isset($vars)) :?>
    <div>  <?php
        echo $vars['text']; ?> </div>
<?php
endif; ?>
