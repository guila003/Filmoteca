<?php

declare(strict_types=1);

namespace App\Core;

use App\Controller\HomeController;

class Router
{
    public function route(): void
    {
        /**
         * echo '<pre>';
         * var_dump($_SERVER);
         * echo '</pre>';die;
         */

        // Récupère l'URL demandée (sans le domaine et la racine)
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // Découpe l'URI pour obtenir la route et l'action
        $parts = explode('/', $uri); // Exemple : ['films', 'create']

        $route = $parts[0] ?? null;   // 'films'
        $action = $parts[1] ?? null; // 'create'

        // Définit les routes et leurs contrôleurs associés
        $routes = [
            'film' => 'FilmController',
            'contact' => 'ContactController',
        ];

        if (array_key_exists($route, $routes)) {
            // Crée dynamiquement le contrôleur
            $controllerName = 'App\\Controller\\' . $routes[$route];

            if (!class_exists($controllerName)) {
                echo "Controller '$controllerName' not found";
                return;
            }

            $controller = new $controllerName();

            // Vérifie si la méthode existe dans le contrôleur
            if (method_exists($controller, $action)) {
                $queryParams = $_GET; // Récupère les paramètres éventuels
                $controller->$action($queryParams); // Appelle la méthode dynamique correspondant à l'action du contrôleur
            } else {
                echo "Action '$action' not found in $controllerName";
            }
        } else {
            // Si la route n'existe pas, affiche la page d'accueil
            $controller = new HomeController();
            $controller->index();
        }
    }
}