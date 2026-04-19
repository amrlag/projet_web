<?php

require_once __DIR__ . '/../core/Controller.php';

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
}