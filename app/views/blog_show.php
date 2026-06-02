<?php 
// On inclut le header commun
require_once __DIR__ . '/partials/header.php'; 
?>

<!-- Si aucun billet n'est trouvé -->
<?php if (!$post): ?>

    <p>Article introuvable.</p>

<?php else: ?>

    <!-- Affichage sécurisé du titre du billet -->
    <h1><?= htmlspecialchars($post['title']) ?></h1>

    <!-- Affichage de l'auteur et de la date -->
    <p>
        Publié par <?= htmlspecialchars($post['username']) ?>
        le <?= htmlspecialchars($post['created_at']) ?>
    </p>

    <!-- Affichage sécurisé du contenu complet -->
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

    <hr>

    <h2>Commentaires</h2>

    <!-- Si le billet n'a pas encore de commentaire -->
    <?php if (empty($comments)): ?>

        <p>Aucun commentaire pour le moment.</p>

    <?php else: ?>

        <!-- On parcourt tous les commentaires du billet -->
        <?php foreach ($comments as $comment): ?>

            <div>

                <!-- Affichage sécurisé du pseudo de l'auteur du commentaire -->
                <strong><?= htmlspecialchars($comment['username']) ?></strong>

                <!-- Affichage sécurisé du contenu du commentaire -->
                <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>

                <!-- Affichage de la date du commentaire -->
                <small><?= htmlspecialchars($comment['created_at']) ?></small>

            </div>

            <hr>

        <?php endforeach; ?>

    <?php endif; ?>

    <h2>Ajouter un commentaire</h2>

    <!-- Seuls les utilisateurs connectés peuvent commenter -->
    <?php if (isset($_SESSION['user'])): ?>

        <!-- Formulaire d'ajout de commentaire -->
        <form method="POST" action="?page=comment_store">

            <!-- Champ caché contenant l'id du billet -->
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">

            <!-- Zone de saisie du commentaire -->
            <textarea name="content" required></textarea><br><br>

            <!-- Bouton d'envoi -->
            <button type="submit">Publier le commentaire</button>

        </form>

    <?php else: ?>

        <!-- Message affiché aux visiteurs non connectés -->
        <p>
            Vous devez vous inscrire ou vous connecter pour ajouter un commentaire.
        </p>

        <!-- Lien vers la page d'inscription -->
        <a href="?page=register">S'inscrire</a>

    <?php endif; ?>

<?php endif; ?>

<?php 
// On inclut le footer commun
require_once __DIR__ . '/partials/footer.php'; 
?>