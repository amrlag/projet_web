<h1>Boutique</h1>
<?php
$products = $products ?? [];
?>

<table border="1" cellpadding="8">
    <tr>
        <th>Catégorie</th>
        <th>Produit</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Action</th>
    </tr>

    <?php foreach ($products as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product->category_name) ?></td>
            <td><?= htmlspecialchars($product->name) ?></td>
            <td><?= htmlspecialchars($product->description) ?></td>
            <td><?= number_format($product->unit_price, 2) ?> €</td>
            <td>
                <a href="?page=cart_add&id=<?= $product->id ?>">
                    Ajouter au panier
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="?page=cart">Voir mon panier</a>