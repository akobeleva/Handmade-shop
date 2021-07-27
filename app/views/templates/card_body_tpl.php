<div class="card-body">
    <?php
        if (isset($link)): ?>
        <a href="<?php echo $link; ?>/<?php if (isset($entity)) echo $entity->getId();?>" class="grey-text text-center">
            <?php if (isset($entity)): ?>
            <h5><?php echo $entity->getName(); ?></h5>
            <?php endif; ?>
        </a>
    <?php
    endif; ?>
    <div>
        <?php
        if (isset($entity) && isset($additionalClass)): ?>
            <span class="product-price"><?php
                echo $entity->getPrice() . '₽' ?></span>
            <div class="product_buttons text-end">
                <button type="button" class="btn btn-outline-info btn-circle">
                    <img src="/img/heart.png" alt="" class="rounded mx-auto d-block"></button>
                <button type="button" class="btn btn-outline-info btn-circle">
                    <img src="/img/shopping-bag.png" alt="" class="rounded mx-auto d-block"></button>
            </div>
        <?php
        endif; ?>
    </div>
</div>