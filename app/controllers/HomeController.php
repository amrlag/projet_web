
<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';

class HomeController extends Controller
{
    public function index()
    {
        $this->render('home', [
            'title' => 'Accueil - Projet Web'
        ]);
    }

    public function about()
    {
        $this->render('about', [
            'title' => 'À propos - Projet Web'
        ]);
    }

    public function users()
    {
    require_once __DIR__ . '/../models/User.php';

    $userModel = new User();
    $users = $userModel->getAllUsers();

    $this->render('users', [
        'title' => 'Liste des utilisateurs',
        'users' => $users
    ]);
    }

    public function memberArea()
    {
    if (!Auth::isLoggedIn()) {
        $this->render('access_denied', [
            'title' => 'Accès refusé',
            'message' => 'Vous devez être connecté pour accéder à cet espace.'
        ]);
        return;
    }

    $this->render('member_area', [
        'title' => 'Espace membre'
    ]);
    }

    
}