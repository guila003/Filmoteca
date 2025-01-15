<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\TemplateRenderer;

class HomeController
{
    private TemplateRenderer $renderer;

    public function __construct()
    {
        // Initialise le moteur de template Twig
        $this->renderer = new TemplateRenderer();
    }

    // Méthode pour afficher la page d'accueil
    public function index()
    {
        // Rendre la vue homepage.html.twig
        echo $this->renderer->render('homepage.html.twig');
    }
}
