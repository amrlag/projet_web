<?php require_once __DIR__ . '/partials/header.php'; ?>

<h1>Liste des utilisateurs</h1>

<?php if (empty($users)): ?>
    <p>Aucun utilisateur trouvé.</p>
<?php else: ?>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <?= htmlspecialchars($user['username']) ?> -
                <?= htmlspecialchars($user['email']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>