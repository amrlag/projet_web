<?php 
// On inclut le header commun à toutes les pages
require_once __DIR__ . '/partials/header.php'; 
?>

<h1>Blog / News</h1>

<!-- Formulaire de recherche accessible à tous les utilisateurs -->
<form method="GET">

    <!-- Champ caché pour rester sur la page blog après la recherche -->
    <input type="hidden" name="page" value="blog">

    <!-- Champ de recherche par titre -->
    <input 
        type="text" 
        name="search" 
        placeholder="Rechercher par titre" 
        value="<?= htmlspecialchars($search) ?>"
    >

    <!-- Bouton pour lancer la recherche -->
    <button type="submit">Rechercher</button>
</form>

<br>

<!-- Seul l'administrateur peut voir le lien de création d'un billet -->
<?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin'): ?>

    <a href="?page=blog_create">Créer un nouveau billet</a>

<?php endif; ?>

<hr>

<!-- Si aucun billet n'existe ou ne correspond à la recherche -->
<?php if (empty($posts)): ?>

    <p>Aucun billet trouvé.</p>

<?php else: ?>

    <!-- On parcourt tous les billets récupérés depuis la base de données -->
    <?php foreach ($posts as $post): ?>

        <article>

            <!-- Affichage sécurisé du titre -->
            <h2><?= htmlspecialchars($post['title']) ?></h2>

            <!-- Affichage sécurisé d'un extrait du contenu -->
            <p><?= nl2br(htmlspecialchars(substr($post['content'], 0, 200))) ?>...</p>

            <!-- Affichage de l'auteur et de la date -->
            <p>
                Publié par <?= htmlspecialchars($post['username']) ?>
                le <?= htmlspecialchars($post['created_at']) ?>
            </p>

            <!-- Lien vers le détail du billet et ses commentaires -->
            <a href="?page=blog_show&id=<?= $post['id'] ?>">Voir les commentaires</a>

        </article>

        <hr>

    <?php endforeach; ?>

<?php endif; ?>

<?php 
// On inclut le footer commun
require_once __DIR__ . '/partials/footer.php'; 
?>
