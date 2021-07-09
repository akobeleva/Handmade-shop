<div>
    <div class="row">
        <div class="col-md-3">
            <?php
            if (isset($leftMenuItems)): ?>
                <div class="list-group">
                    <?php
                    foreach ($leftMenuItems as $item): ?>
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
