<?php

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

} else {
    echo "Page introuvable";
}