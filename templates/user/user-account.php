    <?php

    use App\Database\Database;
    use App\Database\Entities\Shop;
    use App\SecurityManager;

    $shop = Database::getRepository(Shop::class)->findOne(['user_id' => SecurityManager::getUser()->getId()]);
    ?>
    <div class="row-md-5 ">
        <div class="container">
            <?php
            foreach ($template['texts'] as $text => $value) : ?>

                <div class="card "> <a <?php echo ("href =" . $value); ?>>
                        <div class="row">
                            <div class="col">
                                <h3><?php echo ($text); ?></h3>
                            </div>
                            <div class="col">

                                <span class="fas fa-chevron-right span-arrow "></span>

                            </div>
                    </a>
                        </div>

                </div>

            <?php endforeach; ?>
            <div class="card ">
                <a <?php if (is_null($shop)) {
                        echo ("href='/shop/create/new");
                    } else {
                        echo ("href='/shop/info'");
                    }
                    ?>>
                    <div class="row">
                        <div class="col">
                            <h3><?php if (is_null($shop)) {
                                    echo "Crea il tuo negozio";
                                } else {
                                    echo "Visualizza negozio";
                                }
                                ?>
                            </h3>
                        </div>
                        <div class="col">

                            <span class="fas fa-chevron-right span-arrow "></span>

                        </div>

                    </div>
                </a>
            </div>
            <div class="card ">
                <a href="#">
                    <div class="row">

                        <div class="col">
                            <h3>Esci</h3>
                        </div>
                        <div class="col">
                            <span class="fas fa-sign-out-alt"></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>