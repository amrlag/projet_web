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
                <td><?= $order->id ?></td>
                <td><?= number_format($order->total_amount, 2) ?> €</td>
                <td><?= $order->created_at ?></td>
                <td>
                    <a href="?page=order_details&id=<?= $order->id ?>">Voir détails</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>