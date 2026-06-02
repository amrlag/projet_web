<?php

// Header commun
require_once __DIR__ . '/partials/header.php';

?>

<h1>Détail de l'achat</h1>

<!-- Détail des articles contenus dans une commande -->
<?php if (empty($items)): ?>

    <p>Aucun détail trouvé pour cet achat.</p>

<?php else: ?>

    <table border="1" cellpadding="5">
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Total ligne</th>
        </tr>

        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['product_name']) ?></td>

                <td><?= $item['quantity'] ?></td>

                <td><?= htmlspecialchars($item['unit_price']) ?> €</td>

                <td><?= htmlspecialchars($item['line_total']) ?> €</td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>

<p>
    <a href="?page=admin_users">
        Retour à la gestion des utilisateurs
    </a>
</p>

<?php

// Footer commun
require_once __DIR__ . '/partials/footer.php';

?>