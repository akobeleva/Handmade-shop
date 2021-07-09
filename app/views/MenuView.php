<ul class="menu_list">
    <li><a href="/catalog">Каталог</a></li>
    <?php
    if (isset($menuItems)) {
        foreach ($menuItems as $item): ?>
            <li><a href="/catalog/?category=<?php echo $item['id'];?>"><?php
                    echo $item['name'];?></a></li>
        <?php
        endforeach;
    } ?>
</ul>
