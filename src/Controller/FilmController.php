<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\TemplateRenderer;
use App\Entity\Film;
use App\Repository\FilmRepository;
use App\Service\EntityMapper;

class FilmController
{
    private TemplateRenderer $renderer;
    private EntityMapper $entityMapper;
    private FilmRepository $filmRepository; // Ajoute la propriété filmRepository

    public function __construct()
    {
        $this->renderer = new TemplateRenderer();
        $this->entityMapper = new EntityMapper();
        $this->filmRepository = new FilmRepository(); // Initialise filmRepository ici
    }

    public function list(array $queryParams)
    {
        $films = $this->filmRepository->findAll();  // Utilise la propriété filmRepository pour récupérer les films

        echo $this->renderer->render('film/list.html.twig', [
            'films' => $films,
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $data = [
                'title' => $_POST['title'] ?? '',
                'year' => $_POST['year'] ?? '',
                'type' => $_POST['type'] ?? '',
                'director' => $_POST['director'] ?? '',
                'synopsis' => $_POST['synopsis'] ?? '',
                'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
                'updated_at' => (new \DateTime())->format('Y-m-d H:i:s')
            ];

            // Utilisation de l'EntityMapper pour créer un objet Film
            $film = $this->entityMapper->mapToEntity($data, Film::class);

            // Enregistrement du film dans la base de données
            $this->filmRepository->add($film);  // Utilise la méthode add dans FilmRepository pour insérer le film

            // Redirection vers la liste des films après ajout
            header('Location: /films');
            exit;
        }

        // Affichage du formulaire pour créer un film
        echo $this->renderer->render('film/create.html.twig');
    }

    public function read(array $queryParams)
    {
        $film = $this->filmRepository->find((int) $queryParams['id']); // Recherche du film par ID

        dd($film);  // Affiche les détails du film (ou envoie la réponse JSON, ou toute autre action)
    }

    public function update()
    {
        echo "Mise à jour d'un film";
    }

    public function delete(array $queryParams)
    {
        // Vérifie que l'ID du film est présent dans les paramètres de la requête
        if (isset($queryParams['id'])) {
            $id = (int)$queryParams['id'];
    
            // Récupérer le film par son ID
            $film = $this->filmRepository->find($id);
    
            if ($film) {
                
                $this->filmRepository->delete($film);  
    
                
                header('Location: /films/list.html.twig');
                exit;
            } else {
                
                echo "Film introuvable.";
            }
        }
    }
    
}
