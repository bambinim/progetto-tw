<div class="row mt-3">
    <div class="col-lg-2"></div>
    <div class="col-12 col-lg-8 card text-center">
        <h1 class="mt-3">Modifica Prodotto</h1>
        <form method="POST" action="/shop/products/edit" class="row text-start my-5 mx-3">
            <input class="d-none" name="id" value="<?= $template['id']; ?>" />
            <div class="mb-3 col-12 col-lg-6">
                <label for="input-name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="input-name" name="name" required
                       value="<?= $template['name']; ?>">
            </div>
            <div class="mb-3 col-12 col-lg-6">
                <label for="select-category" class="form-label">Categoria</label>
                <select id="select-category" class="form-select" name="category" aria-label="categoria" required>
                    <option selected disabled>Seleziona Categoria</option>
                    <?php foreach ($categories as $i): ?>
                        <option value="<?= $i->getId(); ?>"
                                <?php if (isset($template['category']) && $template['category'] == $i->getId()) : ?>selected<?php endif; ?>>
                            <?= $i->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 col-12 col-lg-6">
                <label for="input-price" class="form-label">Prezzo</label>
                <input type="number" min="0" step="0.01" class="form-control" id="input-price" name="price" required
                       <?php if (isset($template['price'])) : ?>value="<?= $template['price']; ?>"<?php endif; ?>>
            </div>
            <div class="mb-3 col-12 col-lg-6">
                <label for="select-condition" class="form-label">Condizione</label>
                <select class="form-select" name="condition" id="select-condition" required>
                    <option value="0" <?php if ($template['condition'] == 0): ?>selected<?php endif; ?>>Nuovo</option>
                    <option value="1" <?php if ($template['condition'] == 1): ?>selected<?php endif; ?>>Usato in ottime condizioni</option>
                    <option value="2" <?php if ($template['condition'] == 2): ?>selected<?php endif; ?>>Usato</option>
                </select>
            </div>
            <div class="col-12 mb-3">
                <label for="input-description" class="form-label">Descrizione</label>
                <textarea class="form-control" id="input-description" name="description"><?php if (isset($template['description'])) : ?><?= $template['description']; ?><?php endif; ?></textarea>
            </div>
            <div class="col-12 mb-3" id="images-uploader">
                <input id="input-upload" type="file" class="d-none" accept=".jpg,.jpeg,.png" />
                <label for="input-upload" class="btn btn-primary"><span class="fas fa-upload me-2"></span>Aggiungi Immagine</label>
                <ul class="mt-3">
                    <?php if (isset($template['images'])): ?>
                        <?php foreach ($template['images'] as $i):  ?>
                            <li id="uploaded-image-<?= $i; ?>" class="position-relative m-2">
                                <input name="images[]" value="<?= $i; ?>" class="d-none">
                                <img alt="" src="/images/get?id=<?= $i; ?>" class="image-preview">
                                <button type="button" class="btn btn-link shadow-none position-absolute top-0 start-100 translate-middle"
                                        aria-label="elimina immagine" onclick="removeUploadedImage(<?= $i; ?>)">
                                    <span class="fas fa-times"></span>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <button type="submit" class="btn btn-primary">Salva</button>
        </form>
    </div>
    <div class="col-lg-2"></div>
</div>