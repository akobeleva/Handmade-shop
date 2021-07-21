<div class="card p-3 h-100">
    <?php
    if (isset($link)): ?>
        <a href="<?php echo $link; ?>/<?php if (isset($entity)) echo $entity->getId();?>">
            <img class="card-img-top <?php if (isset($additionalClass)) echo $additionalClass;?>"
                src="/img/<?php if (isset($entity)) echo $entity->getImageName();?>" alt="">
        </a>
    <?php endif;
    if (isset($cardBody)) echo $cardBody; ?>
</div>