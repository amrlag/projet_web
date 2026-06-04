<?php require_once __DIR__ . '/partials/header.php'; ?>

<h1>Modifier un article</h1>

<form method="POST" action="?page=admin_product_update">
    <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">

    <div>
        <label for="category_id">Categorie</label><br>

        <select id="category_id" name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option
                    value="<?= htmlspecialchars($category['id']) ?>"
                    <?= (int)$category['id'] === (int)$product['category_id'] ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <br>

    <div>
        <label for="name">Nom de l'article</label><br>
        <input
            type="text"
            id="name"
            name="name"
            value="<?= htmlspecialchars($product['name']) ?>"
            required
        >
    </div>

    <br>

    <div>
        <label for="description">Description</label><br>
        <textarea id="description" name="description"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
    </div>

    <br>

    <div>
        <label for="unit_price">Prix unitaire</label><br>
        <input
            type="number"
            step="0.01"
            id="unit_price"
            name="unit_price"
            value="<?= htmlspecialchars($product['unit_price']) ?>"
            required
        >
    </div>

    <br>

    <div>
        <label>
            <input
                type="checkbox"
                name="is_active"
                value="1"
                <?= (int)$product['is_active'] === 1 ? 'checked' : '' ?>
            >
            Article actif
        </label>
    </div>

    <br>

    <button type="submit">Enregistrer</button>
</form>

<p><a href="?page=admin_products">Retour a la gestion des articles</a></p>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
