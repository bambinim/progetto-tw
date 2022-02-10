<?php

use App\Database\Database;
use App\Database\Entities\Category;
use App\SecurityManager;
use App\Database\Entities\Cart;

$categories = Database::getRepository(Category::class)->findAll();
$user = SecurityManager::getUser();
?>
<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="/assets/css/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"/>
    <?php if (isset($template['css'])) : ?>
        <?php foreach ($template['css'] as $i) : ?>
            <link rel="stylesheet" href="<?= $i; ?>"/>
        <?php endforeach; ?>
    <?php endif; ?>
    <title><?= $template['title']; ?></title>
</head>

<body>
<!--rimossa la classe fixed-top-->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <!--Toggle button-->
        <button class="navbar-toggler p-0 border-0" id="navbarSideCollapse" type="button">
            <span class="fas fa-bars fa-2x"></span>
        </button>
        <!--Brand-->
        <a class="navbar-brand" href="#"> <img src="/img/logo.png" alt="logo del sito"> </a>

        <div class="navbar-collapse offcanvas-collapse">
            <div class="offcanvas-header">
                <button type="button" class="btn-close text-reset" aria-label="chiudi"
                        id="offcanvasCloseButton"></button>
            </div>

            <div class="offcanvas-collapse-body">
                <!--Corpo del menù-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/home">Home</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link" href="#">Novit&agrave;</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/categories/all">Categorie</a>
                    </li>
                    <!--Link da mostrare solo su smartphone-->
                    <li class="nav-item d-lg-none ms-2">
                        <hr/>
                        <a class="nav-link" href="#">I miei ordini</a>
                    </li>
                    <li class="nav-item d-lg-none ms-2">
                        <a class="nav-link" href="/cart/view">Carrello</a>
                    </li>
                    <?php if (!is_null($user) && in_array('ROLE_SELLER', json_decode($user->getRoles()))): ?>
                        <li class="nav-item d-lg-none ms-2">
                            <a class="nav-link" href="#">Il mio negozio</a>
                        </li>
                    <?php endif; ?>
                    <!-- search su display grandi -->
                    <li class="nav-item d-none d-lg-inline-block">
                        <form class="d-flex p-1 search-form" action="/search">
                            <div class="input-group">
                                <select class="form-select" aria-label="categoria" name="category">
                                    <option selected disabled>Categoria</option>
                                    <?php foreach ($categories as $i): ?>
                                        <option value="<?= $i->getId(); ?>"><?= $i->getName(); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <input class="form-control me-2" type="search" name="query" placeholder="Cerca"
                                       aria-label="query ricerca" required />
                            </div>
                            <button class="btn btn-primary" type="submit">Cerca</button>
                        </form>
                    </li>
                </ul>
                <!--User space in sidebar-->
                <div class="mt-auto mb-3 d-lg-none px-3">
                    <?php if (!is_null($user)): ?>
                        <button class="sidebar-account-button mb-3 p-0" aria-label="impostazioni utente">
                            <div class="avatar-circle">
                                <span><?= $user->getFirstName()[0] . $user->getLastName()[0]; ?></span>
                            </div>
                            <span class="sidebar-account-text ms-2"><?= $user->getFirstName() . " " . $user->getLastName(); ?></span>
                            <span class="fas fa-chevron-up sidebar-account-collapse-icon ms-2"></span>
                        </button>
                        <ul class=" sidebar-account-collapse collapse my-0">
                            <li>
                                <a class="sidebar-account-text-small" href="/logout">
                                    <span class="fas fa-sign-out-alt fa-lg me-2"></span>
                                    <span>Esci</span>
                                </a>
                            </li>
                            <li class="mt-3">
                                <a class="sidebar-account-text-small" href="#">
                                    <span class="fas fa-user fa-lg me-2"></span>
                                    <span>Il mio account</span>
                                </a>
                            </li>
                        </ul>
                    <?php else: ?>
                        <a href="/login" class="sidebar-account-text">
                            <span class="fas fa-sign-in-alt fa-lg me-2"></span>
                            <span>Accedi</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div id="nav-icons" class="d-flex">
            <?php if (!is_null($user)): ?>
                <div class="dropdown" id="notification-dropdown">
                    <button class="btn btn-link link-dark shadow-none" type="button" id="notification-bell"
                            aria-label="notifiche" aria-expanded="false" data-bs-toggle="dropdown">
                        <span class="fas fa-bell fa-2x me-3 position-relative"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="notification-bell">
                        <h1 class="fs-4">Notifiche</h1>
                        <div></div>
                    </div>
                </div>
            <?php endif; ?>
            <?php
            $cartCount = Cart::countProducts();
            ?>
            <a href="/cart/view" class="btn btn-link link-dark shadow-none" aria-label="carrello">
                    <span class="fas fa-shopping-cart fa-2x me-3 position-relative">
                        <?php if ($cartCount > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= $cartCount; ?>
                                <span class="visually-hidden">prodotti nel carrello</span>
                            </span>
                        <?php endif; ?>
                    </span>
            </a>
            <?php if (isset($user)): ?>
                <div class="dropdown mobile-hidden">
                    <button type="button" id="account-button" class="btn btn-link link-dark shadow-none"
                            aria-label="account" aria-expanded="false" data-bs-toggle="dropdown">
                        <span class="fas fa-user-circle fa-2x me-2 mobile-hidden"></span>
                    </button>
                    <!-- Account Dropdown -->
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="account-button">
                        <li><a class="dropdown-item" href="/user/orders"><span
                                        class="fas fa-shopping-basket me-1"></span>Ordini</a></li>
                        <li><a class="dropdown-item" href="#"><span class="fas fa-bell me-1"></span>Notifiche</a></li>
                        <li><a class="dropdown-item" href="#"><span class="fas fa-user me-1"></span>Informazioni
                                personali</a></li>
                        <li>
                            <?php if (in_array('ROLE_SELLER', json_decode($user->getRoles()))): ?>
                                <a class="dropdown-item" href="/shop/info"><span class="fas fa-store me-1"></span>Il mio
                                    negozio</a>
                            <?php else: ?>
                                <a class="dropdown-item" href="/shop/create/new"><span class="fas fa-store me-1"></span>Apri
                                    un negozio</a>
                            <?php endif; ?>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/logout"><span
                                        class="fas fa-sign-out-alt me-1"></span>Esci</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="/login" class="nav-link mobile-hidden">Accedi</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<!--Search bar solo su mobile-->
<div class="bg-menu-color d-lg-none">
    <form class="d-flex justify-content-center p-2 search-form" action="/search">
        <div class="input-group">
            <select class="form-select" aria-label="categoria" name="category">
                <option selected disabled>Categoria</option>
                <?php foreach ($categories as $i): ?>
                    <option value="<?= $i->getId(); ?>"><?= $i->getName(); ?></option>
                <?php endforeach; ?>
            </select>
            <input class="form-control" type="search" placeholder="Cerca" aria-label="query ricerca" name="query"
                   required>
        </div>
    </form>
</div>
<div id="alert-container">
    <?php if (isset($template['error'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $template['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($template['message'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $template['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>
<main class="container-fluid">
    <?php require_once(PROJECT_ROOT . '/templates/' . $template['template']); ?>
</main>
<footer class="text-center pt-3 pb-2">
    <div>
        <p>&copy; 2021 Guariglia - Bambini - Oshodi </p>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/f2efc17350.js" crossorigin="anonymous"></script>
<script src="/assets/js/main2.js"></script>
<?php if (isset($user)): ?>
    <script src="/assets/js/notifications.js"></script>
<?php endif; ?>
<?php if (isset($template['js'])) : ?>
    <?php foreach ($template['js'] as $i) : ?>
        <script src="<?= $i; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>

</html>