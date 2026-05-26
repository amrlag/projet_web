<?php require_once __DIR__ . '/partials/header.php'; ?>

<h1>Connexion</h1>

<form method="POST" action="?page=login_authenticate">
    <div>
        <label for="login">Pseudo ou email</label><br>
        <input type="text" id="login" name="login" required>
    </div>

    <br>

    <div>
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password" required>
    </div>

    <br>

    <button type="submit">Se connecter</button>
</form>

<?php require_once __DIR__ . '/partials/footer.php'; ?>