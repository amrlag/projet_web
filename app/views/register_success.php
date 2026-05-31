<?php
/**
 * Cette ligne sert à indiquer que la variable $username existe
 * et qu'elle contient une chaîne de caractères.
 *
 * Ce commentaire est surtout utile pour l'éditeur de code
 * et pour comprendre quelles variables sont disponibles dans cette vue.
 *
 * @var string $username
 */
?>

<?php
// On inclut le fichier header.php.
// Ce fichier contient généralement le début de la page HTML :
// doctype, balise <html>, <head>, menu, etc.
require_once __DIR__ . '/partials/header.php';
?>

<h1>Inscription réussie</h1>

<p>
    Le compte de 

    <!-- 
        On affiche le nom d'utilisateur qui vient d'être créé.
        
        htmlspecialchars() permet de sécuriser l'affichage.
        Elle empêche qu'un utilisateur puisse injecter du code HTML ou JavaScript
        dans la page.
        
        Exemple :
        Si quelqu'un entre <script>alert('hack')</script>,
        le code sera affiché comme du texte et ne sera pas exécuté.
    -->
    <strong><?= htmlspecialchars($username) ?></strong>

    a bien été créé.
</p>

<p>
    <!-- 
        Ce lien permet de rediriger l'utilisateur vers la page
        qui affiche la liste des utilisateurs.
        
        Le paramètre ?page=users sera lu par le routeur de l'application
        pour savoir quelle page afficher.
    -->
    <a href="?page=users">Voir la liste des utilisateurs</a>
</p>

<?php
// On inclut le fichier footer.php.
// Ce fichier contient généralement la fin de la page HTML :
// fermeture des balises, pied de page, scripts, etc.
require_once __DIR__ . '/partials/footer.php';
?>