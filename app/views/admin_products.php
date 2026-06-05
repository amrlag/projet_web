<?php

// Header commun
require_once __DIR__ . '/partials/header.php';

?>

<h1>Gestion des articles</h1>

<p>
    <a href="?page=admin_product_create">
        Ajouter un nouvel article
    </a>
</p>

<!-- Liste des produits disponibles dans l'espace vente -->
<?php if (empty($products)): ?>

    <p>Aucun article trouvé.</p>

<?php else: ?>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Categorie</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Actif</th>
            <th>Action</th>
        </tr>

        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>

                <td><?= htmlspecialchars($product['category_name']) ?></td>

                <td><?= htmlspecialchars($product['name']) ?></td>

                <td><?= htmlspecialchars($product['description']) ?></td>

                <td><?= htmlspecialchars($product['unit_price']) ?> €</td>

                <td><?= $product['is_active'] ? 'Oui' : 'Non' ?></td>

                <td>
                    <a href="?page=admin_product_edit&id=<?= $product['id'] ?>">
                        Modifier
                    </a>
                    |
                    <a href="?page=admin_delete_product&id=<?= $product['id'] ?>"
                       onclick="return confirm('Desactiver cet article ?');">
                        Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>

<p>
    <a href="?page=admin">Retour administration</a>
</p>

<?php

// Footer commun
require_once __DIR__ . '/partials/footer.php';

?>
