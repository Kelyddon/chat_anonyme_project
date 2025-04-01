<?php

declare(strict_types=1);

namespace App\services;

const DB_HOST = 'db.3wa.io';
const DB_PORT = '3306';
const DB_NAME = 'kelyddondiemunsch_chat';
const DB_USERNAME = 'kelyddondiemunsch';
const DB_PASSWORD = '5721e53e81737dcfcce9389af64949e4';

function getConnection(): \PDO{
    try {
        return new \PDO(
            'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME,
            DB_USERNAME,
            DB_PASSWORD,
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
        );
    } catch (\PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        exit();
    }
}
