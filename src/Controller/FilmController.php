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
        // Récupère l'ID du film dans les paramètres de la requête
        $filmId = (int) $queryParams['id'];
    
        // Utilise le FilmRepository pour trouver le film par ID
        $film = $this->filmRepository->find($filmId);
    
        // Si le film existe, affiche ses détails, sinon redirige
        if ($film) {
            echo $this->renderer->render('film/read.html.twig', [
                'film' => $film
            ]);
        } else {
            // Redirige si le film n'existe pas
            header('Location: /films');
            exit;
        }
    }
    
    public function update(array $queryParams)
{
    // Vérifier que l'ID du film est présent
    if (!isset($queryParams['id'])) {
        die('ID du film manquant.');
    }

    $filmId = (int)$queryParams['id'];

    // Récupérer les informations du film depuis la base de données
    $filmRepository = new FilmRepository();
    $film = $filmRepository->find($filmId);

    // Si le film n'existe pas afficher une erreur 
    if (!$film) {
        die('Film introuvable.');
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $title = $_POST['title'] ?? '';
        $year = $_POST['year'] ?? '';
        $type = $_POST['type'] ?? '';
        $director = $_POST['director'] ?? '';
        $synopsis = $_POST['synopsis'] ?? '';

        // Mettre à jour l'objet Film avec les nouvelles données
        $film->setTitle($title);
        $film->setYear($year);
        $film->setType($type);
        $film->setDirector($director);
        $film->setSynopsis($synopsis);


        $film->setUpdatedAt(new \DateTime());


        $filmRepository->add($film);


        header('Location: /film/list');
        exit();
    }

    // Afficher le formulaire de mise à jour avec les données pré-remplies
    echo $this->renderer->render('film/update.html.twig', [
        'film' => $film,
    ]);
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
