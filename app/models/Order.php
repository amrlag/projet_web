<?php

require_once __DIR__ . '/../config/database.php';

class Order
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getByUser($userId)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM orders
            WHERE user_id = ?
            ORDER BY created_at DESC
        ");

        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getItems($orderId)
    {
        $stmt = $this->conn->prepare("
            SELECT oi.*, p.name
            FROM order_items oi
            JOIN products p ON p.id = oi.product_id
            WHERE oi.order_id = ?
        ");

        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}