<?php

// Header commun
require_once __DIR__ . '/partials/header.php';

?>

<h1>Profil utilisateur</h1>

<!-- Informations détaillées de l'utilisateur -->

<p>
    <strong>ID :</strong>
    <?= $user['id'] ?>
</p>

<p>
    <strong>Prénom :</strong>
    <?= htmlspecialchars($user['first_name']) ?>
</p>

<p>
    <strong>Nom :</strong>
    <?= htmlspecialchars($user['last_name']) ?>
</p>

<p>
    <strong>Pseudo :</strong>
    <?= htmlspecialchars($user['username']) ?>
</p>

<p>
    <strong>Email :</strong>
    <?= htmlspecialchars($user['email']) ?>
</p>

<p>
    <strong>Rôle :</strong>
    <?= htmlspecialchars($user['role']) ?>
</p>

<p>
    <strong>Bloqué :</strong>
    <?= $user['is_blocked'] ? 'Oui' : 'Non' ?>
</p>

<p>
    <a href="?page=admin_user_orders&id=<?= $user['id'] ?>">
        Voir les achats de cet utilisateur
    </a>
</p>

<!-- Nombre de connexions aujourd'hui -->
<p>
    <strong>Connexions aujourd'hui :</strong>
    <?= $todayConnections['total'] ?>
</p>

<!-- Nombre de connexions sur les 7 derniers jours -->
<p>
    <strong>Connexions sur 7 jours :</strong>
    <?= $weekConnections['total'] ?>
</p>
<h2>5 derniers commentaires Blog/News</h2>

<!-- Affichage des derniers commentaires publiés par l'utilisateur -->
<?php if (empty($lastComments)): ?>

    <p>Aucun commentaire trouvé.</p>

<?php else: ?>

    <ul>
        <?php foreach ($lastComments as $comment): ?>

            <li>
                <strong>Article :</strong>
                <?= htmlspecialchars($comment['post_title']) ?><br>

                <strong>Commentaire :</strong>
                <?= htmlspecialchars($comment['content']) ?><br>

                <strong>Date :</strong>
                <?= htmlspecialchars($comment['created_at']) ?>
            </li>

        <?php endforeach; ?>
    </ul>

<?php endif; ?>
<!-- Retour vers la liste des utilisateurs -->
<p>
    <a href="?page=admin_users">
        Retour à la liste
    </a>
</p>

<?php

// Footer commun
require_once __DIR__ . '/partials/footer.php';

?>