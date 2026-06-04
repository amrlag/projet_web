<?php

require_once __DIR__ . '/../core/Database.php';

class Order
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function create($userId, $totalAmount, $items)
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO orders (user_id, total_amount)
                VALUES (:user_id, :total_amount)
            ");

            $stmt->execute([
                'user_id' => $userId,
                'total_amount' => $totalAmount
            ]);

            $orderId = $this->pdo->lastInsertId();

            $itemStmt = $this->pdo->prepare("
                INSERT INTO order_items (order_id, product_id, quantity, unit_price, line_total)
                VALUES (:order_id, :product_id, :quantity, :unit_price, :line_total)
            ");

            foreach ($items as $item) {
                $product = $item['product'];

                $itemStmt->execute([
                    'order_id' => $orderId,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->unit_price,
                    'line_total' => $item['line_total']
                ]);
            }

            $this->pdo->commit();

            return $orderId;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function getByUser($userId)
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM orders
            WHERE user_id = :user_id
            ORDER BY created_at DESC
        ");

        $stmt->execute([
            'user_id' => $userId
        ]);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getByIdForUser($orderId, $userId)
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM orders
            WHERE id = :id
            AND user_id = :user_id
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $orderId,
            'user_id' => $userId
        ]);

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getItems($orderId)
    {
        $stmt = $this->pdo->prepare("
            SELECT order_items.*, products.name
            FROM order_items
            JOIN products ON products.id = order_items.product_id
            WHERE order_items.order_id = :order_id
        ");

        $stmt->execute([
            'order_id' => $orderId
        ]);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
