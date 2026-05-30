<?php

// Header commun du site
require_once __DIR__ . '/partials/header.php';

?>

<h1>Administration du site</h1>

<!-- Menu principal de l'administration -->
<ul>

    <li>
        <a href="?page=admin_users">
            Gestion des utilisateurs
        </a>
    </li>

    <li>
        <a href="?page=admin_products">
            Gestion des articles de vente
        </a>
    </li>

</ul>

<?php

// Footer commun du site
require_once __DIR__ . '/partials/footer.php';

?>