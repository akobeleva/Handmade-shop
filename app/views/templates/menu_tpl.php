<ul class="menu_list">
    <li><a href="/catalog">Каталог</a></li>
    <?php
    if (isset($menuItems)) :
        foreach ($menuItems as $item):
            if (isset($item['link'])): ?>
                <li><a href="<?php echo $item['link']; ?>"><?php if (isset($item['entity'])) echo $item['entity']->getName(); ?></a></li>
            <?php
            endif;
        endforeach;
    endif;
    ?>
</ul>