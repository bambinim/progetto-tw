<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-12 col-lg-10">
        <div class="row">
            <!-- Main Container for Content -->
            <div class="col-12 col-lg-6">
                <?php
                    $product = $template['product'];
                    $images = $product->getImages();
                    $shop = $product->getShop();
                ?>
                <div id="carouselExampleIndicators" data-bs-interval="false" class="carousel carousel-dark slide mt-3" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php for ($i = 0; $i < count($images); $i++): ?>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i; ?>" aria-label="Immagine <?= $i + 1; ?>"
                                    <?php if ($i == 0): ?>class="active" aria-current="true"><?php endif; ?></button>
                        <?php endfor; ?>
                    </div>
                    <div class="carousel-inner">
                        <?php for ($i = 0; $i < count($images); $i++): ?>
                            <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
                                <img src="/images/get?id=<?= $images[$i]->getId() ?>" class="d-block w-100" alt="...">
                            </div>
                        <?php endfor; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-3">
                <div class="row">
                    <div class="col"><h1><?= $product->getName(); ?></h1></div>
                    <div class="col text-end mt-1"><span class="fs-3">&euro;<?= number_format($product->getPrice(), 2); ?></span></div>
                </div>
                <p><?= $product->getDescription(); ?></p>
                <?php if ($product->getIsSold() == 0): ?>
                    <a class="btn btn-primary" href="/cart/products/add?productId=<?= $product->getId(); ?>">Aggiungi al carrello</a>
                <?php else: ?>
                    <span class="text-danger fs-5">Questo prodotto non è più disponibile</span>
                <?php endif; ?>
            </div>
            <div class="col-12 mt-3">
                <h2>Informazioni sul venditore</h2>
                <a href="#" class="shop-circle-link">
                    <div class="avatar-circle">
                        <span><?= $shop->getName()[0]; ?></span>
                    </div>
                    <span class="sidebar-account-text ms-2"><?= $shop->getName(); ?></span>
                </a>
            </div>
            <div class="col-12 mt-3">
                <h2>Prodotti correlati</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-1"></div>
</div>