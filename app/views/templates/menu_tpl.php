<ul class="menu_list">
    <li><a href="/catalog">Каталог</a></li>
    <?php
    if (isset($menuItems)) :
        foreach ($menuItems as $item):
            if (isset($item['link'])): ?>
                <li><a href="<?php echo $item['link']; ?>"><?php echo $item['name']; ?></a></li>
            <?php
            endif;
        endforeach;
    endif;
    ?>
</ul>