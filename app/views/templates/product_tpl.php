<?php

if (isset($product)):
    ?>
    <div class="container mt-4 mb-4">
        <div class="row g-3">
            <div class="col-lg-8">
                <div class="border p-5">
                    <img class="img-fluid mx-auto d-block" src="/img/<?php
                    echo $product['image_name'] ?>" alt="">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="border p-3">
                    <h4><?php
                        echo $product['name']; ?></h4>
                    <span class='price'>Цена: <?php
                        echo $product['price'] . '₽'; ?></span>
                    <div class="product_buttons text-end">
                        <button type="button"
                                class="btn btn-info btn-floating">
                            <img src="/img/heart.png"
                                 alt=""></button>
                        </button>
                        <button type="button" class="btn btn-info">В корзину
                        </button>
                    </div>
                </div>
                <div class="border p-3">
                    <span class='seller'>Продавец: <?php
                        echo $product['seller_id']; ?></span>
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-dark">
                            Контакты продавца
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="border p-3">
                    <h4>Описание товара</h4>
                    <span class="description"><?php
                        echo $product['description']; ?></span>
                </div>
            </div>
        </div>
    </div>
<?php
endif; ?>
