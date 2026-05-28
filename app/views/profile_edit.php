<?php require_once __DIR__ . '/partials/header.php'; ?>

<?php
/** @var array $user */
?>

<h1>Modifier mon profil</h1>

<p>
    Connecté en tant que :
    <strong><?= htmlspecialchars($user['username'] ?? '') ?></strong>
</p>

<form method="POST" action="?page=profile_update">
    <div>
        <label for="address">Adresse postale</label><br>
        <input
            type="text"
            id="address"
            name="address"
            value="<?= htmlspecialchars($user['address'] ?? '') ?>"
            required
        >
    </div>

    <br>

    <div>
        <label for="postal_code">Code postal</label><br>
        <input
            type="text"
            id="postal_code"
            name="postal_code"
            value="<?= htmlspecialchars($user['postal_code'] ?? '') ?>"
            required
        >
    </div>

    <br>

    <div>
        <label for="email">Adresse email</label><br>
        <input
            type="email"
            id="email"
            name="email"
            value="<?= htmlspecialchars($user['email'] ?? '') ?>"
            required
        >
    </div>

    <br>

    <div>
        <label for="password">Nouveau mot de passe</label><br>
        <input
            type="password"
            id="password"
            name="password"
        >
        <small>Laissez vide si vous ne voulez pas changer le mot de passe.</small>
    </div>

    <br>

    <button type="submit">Enregistrer les modifications</button>
</form>

<?php require_once __DIR__ . '/partials/footer.php'; ?>