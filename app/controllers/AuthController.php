<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller
{
    public function register()
    {
        $this->render('register', [
            'title' => 'Inscription'
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Méthode non autorisée";
            return;
        }

        $data = [
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name' => trim($_POST['last_name'] ?? ''),
            'address' => trim($_POST['address'] ?? ''),
            'postal_code' => trim($_POST['postal_code'] ?? ''),
            'birth_date' => trim($_POST['birth_date'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'username' => trim($_POST['username'] ?? ''),
            'password' => $_POST['password'] ?? ''
        ];

        foreach ($data as $value) {
            if (empty($value)) {
                echo "Tous les champs sont obligatoires.";
                return;
            }
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo "Adresse email invalide.";
            return;
        }

        if (strlen($data['password']) < 6) {
            echo "Le mot de passe doit contenir au moins 6 caractères.";
            return;
        }

        try {
            $userModel = new User();

            if ($userModel->emailExists($data['email'])) {
                echo "Cette adresse email est déjà utilisée.";
                return;
            }

            if ($userModel->usernameExists($data['username'])) {
                echo "Ce pseudo est déjà utilisé.";
                return;
            }

            $userModel->create($data);

            $this->render('register_success', [
                'title' => 'Inscription réussie',
                'username' => $data['username']
            ]);

        } catch (PDOException $e) {
            echo "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }

    public function login()
    {
        $this->render('login', [
            'title' => 'Connexion'
        ]);
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Méthode non autorisée";
            return;
        }

        $login = trim($_POST['login'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($login) || empty($password)) {
            echo "Le login/email et le mot de passe sont obligatoires.";
            return;
        }

        $userModel = new User();
        $user = $userModel->findByLogin($login);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            echo "Identifiants incorrects.";
            return;
        }

        if ((int)$user['is_blocked'] === 1) {
            echo "Votre compte est bloqué. Accès refusé.";
            return;
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'username' => $user['username'],
            'role' => $user['role']
        ];

        $userModel->logConnection($user['id']);

        $this->render('login_success', [
            'title' => 'Connexion réussie',
            'username' => $user['username']
        ]);
    }

    public function logout()
    {
    $_SESSION = [];
    session_destroy();

    $this->render('logout_success', [
        'title' => 'Déconnexion'
    ]);
    }

    
}
