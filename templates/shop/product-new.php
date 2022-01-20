<div class="row mt-3">
    <div class="col-lg-2"></div>
    <div class="col-12 col-lg-8 card text-center">
        <h1 class="mt-3">Aggiungi Prodotto</h1>
        <form method="POST" action="/shop/products/new" class="row text-start my-5 mx-3">
            <div class="mb-3 col-12 col-lg-6">
                <label for="input-name" class="form-label">Nome</label>
                <input type="email" class="form-control" id="input-name" name="email" required>
            </div>
            <div class="mb-3 col-12 col-lg-6">
                <label for="select-category" class="form-label">Categoria</label>
                <select id="select-category" class="form-select" name="category" aria-label="categoria" required>
                    <option selected disabled>Seleziona Categoria</option>
                    <?php foreach ($categories as $i): ?>
                        <option value="<?= $i->getId(); ?>"><?= $i->getName(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 col-12 col-lg-6">
                <label for="input-price" class="form-label">Prezzo</label>
                <input type="number" min="0" step="0.01" class="form-control" id="input-price" name="price" required>
            </div>
            <div class="mb-3 col-12 col-lg-6">
                <label for="select-condition" class="form-label">Condizione</label>
                <select class="form-select" name="condition" id="select-condition" required>
                    <option value="0">Nuovo</option>
                    <option value="1">Usato in ottime condizioni</option>
                    <option value="2">Usato</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Pubblica</button>
        </form>
    </div>
    <div class="col-lg-2"></div>
</div>