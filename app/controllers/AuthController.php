<?php

require_once __DIR__ . '/../core/Controller.php';

class AuthController extends Controller
{
    public function register()
    {
        $this->render('register', [
            'title' => 'Inscription'
        ]);
    }
}