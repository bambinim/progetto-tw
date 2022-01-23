<ul class="nav nav-tabs d-flex">
    <li class="nav-item">
        <a class="nav-link <?php if (basename($_SERVER['REQUEST_URI']) == "") {echo "active";} ?>" aria-current="page" href="#">Prodotti</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php if (basename($_SERVER['REQUEST_URI']) == "sales") {echo "active";} ?>" href="/shop/sales">Vendite</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php if (basename($_SERVER['REQUEST_URI']) == "reviews") {echo "active";} ?>" href="/shop/reviews">Recensioni</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php if (basename($_SERVER['REQUEST_URI']) == "") {echo "active";} ?>" href="#">Info</a>
    </li>
</ul>
