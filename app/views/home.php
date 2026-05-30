<?php

// J'inclus le fichier header.php.
// Ce fichier contient le début de la page HTML,
// comme le <head>, le menu ou les éléments communs à toutes les pages.
require_once __DIR__ . '/partials/header.php';

?>

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

<?php

// Ici, je vérifie si une session utilisateur existe.
//
// $_SESSION['user'] contient normalement les informations
// de l'utilisateur connecté.
//
// Si cette variable existe, cela veut dire que l'utilisateur
// est connecté à son compte.
if (isset($_SESSION['user'])):

?>

    <h2>Session active</h2>

    <p>
        Vous êtes connecté en tant que :

        <!--
            J'affiche le pseudo de l'utilisateur connecté.

            htmlspecialchars() permet de sécuriser l'affichage.
            Si un utilisateur a mis du code HTML ou JavaScript dans son pseudo,
            ce code ne sera pas exécuté par le navigateur.

            Le ?? '' signifie :
            si username n'existe pas, on affiche une chaîne vide.
            Cela évite une erreur PHP.
        -->
        <strong><?= htmlspecialchars($_SESSION['user']['username'] ?? '') ?></strong>
    </p>

    <p>
        <!--
            Ce lien permet à l'utilisateur connecté
            d'aller vers la page de modification de son profil.
        -->
        <a href="?page=profile">Modifier mon profil</a>
    </p>

<?php

// Si aucune session utilisateur n'existe,
// cela veut dire que le visiteur n'est pas connecté.
else:

?>

    <h2>Connexion rapide</h2>

    <!--
        Ce formulaire permet à un visiteur de se connecter.

        method="POST" signifie que les données seront envoyées
        de manière plus discrète que dans l'URL.

        action="?page=login_authenticate" indique vers quelle page
        les données du formulaire seront envoyées.

        Le routeur va ensuite détecter la valeur login_authenticate
        et appeler la méthode prévue pour vérifier la connexion.
    -->
    <form method="POST" action="?page=login_authenticate">

        <div>
            <!--
                Champ permettant à l'utilisateur d'entrer
                soit son pseudo, soit son adresse email.
            -->
            <label for="login">Pseudo ou email</label><br>

            <!--
                required oblige l'utilisateur à remplir ce champ
                avant de pouvoir envoyer le formulaire.
            -->
            <input type="text" id="login" name="login" required>
        </div>

        <br>

        <div>
            <!--
                Champ pour entrer le mot de passe.
            -->
            <label for="password">Mot de passe</label><br>

            <!--
                type="password" cache les caractères saisis
                pour ne pas afficher le mot de passe à l'écran.
            -->
            <input type="password" id="password" name="password" required>
        </div>

        <br>

        <!--
            Bouton qui permet d'envoyer le formulaire de connexion.
        -->
        <button type="submit">Se connecter</button>
    </form>

    <p>
        Pas encore membre ?

        <!--
            Ce lien permet au visiteur d'aller vers la page d'inscription.
        -->
        <a href="?page=register">Créer un compte</a>
    </p>

<?php

// Fin de la condition if / else.
// À partir d'ici, le code est à nouveau commun
// aux utilisateurs connectés et non connectés.
endif;

?>

<?php

// J'inclus le fichier footer.php.
// Il contient la fin de la page HTML,
// comme le pied de page ou la fermeture des balises.
require_once __DIR__ . '/partials/footer.php';

?>