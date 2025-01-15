<?php

declare(strict_types=1); // Déclare le mode strict pour les types de données

require __DIR__ . '/../vendor/autoload.php'; // Charge automatiquement les classes nécessaires via Composer

use App\Core\Router; // Utilise la classe Router du namespace App\Core

// FRONT-CONTROLLER
$router = new Router(); // Crée une nouvelle instance de la classe Router
$router->route(); // Appelle la méthode route() pour gérer les requêtes entrantes
