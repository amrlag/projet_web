<?php require_once __DIR__ . '/partials/header.php'; ?>

<h1>Mes commandes</h1>

<?php if (empty($orders)): ?>
    <p>Aucune commande.</p>
<?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Total</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order->id) ?></td>
                <td><?= number_format($order->total_amount, 2) ?> EUR</td>
                <td><?= htmlspecialchars($order->created_at) ?></td>
                <td>
                    <a href="?page=order_details&id=<?= htmlspecialchars($order->id) ?>">Voir details</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
