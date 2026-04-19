<?php

require_once __DIR__ . '/../app/controllers/HomeController.php';

$page = $_GET['page'] ?? 'home';

$controller = new HomeController();

if ($page === 'home') {
    $controller->index();
} elseif ($page === 'about') {
    $controller->about();
} else {
    echo "Page introuvable";
}