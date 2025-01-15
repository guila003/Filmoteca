<?php

declare(strict_types=1);

namespace App\Core;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class TemplateRenderer
{
    private Environment $twig;

    public function __construct()
    {
        // Configure le dossier des templates Twig
        $loader = new FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new Environment($loader, [
            'cache' => __DIR__ . '/../../var/cache/twig', // Active le cache de Twig
            'debug' => true, // Activer le mode debug si nécessaire
        ]);
        $this->twig->addExtension(new DebugExtension());
    }

    public function render(string $template, array $data = []): string
    {
        return $this->twig->render($template, $data);
    }

    public function getTwig(): Environment
    {
        return $this->twig;
    }
}
