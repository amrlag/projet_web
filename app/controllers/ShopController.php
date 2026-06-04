<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Order.php';

class ShopController extends Controller
{
    public function index()
    {
        $productModel = new Product();
        $products = $productModel->getAll();

        $this->render('shop', [
            'title' => 'Boutique',
            'products' => $products
        ]);
    }

    public function addToCart()
    {
        $id = (int)($_GET['id'] ?? 0);

        if ($id <= 0) {
            header('Location: ?page=shop');
            exit;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;

        header('Location: ?page=cart');
        exit;
    }

    public function cart()
    {
        $cartItems = $this->buildCartItems();

        $this->render('cart', [
            'title' => 'Mon panier',
            'cartItems' => $cartItems['items'],
            'total' => $cartItems['total']
        ]);
    }

    public function clearCart()
    {
        unset($_SESSION['cart']);

        header('Location: ?page=cart');
        exit;
    }

    public function checkout()
    {
        if (!isset($_SESSION['user'])) {
            $this->render('access_denied', [
                'title' => 'Acces refuse',
                'message' => 'Vous devez etre connecte pour passer commande.'
            ]);
            return;
        }

        $cartItems = $this->buildCartItems();

        if (empty($cartItems['items'])) {
            $this->render('cart', [
                'title' => 'Mon panier',
                'cartItems' => [],
                'total' => 0
            ]);
            return;
        }

        $orderModel = new Order();
        $orderId = $orderModel->create(
            $_SESSION['user']['id'],
            $cartItems['total'],
            $cartItems['items']
        );

        unset($_SESSION['cart']);

        header('Location: ?page=order_details&id=' . $orderId);
        exit;
    }

    public function myOrders()
    {
        if (!isset($_SESSION['user'])) {
            $this->render('access_denied', [
                'title' => 'Acces refuse',
                'message' => 'Vous devez etre connecte pour consulter vos commandes.'
            ]);
            return;
        }

        $orderModel = new Order();
        $orders = $orderModel->getByUser($_SESSION['user']['id']);

        $this->render('my_orders', [
            'title' => 'Mes commandes',
            'orders' => $orders
        ]);
    }

    public function orderDetails()
    {
        if (!isset($_SESSION['user'])) {
            $this->render('access_denied', [
                'title' => 'Acces refuse',
                'message' => 'Vous devez etre connecte pour consulter cette commande.'
            ]);
            return;
        }

        $orderId = (int)($_GET['id'] ?? 0);
        $orderModel = new Order();
        $order = $orderModel->getByIdForUser($orderId, $_SESSION['user']['id']);

        if (!$order) {
            echo "Commande introuvable.";
            return;
        }

        $items = $orderModel->getItems($orderId);

        $this->render('order_details', [
            'title' => 'Detail commande',
            'order' => $order,
            'items' => $items
        ]);
    }

    private function buildCartItems()
    {
        $cart = $_SESSION['cart'] ?? [];

        if (empty($cart)) {
            return [
                'items' => [],
                'total' => 0
            ];
        }

        $productModel = new Product();
        $products = $productModel->getAll();
        $items = [];
        $total = 0;

        foreach ($products as $product) {
            if (!isset($cart[$product->id])) {
                continue;
            }

            $quantity = (int)$cart[$product->id];
            $lineTotal = (float)$product->unit_price * $quantity;
            $total += $lineTotal;

            $items[] = [
                'product' => $product,
                'quantity' => $quantity,
                'line_total' => $lineTotal
            ];
        }

        return [
            'items' => $items,
            'total' => $total
        ];
    }
}
