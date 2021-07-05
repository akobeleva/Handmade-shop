<ul class="menu_list">
    <li><a href="/catalog">Каталог</a></li>
    <?php
    if (isset($data)) {
        foreach ($data as $item): ?>
            <li><a href="/"><?php
                    echo $item['name'] ?></a></li>
        <?php
        endforeach;
    } ?>
</ul>
