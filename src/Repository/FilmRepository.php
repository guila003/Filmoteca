<?php

declare(strict_types=1);

namespace App\Repository;

use App\Core\DatabaseConnection;
use App\Service\EntityMapper;
use App\Entity\Film;

class FilmRepository
{
    private \PDO $db; // Instance de connexion à la base de données
    private EntityMapper $entityMapperService; // Service pour mapper les entités

    public function __construct()
    {
        // Initialise la connexion à la base de données en utilisant DatabaseConnection
        $this->db = DatabaseConnection::getConnection();
        // Initialise le service de mappage des entités
        $this->entityMapperService = new EntityMapper();
    }

    // Méthode pour récupérer tous les films de la base de données
    public function findAll(): array
    {
        // Requête SQL pour sélectionner tous les films
        $query = 'SELECT * FROM film';
        // Exécute la requête et récupère le résultat
        $stmt = $this->db->query($query);

        // Récupère tous les films sous forme de tableau associatif
        $films = $stmt->fetchAll();

        // Utilise le service de mappage pour convertir les résultats en objets Film
        return $this->entityMapperService->mapToEntities($films, Film::class);
    }

    // Méthode pour récupérer un film par son identifiant
    public function find(int $id): Film
    {
        // Requête SQL pour sélectionner un film par son identifiant
        $query = 'SELECT * FROM film WHERE id = :id';
        // Prépare la requête pour éviter les injections SQL
        $stmt = $this->db->prepare($query);
        // Exécute la requête avec l'identifiant fourni
        $stmt->execute(['id' => $id]);

        // Récupère le film sous forme de tableau associatif
        $film = $stmt->fetch();

        // Utilise le service de mappage pour convertir le résultat en objet Film
        return $this->entityMapperService->mapToEntity($film, Film::class);
    }

    public function add(Film $film): void
    {
        if ($film->getId()) {
            // Mise à jour si l'ID existe
            $query = 'UPDATE film 
                      SET title = :title, year = :year, type = :type, director = :director, synopsis = :synopsis, updated_at = :updatedAt 
                      WHERE id = :id';
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                'title' => $film->getTitle(),
                'year' => $film->getYear(),
                'type' => $film->getType(),
                'director' => $film->getDirector(),
                'synopsis' => $film->getSynopsis(),
                'updatedAt' => $film->getUpdatedAt()->format('Y-m-d H:i:s'),
                'id' => $film->getId(),
            ]);
        } else {
            // Insertion si aucun ID
            $query = 'INSERT INTO film (title, year, type, director, synopsis, created_at, updated_at) 
                      VALUES (:title, :year, :type, :director, :synopsis, :createdAt, :updatedAt)';
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                'title' => $film->getTitle(),
                'year' => $film->getYear(),
                'type' => $film->getType(),
                'director' => $film->getDirector(),
                'synopsis' => $film->getSynopsis(),
                'createdAt' => $film->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $film->getUpdatedAt()->format('Y-m-d H:i:s'),
            ]);
        }
    }

    public function delete(Film $film): void
    {
        // On prépare la requête de suppression
        $stmt = $this->db->prepare('
            DELETE FROM film WHERE id = :id
        ');

        // Exécution de la requête
        $stmt->execute(['id' => $film->getId()]);
    }

   
}
