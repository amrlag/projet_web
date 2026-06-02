<?php

// Header commun du site
require_once __DIR__ . '/partials/header.php';

?>

<h1>Gestion des utilisateurs</h1>

<!-- Tableau affichant tous les utilisateurs -->
<table border="1" cellpadding="5">

    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Pseudo</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Statut</th>
        <th>Actions</th>
    </tr>

    <!-- Parcours de la liste des utilisateurs -->
    <?php foreach ($users as $user): ?>

        <tr>

            <td><?= $user['id'] ?></td>

            <td>
                <?= htmlspecialchars($user['first_name']) ?>
                <?= htmlspecialchars($user['last_name']) ?>
            </td>

            <td><?= htmlspecialchars($user['username']) ?></td>

            <td><?= htmlspecialchars($user['email']) ?></td>

            <td><?= htmlspecialchars($user['role']) ?></td>

            <!-- Affichage de l'état du compte -->
            <td>
                <?= $user['is_blocked'] ? 'Bloqué' : 'Actif' ?>
            </td>

            <td>

                <!-- Consultation du profil -->
                <a href="?page=admin_user_show&id=<?= $user['id'] ?>">
                    Voir profil
                </a>

                |

                <!-- Blocage ou déblocage -->
                <a href="?page=admin_toggle_block&id=<?= $user['id'] ?>">

                    <?= $user['is_blocked']
                        ? 'Débloquer'
                        : 'Bloquer' ?>

                </a>

            </td>

        </tr>

    <?php endforeach; ?>

</table>

<?php

// Footer commun du site
require_once __DIR__ . '/partials/footer.php';

?>