<div class="card-body">
    <?php
        if (isset($link)): ?>
        <a href="<?php echo $link; ?>/<?php if (isset($id)) echo $id;?>" class="grey-text text-center">
            <?php if (isset($name)): ?>
            <h5><?php echo $name; ?></h5>
            <?php endif; ?>
        </a>
    <?php
    endif; ?>
    <div>
        <?php
        if (isset($price)): ?>
            <span class="product-price"><?php
                echo $price . '₽' ?></span>
            <div class="product_buttons text-end">
                <button type="button" class="btn btn-outline-info btn-circle">
                    <img src="/img/heart.png" alt=""></button>
                <button type="button" class="btn btn-outline-info btn-circle">
                    <img src="/img/shopping-bag.png" alt=""></button>
            </div>
        <?php
        endif; ?>
    </div>
</div>