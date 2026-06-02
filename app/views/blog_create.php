<?php 
// On inclut le header commun
require_once __DIR__ . '/partials/header.php'; 
?>

<h1>Créer un billet</h1>

<!-- Formulaire réservé à l'administrateur -->
<form method="POST" action="?page=blog_store">

    <div>
        <!-- Label du champ titre -->
        <label for="title">Titre</label><br>

        <!-- Champ pour écrire le titre du billet -->
        <input type="text" id="title" name="title" required>
    </div>

    <br>

    <div>
        <!-- Label du champ texte -->
        <label for="content">Texte</label><br>

        <!-- Zone pour écrire le contenu du billet -->
        <textarea id="content" name="content" required></textarea>
    </div>

    <br>

    <!-- Bouton de publication -->
    <button type="submit">Publier</button>
</form>

<?php 
// On inclut le footer commun
require_once __DIR__ . '/partials/footer.php'; 
?>