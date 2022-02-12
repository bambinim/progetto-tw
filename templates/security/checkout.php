<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-12 col-lg-2 card py-4">
        <div class="row">
            <h1 class="col-7 col-lg-12">Totale:</h1>
            <span class="fs-3 col-5 col-lg-12">&euro;<?= number_format($template['total'], 2); ?></span>
        </div>
    </div>
    <div class="col-12 col-lg-6 card p-4">
        <h1>Informazioni di pagamento</h1>
        <form action="/payment/check" method="POST">
            <div class="mb-3">
                <label for="input-number" class="form-label">Numero carta</label>
                <input type="text" maxlength="16" minlength="16" class="form-control" id="input-number" name="number"  required>
            </div>
            <div class="mb-3">
                <label for="input-expiry" class="form-label">Scadenza</label>
                <input type="month" class="form-control" id="input-expiry" name="expiry"  required>
            </div>
            <div class="mb-3">
                <label for="input-cvv" class="form-label">CVV</label>
                <input type="number" class="form-control" id="input-cvv" name="cvv"  required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Paga</button>
            </div>
        </form>
    </div>
    <div class="col-lg-2"></div>
</div>