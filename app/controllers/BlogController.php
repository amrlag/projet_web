<?php

// On importe la classe Controller pour utiliser la méthode render()
require_once __DIR__ . '/../core/Controller.php';

// On importe le modèle Post
require_once __DIR__ . '/../models/Post.php';

// On importe le modèle Comment
require_once __DIR__ . '/../models/Comment.php';

// Contrôleur qui gère toute la partie Blog / News
class BlogController extends Controller
{
    // Méthode qui affiche la liste des billets
    public function index()
    {
        // On crée un objet Post pour utiliser les méthodes du modèle
        $postModel = new Post();

        // On récupère le mot recherché dans l'URL, ou une chaîne vide s'il n'existe pas
        $search = $_GET['search'] ?? '';

        // On récupère les billets, filtrés ou non selon la recherche
        $posts = $postModel->getAll($search);

        // On affiche la vue blog/index.php avec les données
        $this->render('blog', [
            'title' => 'Blog / News',
            'posts' => $posts,
            'search' => $search
        ]);
    }

    // Méthode qui affiche un billet précis avec ses commentaires
    public function show()
    {
        // On récupère l'id du billet depuis l'URL
        $id = $_GET['id'] ?? null;

        // Si aucun id n'est fourni, on affiche une erreur
        if (!$id) {
            echo "Article introuvable";
            return;
        }

        // On crée un objet Post
        $postModel = new Post();

        // On crée un objet Comment
        $commentModel = new Comment();

        // On récupère le billet correspondant à l'id
        $post = $postModel->getById($id);

        // On récupère les commentaires du billet
        $comments = $commentModel->getByPost($id);

        // On affiche la vue blog/show.php avec le billet et les commentaires
        $this->render('blog_show', [
            'title' => $post['title'] ?? 'Article',
            'post' => $post,
            'comments' => $comments
        ]);
    }

    // Méthode qui affiche le formulaire de création d'un billet
    public function create()
    {
        // On vérifie que l'utilisateur est connecté et qu'il est administrateur
        if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 'admin') {
            echo "Accès refusé : seul l'administrateur peut créer un billet.";
            return;
        }

        // On affiche la vue blog/create.php
        $this->render('blog_create', [
            'title' => 'Créer un billet'
        ]);
    }

    // Méthode qui enregistre un nouveau billet
    public function store()
    {
        // On vérifie que l'utilisateur est administrateur
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            echo "Accès refusé.";
            return;
        }

        // On crée un objet Post
        $postModel = new Post();

        // On appelle la méthode create() du modèle pour insérer le billet
        $postModel->create(
            $_POST['title'],
            $_POST['content'],
            $_SESSION['user']['id']);

        // Après l'insertion, on redirige vers la liste des billets
        header('Location: ?page=blog');
        exit;
    }

    // Méthode qui ajoute un commentaire à un billet
    public function addComment()
    {
        // On vérifie que l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            echo "Vous devez vous inscrire ou vous connecter pour ajouter un commentaire.";
            return;
        }

        // On crée un objet Comment
        $commentModel = new Comment();

        // On insère le commentaire dans la base de données
        $commentModel->create(
            $_POST['post_id'],
            $_SESSION['user']['id'],
            $_POST['content']
        );

        // On redirige vers le billet commenté
        header('Location: ?page=blog_show&id=' . $_POST['post_id']);
        exit;
    }
}