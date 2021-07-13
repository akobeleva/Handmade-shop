<div class="catalog">
    <div class="row wow fadeIn">
        <?php
        if (isset($catalogItems)):?>
            <?php
            foreach ($catalogItems as $item): ?>
                <div class="col-lg-4 mb-4">
                    <div class="card p-3 h-100">
                        <a href="catalog/category/?id=<?php
                        echo $item['id'] ?>">
                            <img class="card-img-top
                            <?php
                            if (isset($item['subcategory_id'])) {
                                echo 'product_card';
                            }
                            ?> " src="/img/<?php
                            echo $item['image_name'] ?>"
                                 alt="">
                        </a>
                        <div class="card-body">
                            <a href="catalog/category/?id=<?php
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
                                                class="btn btn btn-outline-info btn-circle">
                                            <img src="/img/heart.png"
                                                 alt=""></button>
                                        <button type="button"
                                                class="btn btn btn-outline-info btn-circle">
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