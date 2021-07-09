<div class="container content">
    <div class="row">
        <div class="col-md-4">
            <?php
            if (isset($menuItems)): ?>
                <div class="list-group">
                    <?php
                    foreach ($menuItems as $item): ?>
                        <a href="/catalog/?category=<?php
                        echo $item['category_id'] ?>&subcategory=<?php
                        echo $item['id'] ?>" class="list-group-item"><?php
                            echo $item['name'] ?></a>
                    <?php
                    endforeach; ?>
                </div>
            <?php
            endif; ?>
        </div>
    </div>
</div>
