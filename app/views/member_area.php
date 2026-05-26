<?php require_once __DIR__ . '/partials/header.php'; ?>

<h1>Espace membre</h1>

<p>Bienvenue dans la partie réservée aux utilisateurs connectés.</p>

<?php if (isset($_SESSION['user'])): ?>
    <p>
        Connecté en tant que :
        <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong>
    </p>
<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>