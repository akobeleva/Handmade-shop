<div class="card p-3 h-100">
    <?php
    if (isset($link)): ?>
        <a href="<?php echo $link; ?>/?id=<?php if (isset($id)) echo $id;?>">
            <img class="card-img-top <?php if (isset($additionalClass)) echo $additionalClass;?>"
                src="/img/<?php if (isset($image_name)) echo $image_name;?>" alt="">
        </a>
    <?php endif;
    if (isset($cardBody)) echo $cardBody; ?>
</div>