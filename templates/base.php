<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?php $template['title']; ?></title>
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
        <a class="navbar-brand" href="#"> <img src="img/logo.png" alt="logo del sito"> </a>

        <div class="navbar-collapse offcanvas-collapse">
            <div class="offcanvas-header">
                <button type="button" class="btn-close text-reset" aria-label="chiudi"
                        id="offcanvasCloseButton"></button>
            </div>

            <div class="offcanvas-collapse-body">
                <!--Corpo del menù-->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                        <a class="nav-link" href="#">Il mio account</a>
                    </li>
                    <li class="nav-item d-lg-none ms-2">
                        <a class="nav-link" href="#">Carrello</a>
                    </li>
                    <!-- search su display grandi -->
                    <li class="nav-item d-none d-lg-inline-block">
                        <form class="d-flex p-1">
                            <div class="input-group">
                                <select class="form-select" aria-label="categoria">
                                    <option selected disabled>Categorie</option>
                                    <option value="1">Categoria 1</option>
                                    <option value="2">Categoria 2</option>
                                    <option value="3">Categoria 3</option>
                                </select>

                                <input class="form-control me-2" type="search" placeholder="Cerca"
                                       aria-label="query ricerca">
                            </div>
                            <button class="btn btn-outline-success" type="submit">Cerca</button>
                        </form>
                    </li>
                </ul>
                <!--Logout utente bottom smartphone-->
                <div class="sidebar-account d-lg-none">
                    <hr/>
                    <span class="nav-link">Nome Cognome</span>
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
            <option selected disabled>Categorie</option>
            <option value="1">Categoria 1</option>
            <option value="2">Categoria 2</option>
            <option value="3">Categoria 3</option>
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
    <?php require_once(PROJECT_ROOT . '/templates/' . $template['template']); ?>
</main>
<footer class="row text-center fixed-bottom pt-2">
    <div>
        <p>&copy; 2021 Guariglia - Bambini - Oshodi </p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/f2efc17350.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="main.js"></script>
</body>

</html>