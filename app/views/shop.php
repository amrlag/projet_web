<?php require_once __DIR__ . '/partials/header.php'; ?>

<section class="page-heading">
    <p class="eyebrow">Catalogue</p>
    <h1>Boutique</h1>
    <p>
        Articles classes par categorie. La consultation est ouverte a tous;
        la validation de commande est reservee aux utilisateurs connectes.
    </p>
</section>

<?php if (empty($products)): ?>
    <div class="empty-state">
        <h2>Aucun produit disponible</h2>
        <p>Les articles ajoutes par l'administrateur apparaitront ici.</p>
    </div>
<?php else: ?>
    <?php
    $productsByCategory = [];

    foreach ($products as $product) {
        $productsByCategory[$product->category_name][] = $product;
    }
    ?>

    <?php foreach ($productsByCategory as $categoryName => $categoryProducts): ?>
        <section class="catalog-section">
            <div class="catalog-heading">
                <h2><?= htmlspecialchars($categoryName) ?></h2>
                <span><?= count($categoryProducts) ?> articles</span>
            </div>

            <div class="product-grid">
                <?php foreach ($categoryProducts as $product): ?>
                    <article class="product-card">
                        <div>
                            <p class="product-category"><?= htmlspecialchars($product->category_name) ?></p>
                            <h3><?= htmlspecialchars($product->name) ?></h3>
                            <p><?= htmlspecialchars($product->description ?? '') ?></p>
                        </div>

                        <div class="product-card-footer">
                            <strong><?= number_format($product->unit_price, 2) ?> EUR</strong>
                            <a class="button" href="?page=cart_add&id=<?= htmlspecialchars($product->id) ?>">
                                Ajouter
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>
<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
