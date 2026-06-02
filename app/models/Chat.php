<?php

require_once __DIR__ . '/../core/Database.php';

class Chat
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    // Récupère les 10 derniers messages avec le nom de l'utilisateur
    public function getLastMessages()
    {
        $sql = "SELECT chat_messages.*, users.username
                FROM chat_messages
                INNER JOIN users ON users.id = chat_messages.user_id
                ORDER BY chat_messages.created_at DESC
                LIMIT 10";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajoute un message dans le mini-chat
    public function create($userId, $message)
    {
        $sql = "INSERT INTO chat_messages (user_id, message)
                VALUES (:user_id, :message)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'user_id' => $userId,
            'message' => $message
        ]);
    }
}

