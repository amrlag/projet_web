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

    public function findById($id)
    {
    $sql = "SELECT id, first_name, last_name, address, postal_code, email, username, role
            FROM users
            WHERE id = :id
            LIMIT 1";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        'id' => $id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function emailExistsForOtherUser($email, $userId)
{
    $sql = "SELECT id FROM users
            WHERE email = :email
            AND id != :user_id
            LIMIT 1";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        'email' => $email,
        'user_id' => $userId
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function updateProfile($userId, $data)
{
    if (!empty($data['password'])) {
        $sql = "UPDATE users
                SET address = :address,
                    postal_code = :postal_code,
                    email = :email,
                    password_hash = :password_hash
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'address' => $data['address'],
            'postal_code' => $data['postal_code'],
            'email' => $data['email'],
            'password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            'id' => $userId
        ]);
    }

    $sql = "UPDATE users
            SET address = :address,
                postal_code = :postal_code,
                email = :email
            WHERE id = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        'address' => $data['address'],
        'postal_code' => $data['postal_code'],
        'email' => $data['email'],
        'id' => $userId
    ]);
    }
}