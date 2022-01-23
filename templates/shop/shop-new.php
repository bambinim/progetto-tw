<div class="row">
<?php require_once(PROJECT_ROOT . '/templates/shop/shop-nav-tab.php'); ?>
    <div class="col-lg-3"></div>
    <div class="col-12 col-lg-6">
        <h1 class="ms-3 my-3">Apri Shop</h1>
        <div class="card px-4 pt-5 pb-3">
            <form class="mb-3" method="POST" action="/shop/creation">
                <div class="mb-3">
                    <label for="input-name" class="form-label">Nome Negozio</label>
                    <input id="input-name" name="name" type="text" class="form-control"
                           placeholder="Nome Negozio"
                           required <?php if (isset($template['name'])) echo "value=\"${template['name']}\"" ?> />
                </div>
                <div class="mb-3">
                    <label for="input-address" class="form-label">Via</label>
                    <input id="input-address" name="address" type="text" class="form-control"
                           placeholder="Via"
                           required <?php if (isset($template['address'])) echo "value=\"${template['address']}\"" ?> />
                </div>
                <div class="mb-3">
                    <label for="input-addNumber" class="form-label">Civico</label>
                    <input id="input-addNumber" name="addressNumber" type="number" class="form-control"
                           placeholder="Civico"
                           required <?php if (isset($template['addressNumber'])) echo "value=\"${template['addressNumber']}\"" ?> />
                </div>
                <div class="mb-3">
                    <label for="input-zip" class="form-label">CAP</label>
                    <input id="input-zip" name="zip" type="number" class="form-control"
                           placeholder="cap"
                           required <?php if (isset($template['zip'])) echo "value=\"${template['zip']}\"" ?> />
                </div>
                <div class="mb-3">
                    <label for="input-city" class="form-label">Città</label>
                    <input id="input-city" name="city" type="text" class="form-control"
                           placeholder="Città"
                           required <?php if (isset($template['city'])) echo "value=\"${template['city']}\"" ?> />
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Crea il tuo Shop</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-3"></div>
</div>