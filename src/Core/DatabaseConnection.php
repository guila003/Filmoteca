<?php

declare(strict_types=1);

namespace App\Core;

class DatabaseConnection
{
    private static ?\PDO $connection = null;

    private const DB_HOST = 'filmoteca_db'; // Name of the Docker container or the service id in the docker-compose.yml file
    private const DB_PORT = 3306;
    private const DB_NAME = 'filmoteca';
    private const DB_USER = 'filmoteca_user';
    private const DB_PASSWORD = 'filmoteca_password';

    /**
     * Get the PDO connection instance
     *
     * @return \PDO
     * @throws \PDOException
     */
    public static function getConnection(): \PDO
    {
        // Vérifie si la connexion n'a pas déjà été établie
        if (self::$connection === null) {
            try {
                // Crée le Data Source Name (DSN) pour la connexion à la base de données
                $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4', self::DB_HOST, self::DB_PORT, self::DB_NAME);

                // Initialise la connexion PDO avec le DSN, l'utilisateur et le mot de passe
                self::$connection = new \PDO($dsn, self::DB_USER, self::DB_PASSWORD);
                // Définit le mode d'erreur de PDO pour lancer des exceptions
                self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                // Définit le mode de récupération par défaut pour les résultats de requêtes
                self::$connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            } catch (\PDOException $exception) {
                // Lance une exception en cas d'erreur de connexion à la base de données
                throw new \PDOException('Database connection error: ' . $exception->getMessage());
            }
        }

        // Retourne l'instance de connexion PDO
        return self::$connection;
    }
}
