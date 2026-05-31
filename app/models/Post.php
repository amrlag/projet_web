<?php

// On importe la classe Database pour pouvoir se connecter à la base de données
require_once __DIR__ . '/../core/Database.php';

// Classe Post : elle représente les billets/articles du blog
class Post
{
    // Propriété privée qui contiendra la connexion PDO
    private $pdo;

    // Constructeur appelé automatiquement quand on crée un objet Post
    public function __construct()
    {
        // On récupère la connexion à la base de données
        $this->pdo = Database::getConnection();
    }

    // Méthode qui récupère tous les billets, avec ou sans recherche
    public function getAll($search = '')
    {
        // Si l'utilisateur a entré un texte de recherche
        if (!empty($search)) {

            // Requête SQL qui cherche les billets dont le titre contient le mot recherché
            $sql = "SELECT posts.*, users.username 
                    FROM posts 
                    JOIN users ON posts.user_id = users.id
                    WHERE posts.title LIKE :search
                    ORDER BY posts.created_at DESC";

            // On prépare la requête pour éviter les injections SQL
            $stmt = $this->pdo->prepare($sql);

            // On exécute la requête avec le critère de recherche
            $stmt->execute([
                'search' => '%' . $search . '%'
            ]);

            // On retourne tous les résultats sous forme de tableau associatif
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Requête SQL qui récupère tous les billets avec le pseudo de l'auteur
        $sql = "SELECT posts.*, users.username 
                FROM posts 
                JOIN users ON posts.user_id = users.id
                ORDER BY posts.created_at DESC";

        // On exécute la requête et on retourne tous les billets
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode qui récupère un seul billet grâce à son id
    public function getById($id)
    {
        // Requête SQL qui récupère un billet précis avec le pseudo de l'auteur
        $sql = "SELECT posts.*, users.username 
                FROM posts 
                JOIN users ON posts.user_id = users.id
                WHERE posts.id = :id";

        // On prépare la requête
        $stmt = $this->pdo->prepare($sql);

        // On exécute la requête avec l'id reçu
        $stmt->execute(['id' => $id]);

        // On retourne un seul résultat
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode qui crée un nouveau billet
    public function create($title, $content, $userId)
    {
        // Requête SQL d'insertion d'un billet
        $sql = "INSERT INTO posts (title, content, user_id)
                VALUES (:title, :content, :user_id)";

        // On prépare la requête
        $stmt = $this->pdo->prepare($sql);

        // On exécute la requête avec les données reçues
        return $stmt->execute([
            'title' => $title,
            'content' => $content,
            'user_id' => $userId
        ]);
    }
}