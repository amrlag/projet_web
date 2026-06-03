<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../config/database.php';

class ShopController
{
    public function index()
    {
        $productModel = new Product();

        $products = $productModel->getAll();

        require __DIR__ . '/../views/shop.php';
    }
 public function addToCart()
{
    $id = $_GET['id'] ?? null;

    if (!$id) {
        header('Location: ?page=shop');
        exit;
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 1;
    } else {
        $_SESSION['cart'][$id]++;
    }

    header('Location: ?page=cart');
    exit;
}

public function cart()
{
    echo "<h1>Mon panier</h1>";

    if (empty($_SESSION['cart'])) {
        echo "<p>Votre panier est vide.</p>";
        return;
    }

    $productModel = new Product();
    $products = $productModel->getAll();
    $products = $productModel->getAll();
    $total = 0;

    echo "<table border='1' cellpadding='8'>";
    echo "<tr>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
          </tr>";

    foreach ($products as $product) {

        if (isset($_SESSION['cart'][$product->id])) {
            $qte = $_SESSION['cart'][$product->id];
            $total += $product->unit_price * $qte;

            echo "<tr>";
             echo "<td>" . $product->name . "</td>";
             echo "<td>" . $product->unit_price . " €</td>";
             echo "<td>" . $qte . "</td>";


            
            
            echo "</tr>";
        }
    }

    echo "</table>";
    echo "<h3>Total : " . number_format($total, 2) . " €</h3>";
    echo '<p><a href="?page=cart_clear">Vider le panier</a></p>';
    echo '<p><a href="?page=checkout">Passer commande</a></p>';
    }
    public function clearCart()
{
    unset($_SESSION['cart']);
    header('Location: ?page=cart');
    exit;
}
  public function checkout()
{
    if (empty($_SESSION['cart'])) {
        echo "<h1>Commande</h1>";
        echo "<p>Votre panier est vide.</p>";
        return;
    }

    $productModel = new Product();
    $products = $productModel->getAll();

    $total = 0;
    $db = new Database();
$conn = $db->getConnection();

$userId = $_SESSION['user_id'] ?? 1;



    foreach ($products as $product) {
        if (isset($_SESSION['cart'][$product->id])) {
            $qte = $_SESSION['cart'][$product->id];
            $total += $product->unit_price * $qte;
        }
    }
$stmt = $conn->prepare("
    INSERT INTO orders (user_id, total_amount, created_at)
    VALUES (?, ?, NOW())
");

$stmt->execute([$userId, $total]);

$orderId = $conn->lastInsertId();
foreach ($products as $product) {
    if (isset($_SESSION['cart'][$product->id])) {
        $qte = $_SESSION['cart'][$product->id];
        $lineTotal = $product->unit_price * $qte;

        $stmt = $conn->prepare("
            INSERT INTO order_items (order_id, product_id, quantity, unit_price, line_total)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $orderId,
            $product->id,
            $qte,
            $product->unit_price,
            $lineTotal
        ]);
    }
}
    
    echo "<h1>Commande validée</h1>";
    echo "<p>Total : " . number_format($total, 2) . " €</p>";
    echo "<p>Merci pour votre achat.</p>";

    unset($_SESSION['cart']);
}
}  

    
    





    



    











