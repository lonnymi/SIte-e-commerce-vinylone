<?php

// Charger le fichier autoload généré par Composer
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\MainController;

// Récupérer l'URL de la requête
$uri = $_SERVER['REQUEST_URI'] ?? '/';

// Routeur basique
switch ($uri) {
    case '/':
        $controller = new MainController();
        $controller->home();
        break;

    default:
        http_response_code(404);
        echo "404 - Page non trouvée";
        break;
}
