<?php require_once __DIR__ . '/partials/header.php'; ?>

<h1>Detail commande #<?= htmlspecialchars($order->id) ?></h1>

<p>
    Date : <?= htmlspecialchars($order->created_at) ?><br>
    Total : <?= number_format($order->total_amount, 2) ?> EUR
</p>

<?php if (empty($items)): ?>
    <p>Aucun article trouve pour cette commande.</p>
<?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>Produit</th>
            <th>Quantite</th>
            <th>Prix unitaire</th>
            <th>Total ligne</th>
        </tr>

        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item->name) ?></td>
                <td><?= htmlspecialchars($item->quantity) ?></td>
                <td><?= number_format($item->unit_price, 2) ?> EUR</td>
                <td><?= number_format($item->line_total, 2) ?> EUR</td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<p><a href="?page=my_orders">Retour a mes commandes</a></p>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
