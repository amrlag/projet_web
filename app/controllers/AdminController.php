<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Admin.php';

/**
 * Contrôleur de l'espace Administration.
 * Toutes les fonctionnalités réservées à l'administrateur
 * passent par cette classe.
 */
class AdminController extends Controller
{
    /**
     * Vérifie que l'utilisateur connecté est administrateur.
     */
    private function checkAdmin()
    {
        if (
            !isset($_SESSION['user']['role']) ||
            $_SESSION['user']['role'] !== 'admin'
        ) {
            echo "Accès refusé.";
            exit;
        }
    }

    /**
     * Affiche le tableau de bord administrateur.
     */
    public function index()
    {
        $this->checkAdmin();

        $this->render('admin', [
            'title' => 'Administration'
        ]);
    }

    /**
     * Affiche la liste des utilisateurs.
     */
    public function users()
    {
        $this->checkAdmin();

        $adminModel = new Admin();
        $users = $adminModel->getAllUsers();

        $this->render('admin_users', [
            'title' => 'Gestion des utilisateurs',
            'users' => $users
        ]);
    }

/**
 * Affiche le profil détaillé d'un utilisateur.
 */
public function showUser()
{
    $this->checkAdmin();

    $id = $_GET['id'] ?? null;

    $adminModel = new Admin();

    $user = $adminModel->getUserById($id);

    // Statistiques de connexion de l'utilisateur
    $todayConnections = $adminModel->getConnectionsToday($id);
    $weekConnections = $adminModel->getConnectionsLast7Days($id);
    // Récupération des 5 derniers commentaires Blog/News
    $lastComments = $adminModel->getLastCommentsByUser($id);

    $this->render('admin_user_show', [
        'title' => 'Profil utilisateur',
        'user' => $user,
        'todayConnections' => $todayConnections,
        'weekConnections' => $weekConnections,
        'lastComments' => $lastComments
    ]);
}
/**
 * Affiche les achats d'un utilisateur.
 */
public function showUserOrders()
{
    $this->checkAdmin();

    $userId = $_GET['id'] ?? null;

    $adminModel = new Admin();

    $user = $adminModel->getUserById($userId);
    $orders = $adminModel->getOrdersByUser($userId);

    $this->render('admin_user_orders', [
        'title' => 'Achats utilisateur',
        'user' => $user,
        'orders' => $orders
    ]);
}

/**
 * Affiche les détails d'un achat.
 */
public function showOrderDetails()
{
    $this->checkAdmin();

    $orderId = $_GET['id'] ?? null;

    $adminModel = new Admin();

    $items = $adminModel->getOrderItems($orderId);

    $this->render('admin_order_details', [
        'title' => 'Détail achat',
        'items' => $items
    ]);
}

/**
 * Liste des produits.
 */
public function products()
{
    $this->checkAdmin();

    $adminModel = new Admin();

    $products = $adminModel->getAllProducts();

    $this->render('admin_products', [
        'title' => 'Gestion produits',
        'products' => $products
    ]);
}

/**
 * Suppression d'un produit.
 */
public function deleteProduct()
{
    $this->checkAdmin();

    $id = $_GET['id'] ?? null;

    $adminModel = new Admin();

    $adminModel->deleteProduct($id);

    header('Location: ?page=admin_products');
    exit;
}
/**
 * Affiche le formulaire d'ajout d'un produit.
 */
public function createProduct()
{
    $this->checkAdmin();

    $this->render('admin_product_create', [
        'title' => 'Ajouter un article'
    ]);
}

/**
 * Enregistre un nouveau produit.
 */
public function storeProduct()
{
    $this->checkAdmin();

    $data = [
        'category_id' => $_POST['category_id'] ?? '',
        'name' => trim($_POST['name'] ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'unit_price' => $_POST['unit_price'] ?? '',
        'is_active' => 1
    ];

    $adminModel = new Admin();
    $adminModel->createProduct($data);

    header('Location: ?page=admin_products');
    exit;
}

    /**
     * Bloque ou débloque un utilisateur.
     */
    public function toggleBlock()
    {
        $this->checkAdmin();

        $id = $_GET['id'] ?? null;

        $adminModel = new Admin();
        $adminModel->toggleBlock($id);

        header('Location: ?page=admin_users');
        exit;
    }
}