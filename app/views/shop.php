<?php require_once __DIR__ . '/partials/header.php'; ?>

<h1>Boutique</h1>

<?php if (empty($products)): ?>
    <p>Aucun produit disponible pour le moment.</p>
<?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>Categorie</th>
            <th>Produit</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Action</th>
        </tr>

        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product->category_name) ?></td>
                <td><?= htmlspecialchars($product->name) ?></td>
                <td><?= htmlspecialchars($product->description ?? '') ?></td>
                <td><?= number_format($product->unit_price, 2) ?> EUR</td>
                <td>
                    <a href="?page=cart_add&id=<?= htmlspecialchars($product->id) ?>">
                        Ajouter au panier
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<p><a href="?page=cart">Voir mon panier</a></p>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
