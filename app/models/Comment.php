<?php

// On importe la classe Database pour accéder à la base de données
require_once __DIR__ . '/../core/Database.php';

// Classe Comment : elle représente les commentaires du blog
class Comment
{
    // Propriété privée pour stocker la connexion PDO
    private $pdo;

    // Constructeur appelé quand on crée un objet Comment
    public function __construct()
    {
        // On récupère la connexion à la base de données
        $this->pdo = Database::getConnection();
    }

    // Méthode qui récupère les commentaires liés à un billet
    public function getByPost($postId)
    {
        // Requête SQL qui récupère les commentaires d'un billet avec le pseudo de l'auteur
        $sql = "SELECT comments.*, users.username
                FROM comments
                JOIN users ON comments.user_id = users.id
                WHERE comments.post_id = :post_id
                ORDER BY comments.created_at ASC";

        // On prépare la requête
        $stmt = $this->pdo->prepare($sql);

        // On exécute la requête avec l'id du billet
        $stmt->execute(['post_id' => $postId]);

        // On retourne tous les commentaires trouvés
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode qui crée un nouveau commentaire
    public function create($postId, $userId, $content)
    {
        // Requête SQL pour insérer un commentaire
        $sql = "INSERT INTO comments (post_id, user_id, content)
                VALUES (:post_id, :user_id, :content)";

        // On prépare la requête
        $stmt = $this->pdo->prepare($sql);

        // On exécute la requête avec les données du commentaire
        return $stmt->execute([
            'post_id' => $postId,
            'user_id' => $userId,
            'content' => $content
        ]);
    }
}