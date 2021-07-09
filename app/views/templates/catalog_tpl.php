<div class="catalog">
    <div class="row wow fadeIn">
        <?php
        if (isset($catalogItems)) {
            foreach ($catalogItems as $item): ?>
                <div class="col-lg-4 mb-4">
                    <div class="card pt-3">
                        <a href="/catalog/?category=<?php echo $item['id'] ?>"><img class="card-img-top" src="/img/<?php
                            echo $item['image_name'] ?>" alt=""></a>
                        <div class="card-body text-center">
                            <a href="catalog/?category=<?php echo $item['id'] ?>" class="grey-text">
                                <h5><?php
                                    echo $item['name'] ?></h5>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        } ?>
    </div>
</div>