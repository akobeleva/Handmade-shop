<?php
if (isset($title)) : ?>
    <h1> <?php echo $title; ?></h1>
<?php endif; ?>
<div>
    <div class="row">
        <div class="col-md-3">
            <?php
            if (isset($leftMenuItems)): ?>
                <div class="list-group">
                    <?php
                    foreach ($leftMenuItems as $item):
                        if (isset($item['link'])):?>
                            <a href = "<?php echo $item['link'];?>" class="list-group-item"><?php if (isset($item['entity'])) echo $item['entity']->getName();
                                elseif (isset($item['name'])) echo $item['name'];?></a>
                    <?php endif;
                    endforeach; ?>
                </div>
            <?php
            endif; ?>
        </div>
        <div class="col-md-9">
            <?php
            if (isset($rightContent)) {
                echo $rightContent;
            }
            ?>
        </div>
    </div>
</div>
