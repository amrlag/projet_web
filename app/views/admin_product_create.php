<?php

// Header commun
require_once __DIR__ . '/partials/header.php';

?>

<h1>Ajouter un article</h1>

<!-- Formulaire d'ajout d'un produit -->
<form method="POST" action="?page=admin_product_store">

   <div>
    <label for="category_id">Catégorie</label><br>

    <select id="category_id" name="category_id" required>
        <option value="">-- Choisir une catégorie --</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= htmlspecialchars($category['id']) ?>">
                <?= htmlspecialchars($category['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

    <br>

    <div>
        <label for="name">Nom de l'article</label><br>
        <input type="text" id="name" name="name" required>
    </div>

    <br>

    <div>
        <label for="description">Description</label><br>
        <textarea id="description" name="description"></textarea>
    </div>

    <br>

    <div>
        <label for="unit_price">Prix unitaire</label><br>
        <input type="number" step="0.01" id="unit_price" name="unit_price" required>
    </div>

    <br>

    <div>
        <label>
            <input type="checkbox" name="is_active" value="1" checked>
            Article actif
        </label>
    </div>

    <br>

    <button type="submit">Ajouter l'article</button>

</form>

<p>
    <a href="?page=admin_products">
        Retour à la gestion des articles
    </a>
</p>

<?php

// Footer commun
require_once __DIR__ . '/partials/footer.php';

?>
