<?php

require_once __DIR__ . '/../core/Database.php';

class User
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getAllUsers()
    {
        $sql = "SELECT id, first_name, last_name, email, username, role, is_blocked, created_at 
                FROM users";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}