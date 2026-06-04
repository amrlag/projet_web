<?php
$currentPage = $_GET['page'] ?? 'home';
$cartCount = array_sum($_SESSION['cart'] ?? []);
$isLoggedIn = isset($_SESSION['user']);
$isAdmin = $isLoggedIn && ($_SESSION['user']['role'] ?? '') === 'admin';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Projet Web') ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="site-header">
    <nav class="navbar" aria-label="Navigation principale">
        <a class="brand" href="?page=home">
            <span class="brand-mark">PW</span>
            <span class="brand-text">Projet Web</span>
        </a>

        <div class="nav-links">
            <a class="<?= $currentPage === 'home' ? 'active' : '' ?>" href="?page=home">Accueil</a>
            <a class="<?= $currentPage === 'about' ? 'active' : '' ?>" href="?page=about">A propos</a>
            <a class="<?= $currentPage === 'blog' ? 'active' : '' ?>" href="?page=blog">Blog</a>
            <a class="<?= $currentPage === 'shop' ? 'active' : '' ?>" href="?page=shop">Boutique</a>

            <?php if ($isLoggedIn): ?>
                <a class="<?= $currentPage === 'member_area' ? 'active' : '' ?>" href="?page=member_area">Espace membre</a>
                <a class="<?= $currentPage === 'chat' ? 'active' : '' ?>" href="?page=chat">Mini-chat</a>
                <a class="<?= $currentPage === 'my_orders' ? 'active' : '' ?>" href="?page=my_orders">Mes commandes</a>

                <?php if ($isAdmin): ?>
                    <a class="<?= str_starts_with($currentPage, 'admin') ? 'active' : '' ?>" href="?page=admin">Administration</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="nav-actions">
            <a class="cart-link <?= $currentPage === 'cart' ? 'active' : '' ?>" href="?page=cart" aria-label="Voir mon panier">
                <span class="cart-icon" aria-hidden="true"></span>
                <span>Panier</span>
                <span class="cart-badge"><?= htmlspecialchars($cartCount) ?></span>
            </a>

            <?php if ($isLoggedIn): ?>
                <div class="user-chip">
                    <span class="user-dot"></span>
                    <span><?= htmlspecialchars($_SESSION['user']['username']) ?></span>
                </div>
                <a class="ghost-link" href="?page=profile">Profil</a>
                <a class="primary-link" href="?page=logout">Deconnexion</a>
            <?php else: ?>
                <a class="ghost-link" href="?page=login">Connexion</a>
                <a class="primary-link" href="?page=register">Inscription</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main class="site-main">
