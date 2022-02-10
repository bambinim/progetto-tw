<div class="row mt-3">
    <div class="col-lg-3"></div>
    <div class="col-12 col-lg-6">
        <?php if (!is_null($template['order'])): ?>
            <?php
                $order = $template['order'];
                $user = $order->getUser();
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
                    <form method="POST" action="/shop/sales/change-status">
                        <input name="order" class="d-none" value="<?= $order->getId(); ?>" />
                        <label for="select-status" class="form-label">Stato ordine</label>
                        <select id="select-status" class="form-select" name="status" required>
                            <option value="0" <?= $order->getStatus() == 0 ? 'selected' : '' ?>>Ordine accettato</option>
                            <option value="1" <?= $order->getStatus() == 1 ? 'selected' : '' ?>>In preparazione</option>
                            <option value="2" <?= $order->getStatus() == 2 ? 'selected' : '' ?>>Spedito</option>
                            <option value="3" <?= $order->getStatus() == 3 ? 'selected' : '' ?>>Consegnato</option>
                        </select>
                        <button class="btn btn-primary mt-3" type="submit">Salva</button>
                    </form>
                </div>
                <div class="col-12 card mt-2 pt-2 pb-3 d-block">
                    <h1 class="fs-2">Informazioni acquirente</h1>
                    <div class="avatar-circle">
                        <span><?= $user->getFirstName()[0] . $user->getLastName()[0]; ?></span>
                    </div>
                    <span class="sidebar-account-text ms-2"><?= $user->getFirstName() . " " . $user->getLastName(); ?></span>
                </div>
            </div>
        <?php else: ?>
            <h1>L'ordine richiesto non è stato trovato</h1>
        <?php endif; ?>
    </div>
    <div class="col-lg-3"></div>
</div>