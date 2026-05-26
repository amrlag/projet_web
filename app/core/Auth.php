<?php

class Auth
{
    public static function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    public static function user()
    {
        return $_SESSION['user'] ?? null;
    }

    public static function isAdmin()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
    }
}