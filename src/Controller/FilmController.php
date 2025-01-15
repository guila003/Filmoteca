<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\TemplateRenderer;
use App\Entity\Film;
use App\Repository\FilmRepository;

class FilmController
{
    private TemplateRenderer $renderer;

    public function __construct()
    {
        $this->renderer = new TemplateRenderer();
    }

    public function list(array $queryParams)
    {
        $filmRepository = new FilmRepository();
        $films = $filmRepository->findAll();

        /* $filmEntities = [];
        foreach ($films as $film) {
            $filmEntity = new Film();
            $filmEntity->setId($film['id']);
            $filmEntity->setTitle($film['title']);
            $filmEntity->setYear($film['year']);
            $filmEntity->setType($film['type']);
            $filmEntity->setSynopsis($film['synopsis']);
            $filmEntity->setDirector($film['director']);
            $filmEntity->setCreatedAt(new \DateTime($film['created_at']));
            $filmEntity->setUpdatedAt(new \DateTime($film['updated_at']));

            $filmEntities[] = $filmEntity;
        } */

        //dd($films);

        echo $this->renderer->render('film/list.html.twig', [
            'films' => $films,
        ]);

        // header('Content-Type: application/json');
        // echo json_encode($films);
    }

    public function create()
    {
        echo "Création d'un film";
    }

    public function read(array $queryParams)
    {
        $filmRepository = new FilmRepository();
        $film = $filmRepository->find((int) $queryParams['id']);

        dd($film);
    }

    public function update()
    {
        echo "Mise à jour d'un film";
    }

    public function delete()
    {
        echo "Suppression d'un film";
    }
}
