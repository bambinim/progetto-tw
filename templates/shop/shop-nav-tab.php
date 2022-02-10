<ul class="nav nav-tabs d-flex">
    <li class="nav-item">
        <a class="nav-link <?php if (basename($_SERVER['REQUEST_URI']) == "list") {echo "active";} ?>" aria-current="page" href="/shop/products/list">Prodotti</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php if (basename($_SERVER['REQUEST_URI']) == "sales") {echo "active";} ?>" href="/shop/sales">Ordini</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php if (basename($_SERVER['REQUEST_URI']) == "reviews") {echo "active";} ?>" href="/shop/reviews">Recensioni</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php if (basename($_SERVER['REQUEST_URI']) == "info") {echo "active";} ?>" href="/shop/info">Info</a>
    </li>
</ul>
