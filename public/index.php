<?php

session_start();

require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

$page = $_GET['page'] ?? 'home';

if ($page === 'home') {
    $controller = new HomeController();
    $controller->index();

} elseif ($page === 'about') {
    $controller = new HomeController();
    $controller->about();

} elseif ($page === 'users') {
    $controller = new HomeController();
    $controller->users();

} elseif ($page === 'register') {
    $controller = new AuthController();
    $controller->register();

} elseif ($page === 'register_store') {
    $controller = new AuthController();
    $controller->store();

} elseif ($page === 'login') {
    $controller = new AuthController();
    $controller->login();

} elseif ($page === 'login_authenticate') {
    $controller = new AuthController();
    $controller->authenticate();

} elseif ($page === 'logout') {
    $controller = new AuthController();
    $controller->logout();
} elseif ($page === 'member_area') {
    $controller = new HomeController();
    $controller->memberArea();
   } else {
    echo "Page introuvable";
}