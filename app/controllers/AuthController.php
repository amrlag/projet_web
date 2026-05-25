<?php

// On inclut le fichier Controller.php.
// Ce fichier contient la classe Controller de base,
// qui permet notamment d'utiliser la méthode render().
require_once __DIR__ . '/../core/Controller.php';

// On inclut le modèle User.
// Ce fichier contient la classe User, qui sert à communiquer
// avec la table des utilisateurs dans la base de données.
require_once __DIR__ . '/../models/User.php';

// AuthController est le contrôleur responsable de l'authentification.
// Ici, il gère principalement l'inscription d'un nouvel utilisateur.
class AuthController extends Controller
{
    /**
     * Cette méthode affiche le formulaire d'inscription.
     *
     * Elle ne traite pas encore les données.
     * Elle sert uniquement à afficher la page register.php.
     */
    public function register()
    {
        // On appelle la méthode render() héritée de Controller.
        // Elle permet d'afficher la vue "register".
        //
        // Le tableau envoyé en deuxième paramètre contient les données
        // disponibles dans la vue.
        // Ici, on envoie le titre de la page.
        $this->render('register', [
            'title' => 'Inscription'
        ]);
    }

    /**
     * Cette méthode traite le formulaire d'inscription.
     *
     * Elle récupère les données envoyées par le formulaire,
     * vérifie que les champs sont valides,
     * puis crée un nouvel utilisateur en base de données.
     */
    public function store()
    {
        // On vérifie que le formulaire a bien été envoyé avec la méthode POST.
        //
        // En général :
        // - GET sert à afficher une page ou récupérer des informations.
        // - POST sert à envoyer des données, par exemple un formulaire.
        //
        // Si quelqu'un essaie d'accéder directement à cette méthode
        // sans passer par le formulaire, on bloque l'action.
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Méthode non autorisée";
            return;
        }

        // On récupère toutes les données envoyées depuis le formulaire.
        //
        // $_POST contient les valeurs envoyées par le formulaire HTML.
        //
        // trim() permet de supprimer les espaces inutiles
        // au début et à la fin du texte.
        //
        // Le ?? '' signifie :
        // si la valeur n'existe pas, on met une chaîne vide à la place.
        // Cela évite les erreurs PHP.
        $data = [
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name' => trim($_POST['last_name'] ?? ''),
            'address' => trim($_POST['address'] ?? ''),
            'postal_code' => trim($_POST['postal_code'] ?? ''),
            'birth_date' => trim($_POST['birth_date'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'username' => trim($_POST['username'] ?? ''),

            // Pour le mot de passe, on ne met pas trim().
            // Cela évite de modifier le mot de passe choisi par l'utilisateur.
            'password' => $_POST['password'] ?? ''
        ];

        // On vérifie que tous les champs sont remplis.
        //
        // La boucle foreach parcourt chaque valeur du tableau $data.
        // Si une valeur est vide, on affiche un message d'erreur
        // et on arrête le traitement avec return.
        foreach ($data as $value) {
            if (empty($value)) {
                echo "Tous les champs sont obligatoires.";
                return;
            }
        }

        // On vérifie que l'adresse email est valide.
        //
        // filter_var() avec FILTER_VALIDATE_EMAIL permet de contrôler
        // que l'email respecte un format correct.
        //
        // Exemple valide :
        // exemple@gmail.com
        //
        // Exemple invalide :
        // exemplegmail.com
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo "Adresse email invalide.";
            return;
        }

        // On vérifie que le mot de passe contient au moins 6 caractères.
        //
        // strlen() permet de compter le nombre de caractères
        // dans une chaîne de texte.
        if (strlen($data['password']) < 6) {
            echo "Le mot de passe doit contenir au moins 6 caractères.";
            return;
        }

        try {
            // On crée une instance du modèle User.
            // Cela permet d'utiliser les méthodes définies dans User.php.
            $userModel = new User();

            // On appelle la méthode create() du modèle User.
            // Cette méthode va normalement insérer le nouvel utilisateur
            // dans la base de données.
            $userModel->create($data);

            // Si l'inscription réussit, on affiche la page de succès.
            //
            // On transmet :
            // - un titre de page
            // - le nom d'utilisateur créé
            //
            // La vue register_success pourra ensuite afficher ces informations.
            $this->render('register_success', [
                'title' => 'Inscription réussie',
                'username' => $data['username']
            ]);

        } catch (PDOException $e) {
            // Si une erreur survient avec la base de données,
            // elle est capturée ici.
            //
            // PDOException représente une erreur liée à PDO,
            // donc généralement une erreur SQL ou une erreur de connexion.
            //
            // Pour un projet débutant, afficher le message peut aider à comprendre.
            // Mais dans un vrai site en production, il ne faut pas afficher
            // directement les erreurs techniques aux utilisateurs.
            echo "Erreur lors de l'inscription : " . $e->getMessage();
        }
    }
}