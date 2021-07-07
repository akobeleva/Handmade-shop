<div class="catalog">
    <h1>Каталог</h1>
    <div class="row wow fadeIn">
        <?php
        if (isset($data)) {
            foreach ($data as $item): ?>
                <div class="col-lg-4 mb-4">
                    <div class="card pt-3">
                        <a href="/"><img class="card-img-top" src="/img/<?php
                            echo $item['image_name'] ?>" alt=""></a>
                        <div class="card-body text-center">
                            <a href="/" class="grey-text">
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