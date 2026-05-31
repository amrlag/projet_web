<?php require_once __DIR__ . '/partials/header.php'; ?>

<h1>Accès refusé</h1>

<p><?= htmlspecialchars($message ?? 'Accès refusé') ?></p>

<p>
    <a href="?page=login">Se connecter</a> |
    <a href="?page=register">Créer un compte</a>
</p>

<?php require_once __DIR__ . '/partials/footer.php'; ?>