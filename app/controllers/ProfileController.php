<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/User.php';

class ProfileController extends Controller
{
    public function edit()
{
    if (!Auth::isLoggedIn()) {
        $this->render('access_denied', [
            'title' => 'Accès refusé',
            'message' => 'Vous devez être connecté pour modifier votre profil.'
        ]);
        return;
    }

    $userModel = new User();
    $user = $userModel->findById($_SESSION['user']['id']);

    if (!$user) {
        echo "Erreur : utilisateur introuvable.";
        return;
    }

    $this->render('profile_edit', [
        'title' => 'Modifier mon profil',
        'user' => $user
    ]);
}

    public function update()
    {
        if (!Auth::isLoggedIn()) {
            $this->render('access_denied', [
                'title' => 'Accès refusé',
                'message' => 'Vous devez être connecté pour modifier votre profil.'
            ]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Méthode non autorisée.";
            return;
        }

        $userId = $_SESSION['user']['id'];

        $data = [
            'address' => trim($_POST['address'] ?? ''),
            'postal_code' => trim($_POST['postal_code'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? ''
        ];

        if (empty($data['address']) || empty($data['postal_code']) || empty($data['email'])) {
            echo "L’adresse, le code postal et l’email sont obligatoires.";
            return;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo "Adresse email invalide.";
            return;
        }

        if (!empty($data['password']) && strlen($data['password']) < 6) {
            echo "Le nouveau mot de passe doit contenir au moins 6 caractères.";
            return;
        }

        try {
            $userModel = new User();

            if ($userModel->emailExistsForOtherUser($data['email'], $userId)) {
                echo "Cette adresse email est déjà utilisée par un autre compte.";
                return;
            }

            $userModel->updateProfile($userId, $data);

            $this->render('profile_success', [
                'title' => 'Profil modifié'
            ]);

        } catch (PDOException $e) {
            echo "Erreur lors de la modification du profil : " . $e->getMessage();
        }
    }
}