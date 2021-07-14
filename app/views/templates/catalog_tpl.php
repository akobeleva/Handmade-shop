<div class="catalog">
    <div class="row wow fadeIn">
        <?php
        if (isset($catalogItems)):?>
            <?php
            foreach ($catalogItems as $item): ?>
                <div class="col-md-<?php
                if (isset($item['subcategory_id'])) {
                    echo '4';
                } else {
                    echo '3';
                } ?> mb-4">
                    <div class="card p-3 h-100">
                        <?php
                        if (isset($item['subcategory_id'])) { ?>
                            <a href="/catalog/product/?id=<?php
                            echo $item['id'] ?>">
                                <img class="card-img-top product_card"
                                     src="/img/<?php
                                     echo $item['image_name'] ?>" alt="">
                            </a>
                            <?php
                        } else { ?>
                            <a href="/catalog/category/?id=<?php
                            echo $item['id'] ?>">
                                <img class="card-img-top" src="/img/<?php
                                echo $item['image_name'] ?>" alt="">
                            </a>
                            <?php
                        } ?>
                        <div class="card-body">
                            <a href="/catalog/<?php
                            if (isset($item['subcategory_id'])) {
                                echo 'product';
                            } else {
                                echo 'category';
                            }
                            ?>/?id=<?php
                            echo $item['id'] ?>" class="grey-text text-center ">
                                <h5><?php
                                    echo $item['name'] ?></h5>
                            </a>
                            <div>
                                <?php
                                if (isset($item['price'])): ?>
                                    <span class=" product-price"><?php
                                        echo $item['price'] . '₽' ?></span>
                                <?php
                                endif; ?>
                                <?php
                                if (isset($item['price'])): ?>
                                    <div class="product_buttons text-end">
                                        <button type="button"
                                                class="btn btn-outline-info btn-circle">
                                            <img src="/img/heart.png"
                                                 alt=""></button>
                                        <button type="button"
                                                class="btn btn-outline-info btn-circle">
                                            <img src="/img/shopping-bag.png"
                                                 alt=""></button>
                                    </div>
                                <?php
                                endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach; ?>
        <?php
        endif;
        ?>
    </div>
</div>