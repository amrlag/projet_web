<?php require_once __DIR__ . '/partials/header.php'; ?>

<h1>Accueil</h1>

<h2>Présentation du site</h2>

<p>
    Bienvenue sur notre application web dynamique développée en PHP et MySQL.
    Ce site propose plusieurs services selon que l'utilisateur soit visiteur,
    membre connecté ou administrateur.
</p>

<h2>Services accessibles aux visiteurs non connectés</h2>

<ul>
    <li>Consulter la page d'accueil.</li>
    <li>Consulter certaines informations publiques du site.</li>
    <li>S'inscrire comme membre.</li>
    <li>Se connecter avec un compte existant.</li>
</ul>

<h2>Services accessibles aux membres connectés</h2>

<ul>
    <li>Accéder à l'espace membre.</li>
    <li>Modifier son adresse postale.</li>
    <li>Modifier son adresse email.</li>
    <li>Modifier son mot de passe.</li>
</ul>

<?php if (isset($_SESSION['user'])): ?>

    <h2>Session active</h2>

    <p>
        Vous êtes connecté en tant que :
        <strong><?= htmlspecialchars($_SESSION['user']['username'] ?? '') ?></strong>
    </p>

    <p>
        <a href="?page=profile">Modifier mon profil</a>
    </p>

<?php else: ?>

    <h2>Connexion rapide</h2>

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

    <p>
        Pas encore membre ?
        <a href="?page=register">Créer un compte</a>
    </p>

<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>