<?php

use App\Database\Database;
use App\Database\Entities\Category;
use App\SecurityManager;

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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link" href="#">Novit&agrave;</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categorie</a>
                    </li>
                    <!--Link da mostrare solo su smartphone-->
                    <li class="nav-item d-lg-none ms-2">
                        <hr/>
                        <a class="nav-link" href="#">I miei ordini</a>
                    </li>
                    <li class="nav-item d-lg-none ms-2">
                        <a class="nav-link" href="#">Carrello</a>
                    </li>
                    <?php if (!is_null($user) && in_array('ROLE_SELLER', json_decode($user->getRoles()))): ?>
                        <li class="nav-item d-lg-none ms-2">
                            <a class="nav-link" href="#">Il mio negozio</a>
                        </li>
                    <?php endif; ?>
                    <!-- search su display grandi -->
                    <li class="nav-item d-none d-lg-inline-block">
                        <form class="d-flex p-1">
                            <div class="input-group">
                                <select class="form-select" aria-label="categoria">
                                    <option selected disabled>Seleziona Categoria</option>
                                    <?php foreach ($categories as $i): ?>
                                        <option value="<?= $i->getId(); ?>"><?= $i->getName(); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <input class="form-control me-2" type="search" placeholder="Cerca"
                                       aria-label="query ricerca">
                            </div>
                            <button class="btn btn-outline-success" type="submit">Cerca</button>
                        </form>
                    </li>
                </ul>
                <!--User space in sidebar-->
                <div class="mt-auto mb-3 d-lg-none px-3">
                    <?php if (!is_null($user)): ?>
                        <button class="sidebar-account-button mb-3 p-0">
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
            <button type="button" class="btn btn-link link-dark shadow-none" id="notification-bell"
                    aria-label="notifiche">
                    <span class="fas fa-bell fa-2x me-3 position-relative">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            99+
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </span>
            </button>
            <button type="button" class="btn btn-link link-dark shadow-none" aria-label="carrello">
                    <span class="fas fa-shopping-cart fa-2x me-3 position-relative">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            99+
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </span>
            </button>
            <button type="button" id="account-button" class="btn btn-link link-dark shadow-none"
                    aria-label="account" aria-expanded="false">
                <span class="fas fa-user-circle fa-2x me-2 mobile-hidden"></span>
            </button>
        </div>
    </div>
</nav>
<!--Search bar solo su mobile-->
<div class="bg-menu-color d-lg-none">
    <form class="d-flex justify-content-center p-2">
        <select class="form-select" aria-label="categoria">
            <option selected disabled>Seleziona Categoria</option>
            <?php foreach ($categories as $i): ?>
                <option value="<?= $i->getId(); ?>"><?= $i->getName(); ?></option>
            <?php endforeach; ?>
        </select>
        <input class="form-control" type="search" placeholder="Cerca" aria-label="query ricerca">
    </form>
</div>

<!-- Account Dropdown -->
<ul class="dropdown-menu dropdown-menu-end" id="account-dropdown" aria-haspopup=”true” aria-labelledby="account-button">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li>
        <hr class="dropdown-divider">
    </li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
</ul>

<!--Il codice sottostante è puramente a scopo esemplificativo-->
<div class="d-none" id="notification-list">
    <ul class="unstyled">
        <li>
            <h5>Titolo notifica</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam euismod tellus id interdum.
                Suspendisse vel fringilla ligula.</p>
            <hr/>
        </li>
        <li>
            <h5>Titolo notifica</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam euismod tellus id interdum.
                Suspendisse vel fringilla ligula.</p>
        </li>
        <li>
            <h5>Titolo notifica</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam euismod tellus id interdum.
                Suspendisse vel fringilla ligula.</p>
            <hr/>
        </li>
    </ul>
</div>
<main class="container-fluid">
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
    <?php require_once(PROJECT_ROOT . '/templates/' . $template['template']); ?>
</main>
<footer class="text-center pt-3 pb-2">
    <div>
        <p>&copy; 2021 Guariglia - Bambini - Oshodi </p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/f2efc17350.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="/assets/js/main2.js"></script>
<?php if (isset($template['js'])) : ?>
    <?php foreach ($template['js'] as $i) : ?>
        <script src="<?= $i; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>

</html>