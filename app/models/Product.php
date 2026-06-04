<?php

require_once __DIR__ . '/../core/Database.php';

class Product
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getAll()
    {
        $sql = "SELECT p.*, c.name AS category_name
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.is_active = 1
                ORDER BY FIELD(c.name, 'Informatique', 'Livre', 'Hi-Fi'), p.name";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function findActiveById($id)
    {
        $sql = "SELECT p.*, c.name AS category_name
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.id = :id
                AND p.is_active = 1
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
