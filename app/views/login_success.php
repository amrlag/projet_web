<?php require_once __DIR__ . '/partials/header.php'; ?>

<?php
/** @var string $username */
?>

<h1>Connexion réussie</h1>

<p>
    Bienvenue 
    <strong><?= htmlspecialchars($username) ?></strong>.
</p>

<p>
    <a href="?page=home">Retour à l’accueil</a>
</p>

<?php require_once __DIR__ . '/partials/footer.php'; ?>