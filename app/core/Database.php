<?php

// Je crée une classe Database.
// Cette classe va me servir à gérer la connexion à la base de données.
class Database
{
    // Ici, je crée une propriété statique privée $pdo.
    //
    // Elle va contenir la connexion à la base de données.
    //
    // Je la mets à null au départ parce qu'au début,
    // aucune connexion n'a encore été créée.
    //
    // Le mot-clé static permet d'utiliser cette variable directement
    // avec la classe Database, sans devoir créer un objet Database.
    private static $pdo = null;

    // Cette méthode permet de récupérer la connexion à la base de données.
    //
    // Elle est public parce que je dois pouvoir l'utiliser ailleurs
    // dans mon projet, par exemple dans mes modèles.
    //
    // Elle est static parce que je veux pouvoir l'appeler comme ceci :
    // Database::getConnection()
    public static function getConnection()
    {
        // Je vérifie si la connexion PDO n'existe pas encore.
        //
        // Si self::$pdo vaut null, ça veut dire qu'aucune connexion
        // à la base de données n'a encore été créée.
        if (self::$pdo === null) {

            // Je récupère les informations de connexion depuis
            // le fichier config/database.php.
            //
            // Ce fichier contient normalement :
            // - le nom du serveur
            // - le nom de la base de données
            // - le nom d'utilisateur
            // - le mot de passe
            $config = require __DIR__ . '/../config/database.php';

            // Ici, je crée une nouvelle connexion PDO à MySQL.
            //
            // PDO est un outil PHP qui permet de communiquer
            // avec une base de données.
            //
            // Dans la première partie, j'indique :
            // - le type de base de données : mysql
            // - le serveur : host
            // - le nom de la base : dbname
            // - l'encodage : utf8mb4
            //
            // utf8mb4 permet de bien gérer les caractères spéciaux,
            // les accents et même certains symboles.
            self::$pdo = new PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
                $config['username'],
                $config['password']
            );

            // Ici, je configure PDO pour qu'il affiche des erreurs
            // sous forme d'exceptions.
            //
            // Cela permet de repérer plus facilement les problèmes
            // liés à la base de données, par exemple :
            // - une erreur SQL
            // - un mauvais mot de passe
            // - une table inexistante
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        // Si la connexion existe déjà, je ne la recrée pas.
        // Je retourne simplement la connexion PDO existante.
        //
        // Cela évite d'ouvrir plusieurs connexions inutiles
        // à la base de données.
        return self::$pdo;
    }
}