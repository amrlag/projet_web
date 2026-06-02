<?php

require_once __DIR__ . '/../core/Database.php';

/**
 * Modèle utilisé pour les opérations
 * réservées à l'administrateur.
 */
class Admin
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /**
     * Récupère tous les utilisateurs.
     */
    public function getAllUsers()
    {
        $sql = "
            SELECT
                id,
                first_name,
                last_name,
                username,
                email,
                role,
                is_blocked
            FROM users
            ORDER BY username
        ";

        return $this->pdo
            ->query($sql)
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un utilisateur par son id.
     */
    public function getUserById($id)
    {
        $sql = "
            SELECT *
            FROM users
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Bloque ou débloque un utilisateur.
     */
    public function toggleBlock($id)
    {
        $sql = "
            UPDATE users
            SET is_blocked = NOT is_blocked
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }

    /**
     * Nombre de connexions aujourd'hui.
     */
    public function getConnectionsToday($userId)
    {
        $sql = "
            SELECT COUNT(*) as total
            FROM connection_logs
            WHERE user_id = :user_id
            AND DATE(connected_at) = CURDATE()
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
 * Récupère les 5 derniers commentaires
 * publiés par un utilisateur dans le Blog/News.
 */
public function getLastCommentsByUser($userId)
{
    $sql = "
        SELECT
            comments.content,
            comments.created_at,
            posts.title AS post_title
        FROM comments
        JOIN posts ON comments.post_id = posts.id
        WHERE comments.user_id = :user_id
        ORDER BY comments.created_at DESC
        LIMIT 5
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
/**
 * Récupère les achats d'un utilisateur,
 * classés du plus récent au plus ancien.
 */
public function getOrdersByUser($userId)
{
    $sql = "
        SELECT *
        FROM orders
        WHERE user_id = :user_id
        ORDER BY created_at DESC
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Récupère les détails d'un achat.
 */
public function getOrderItems($orderId)
{
    $sql = "
        SELECT
            order_items.*,
            products.name AS product_name
        FROM order_items
        JOIN products ON order_items.product_id = products.id
        WHERE order_items.order_id = :order_id
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['order_id' => $orderId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
/**
 * Récupère tous les produits.
 */
public function getAllProducts()
{
    $sql = "
        SELECT *
        FROM products
        ORDER BY created_at DESC
    ";

    return $this->pdo
        ->query($sql)
        ->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Supprime un produit.
 */
public function deleteProduct($id)
{
    $sql = "
        DELETE FROM products
        WHERE id = :id
    ";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        'id' => $id
    ]);
}
/**
 * Ajoute un nouveau produit dans l'espace vente.
 */
public function createProduct($data)
{
    $sql = "
        INSERT INTO products
        (category_id, name, description, unit_price, is_active)
        VALUES
        (:category_id, :name, :description, :unit_price, :is_active)
    ";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        'category_id' => $data['category_id'],
        'name' => $data['name'],
        'description' => $data['description'],
        'unit_price' => $data['unit_price'],
        'is_active' => $data['is_active']
    ]);
}

    /**
     * Nombre de connexions sur les 7 derniers jours.
     */
    public function getConnectionsLast7Days($userId)
    {
        $sql = "
            SELECT COUNT(*) as total
            FROM connection_logs
            WHERE user_id = :user_id
            AND connected_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}