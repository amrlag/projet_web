<?php require_once __DIR__ . '/partials/header.php'; ?>

<section class="page-heading">
    <p class="eyebrow">Commande</p>
    <h1>Mon panier</h1>
    <p>Retrouvez les articles selectionnes avant de passer commande.</p>
</section>

<?php if (empty($cartItems)): ?>
    <div class="empty-state">
        <h2>Votre panier est vide</h2>
        <p>Ajoutez un article depuis la boutique pour commencer une commande.</p>
        <a class="button" href="?page=shop">Retour a la boutique</a>
    </div>
<?php else: ?>
    <section class="cart-layout">
        <div class="cart-panel">
            <table>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantite</th>
                    <th>Total ligne</th>
                </tr>

                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td>
                            <strong><?= htmlspecialchars($item['product']->name) ?></strong>
                            <span><?= htmlspecialchars($item['product']->category_name) ?></span>
                        </td>
                        <td><?= number_format($item['product']->unit_price, 2) ?> EUR</td>
                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                        <td><?= number_format($item['line_total'], 2) ?> EUR</td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <aside class="cart-summary">
            <p class="eyebrow">Total</p>
            <h2><?= number_format($total, 2) ?> EUR</h2>
            <a class="button" href="?page=checkout">Passer commande</a>
            <a class="danger-link" href="?page=cart_clear">Vider le panier</a>
        </aside>
    </section>

<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
