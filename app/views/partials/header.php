<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Projet Web') ?></title>
</head>
<body>

<nav>
    <a href="?page=home">Accueil</a> |
    <a href="?page=about">À propos</a> |
    <a href="?page=users">Utilisateurs</a> |
    <a href="?page=member_area">Espace membre</a> |

    <?php if (isset($_SESSION['user'])): ?>
        Bonjour <?= htmlspecialchars($_SESSION['user']['username']) ?> |
        <a href="?page=logout">Déconnexion</a>
    <?php else: ?>
        <a href="?page=register">Inscription</a> |
        <a href="?page=login">Connexion</a>
    <?php endif; ?>
</nav>

<hr>