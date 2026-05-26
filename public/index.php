<?php

// J'inclus les contrôleurs dont j'ai besoin.
// Chaque contrôleur contient les méthodes liées à une partie du site.

require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';


// Je récupère la page demandée dans l'URL.
//
// Exemple :
// index.php?page=about
//
// Dans ce cas, $page va contenir "about".
//
// Si aucune page n'est précisée,
// alors j'affiche automatiquement la page d'accueil.
$page = $_GET['page'] ?? 'home';


// Si la page demandée est "home"
if ($page === 'home') {

    // Je crée une instance du HomeController
    $controller = new HomeController();

    // J'appelle la méthode index()
    // qui affiche la page d'accueil.
    $controller->index();


// Si la page demandée est "about"
} elseif ($page === 'about') {

    // Je crée le HomeController
    $controller = new HomeController();

    // J'appelle la méthode about()
    // qui affiche la page "à propos".
    $controller->about();


// Si la page demandée est "users"
} elseif ($page === 'users') {

    // Je crée le HomeController
    $controller = new HomeController();

    // J'appelle la méthode users()
    // qui affiche la liste des utilisateurs.
    $controller->users();


// Si la page demandée est "register"
} elseif ($page === 'register') {

    // Je crée le AuthController
    $controller = new AuthController();

    // J'appelle la méthode register()
    // qui affiche le formulaire d'inscription.
    $controller->register();


// Si la page demandée est "register_store"
} elseif ($page === 'register_store') {

    // Je crée le AuthController
    $controller = new AuthController();

    // J'appelle la méthode store()
    // qui traite les données envoyées par le formulaire.
    $controller->store();


// Si aucune page ne correspond
} else {

    // J'affiche un message d'erreur simple.
    echo "Page introuvable";
}