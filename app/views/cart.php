<?php require_once __DIR__ . '/partials/header.php'; ?>

<h1>Mon panier</h1>

<?php if (empty($cartItems)): ?>
    <p>Votre panier est vide.</p>
    <p><a href="?page=shop">Retour a la boutique</a></p>
<?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantite</th>
            <th>Total ligne</th>
        </tr>

        <?php foreach ($cartItems as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['product']->name) ?></td>
                <td><?= number_format($item['product']->unit_price, 2) ?> EUR</td>
                <td><?= htmlspecialchars($item['quantity']) ?></td>
                <td><?= number_format($item['line_total'], 2) ?> EUR</td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Total : <?= number_format($total, 2) ?> EUR</h3>

    <p>
        <a href="?page=cart_clear">Vider le panier</a> |
        <a href="?page=checkout">Passer commande</a>
    </p>
<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
