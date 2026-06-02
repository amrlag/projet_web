<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/ProfileController.php';
require_once __DIR__ . '/../app/controllers/BlogController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/ChatController.php';

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

} elseif ($page === 'profile') {
    $controller = new ProfileController();
    $controller->edit();

} elseif ($page === 'profile_update') {
    $controller = new ProfileController();
    $controller->update();

} elseif ($page === 'blog') {
    $controller = new BlogController();
    $controller->index();

} elseif ($page === 'blog_show') {
    $controller = new BlogController();
    $controller->show();

} elseif ($page === 'blog_create') {
    $controller = new BlogController();
    $controller->create();

} elseif ($page === 'blog_store') {
    $controller = new BlogController();
    $controller->store();

} elseif ($page === 'comment_store') {
    $controller = new BlogController();
    $controller->addComment();

} elseif ($page === 'admin') {
    $controller = new AdminController();
    $controller->index();

} elseif ($page === 'admin_users') {
    $controller = new AdminController();
    $controller->users();

} elseif ($page === 'admin_user_show') {
    $controller = new AdminController();
    $controller->showUser();

} elseif ($page === 'admin_toggle_block') {
    $controller = new AdminController();
    $controller->toggleBlock();

} elseif ($page === 'admin_user_orders') {
    $controller = new AdminController();
    $controller->showUserOrders();

} elseif ($page === 'admin_order_details') {
    $controller = new AdminController();
    $controller->showOrderDetails();

} elseif ($page === 'admin_products') {
    $controller = new AdminController();
    $controller->products();

} elseif ($page === 'admin_delete_product') {
    $controller = new AdminController();
    $controller->deleteProduct();

} elseif ($page === 'admin_product_create') {
    $controller = new AdminController();
    $controller->createProduct();

} elseif ($page === 'admin_product_store') {
    $controller = new AdminController();
    $controller->storeProduct();

} elseif ($page === 'chat') {
    $controller = new ChatController();
    $controller->index();

} elseif ($page === 'chat_store') {
    $controller = new ChatController();
    $controller->store();

} else {
    echo "Page introuvable";
}
