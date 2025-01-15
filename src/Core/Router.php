<?php

declare(strict_types=1);

namespace App\Core;

use App\Controller\HomeController;

class Router
{
    public function route(): void
    {
        // Récupère l'URL demandée (sans le domaine et la racine)
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // Découpe l'URI pour obtenir la route et l'action
        $parts = explode('/', $uri); // Exemple : ['film', 'delete']

        $route = $parts[0] ?? null;   // 'film'
        $action = $parts[1] ?? null; // 'delete'

        $routes = [
            'film' => 'FilmController',
            'contact' => 'ContactController',
        ];

        if (array_key_exists($route, $routes)) {

            $controllerName = 'App\\Controller\\' . $routes[$route];

            if (!class_exists($controllerName)) {
                echo "Controller '$controllerName' not found";
                return;
            }

            $controller = new $controllerName();

            if ($route === 'film' && $action === 'delete') {
                $controller->delete($_GET);
                exit; 
            }

            if ($route === 'film' && $action === 'read') {
                $controller->read($_GET);
                exit;
            }

            if (method_exists($controller, $action)) {
                $queryParams = $_GET; 
                $controller->$action($queryParams); 
            } else {
                echo "Action '$action' not found in $controllerName";
            }

            if ($route === 'film' && $action === 'update') {
                $controller = new \App\Controller\FilmController();
                $controller->update($_GET);
                exit;
            }

        } else {
            // Si la route n'existe pas, affiche la page d'accueil
            $controller = new HomeController();
            $controller->index();
        }
    }
}
