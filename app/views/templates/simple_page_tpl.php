<?php

if (isset($title)) : ?>
    <h1> <?php
        echo $title; ?></h1>
<?php
endif; ?>
<?php
if (isset($text)) :?>
    <div>  <?php
        echo $text; ?> </div>
<?php
endif; ?>
<?php if (isset($leftMenu)) :?>
    <div>  <?php
        echo $leftMenu; ?> </div>
<?php
endif; ?>
