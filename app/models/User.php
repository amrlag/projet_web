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

    public function create($data)
    {
        $sql = "INSERT INTO users 
                (first_name, last_name, address, postal_code, birth_date, email, username, password_hash)
                VALUES 
                (:first_name, :last_name, :address, :postal_code, :birth_date, :email, :username, :password_hash)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'postal_code' => $data['postal_code'],
            'birth_date' => $data['birth_date'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password_hash' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }

    public function findByLogin($login)
    {
        $sql = "SELECT * FROM users 
                WHERE username = :login OR email = :login 
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'login' => $login
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function logConnection($userId)
    {
        $sql = "INSERT INTO connection_logs (user_id) 
                VALUES (:user_id)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'user_id' => $userId
        ]);
    }
}