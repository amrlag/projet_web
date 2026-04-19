<?php

class Database {
    private static $pdo = null;

    public static function getConnection() {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../config/database.php';

            self::$pdo = new PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
                $config['username'],
                $config['password']
            );

            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }
}