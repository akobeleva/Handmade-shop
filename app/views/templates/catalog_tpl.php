<div class="catalog">
    <div class="row wow fadeIn">
        <?php
        if (isset($catalogItems)):
            foreach ($catalogItems as $item): ?>
                <div class="col-md-<?php if (isset($columnWidth)) echo $columnWidth; ?> mb-4">
                    <?php if (isset($item['card'])) echo $item['card']; ?>
                </div>
            <?php
            endforeach;
        endif;
        ?>
    </div>
</div>