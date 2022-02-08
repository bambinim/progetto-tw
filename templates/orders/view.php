<div class="row mt-3">
    <div class="col-lg-3"></div>
    <div class="col-12 col-lg-6">
        <?php if (!is_null($template['order'])): ?>
            <?php
                $order = $template['order'];
                $shop = $order->getShop();
            ?>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12 card mt-2 pt-2">
                            <h1 class="fs-2">Informazioni</h1>
                            <table class="table">
                                <tr>
                                    <th class="fw-bold">Numero ordine:</th>
                                    <td><?= $order->getId(); ?></td>
                                </tr>
                                <tr>
                                    <th class="fw-bold">Data ordine:</th>
                                    <td><?= date_format(new DateTime($order->getDate()), 'd/m/Y'); ?></td>
                                </tr>
                                <tr>
                                    <th class="fw-bold">Totale ordine:</th>
                                    <td>&euro;<?= number_format($order->getTotal(), 2); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 card mt-2 pt-2">
                            <h1 class="fs-2">Prodotti ordinati</h1>
                            <ul class="products-list mt-2">
                                <?php foreach ($order->getProducts() as $product): ?>
                                    <li>
                                        <img src="/images/get?id=<?= $product->getImages()[0]->getId(); ?>" />
                                        <span class="fw-bold mx-2"><?= $product->getName(); ?></span>
                                        <span>&euro;<?= number_format($product->getPrice(), 2); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 card mt-2 pt-2 pb-3">
                    <h1 class="fs-2">Stato ordine</h1>
                    <div class="steps-container">
                        <div class="step active">
                            <div class="step-circle"></div>
                            <span>Ordine accettato</span>
                        </div>
                        <div class="step-connector <?= $order->getStatus() > 0 ? ' active' : ''; ?>"></div>
                        <div class="step <?= $order->getStatus() >= 1 ? ' active' : ''; ?>">
                            <div class="step-circle"></div>
                            <span>In preparazione</span>
                        </div>
                        <div class="step-connector <?= $order->getStatus() > 1 ? ' active' : ''; ?>"></div>
                        <div class="step <?= $order->getStatus() >= 2 ? ' active' : ''; ?>">
                            <div class="step-circle"></div>
                            <span>Spedito</span>
                        </div>
                        <div class="step-connector <?= $order->getStatus() > 2 ? ' active' : ''; ?>"></div>
                        <div class="step <?= $order->getStatus() >= 3 ? ' active' : ''; ?>">
                            <div class="step-circle"></div>
                            <span>Consegnato</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 card mt-2 pt-2 pb-3 d-block">
                    <h1 class="fs-2">Informazioni sul venditore</h1>
                    <a href="#" class="shop-circle-link">
                        <div class="avatar-circle">
                            <span><?= $shop->getName()[0]; ?></span>
                        </div>
                        <span class="sidebar-account-text ms-2"><?= $shop->getName(); ?></span>
                    </a>
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#review-modal">
                        Scrivi una recensione
                    </button>
                </div>
            </div>
        <?php else: ?>
            <h1>L'ordine richiesto non è stato trovato</h1>
        <?php endif; ?>
    </div>
    <div class="col-lg-3"></div>
</div>

<div class="modal fade" id="review-modal" tabindex="-1" aria-labelledby="review-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="review-modal-label">Scrivi una recensione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="review-form">
                    <input class="d-none" name="shop" value="<?= $shop->getId(); ?>" />
                    <div class="mb-3">
                        <label for="input-title" class="form-label">Titolo</label>
                        <input type="text" class="form-control" id="input-title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="input-text" class="form-label">Testo</label>
                        <textarea class="form-control" id="input-text" name="text" text></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="input-title" class="form-label">Valutazione</label>
                        <select class="form-select" id="select-rating" name="rating" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="submit" form="review-form" class="btn btn-primary">Invia</button>
            </div>
        </div>
    </div>
</div>