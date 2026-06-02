<?php

// Header commun
require_once __DIR__ . '/partials/header.php';

?>

<h1>Achats de l'utilisateur</h1>

<p>
    <strong>Utilisateur :</strong>
    <?= htmlspecialchars($user['username']) ?>
</p>

<!-- Liste des achats effectués par l'utilisateur -->
<?php if (empty($orders)): ?>

    <p>Aucun achat trouvé pour cet utilisateur.</p>

<?php else: ?>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID achat</th>
            <th>Date</th>
            <th>Montant total</th>
            <th>Détail</th>
        </tr>

        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['id'] ?></td>

                <td><?= htmlspecialchars($order['created_at']) ?></td>

                <td><?= htmlspecialchars($order['total_amount']) ?> €</td>

                <td>
                    <a href="?page=admin_order_details&id=<?= $order['id'] ?>">
                        Voir détail
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>

<p>
    <a href="?page=admin_user_show&id=<?= $user['id'] ?>">
        Retour au profil
    </a>
</p>

<?php

// Footer commun
require_once __DIR__ . '/partials/footer.php';

?>