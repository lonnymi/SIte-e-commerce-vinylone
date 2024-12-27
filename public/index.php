<?php

// Charger le fichier autoload généré par Composer
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\MainController;
use App\Controllers\CatalogController;

// Obtenez l'URL demandée (supprimez les paramètres de requête)
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Fonction pour simplifier le routage
function route($path, $callback) {
    global $requestUri, $routeFound;
    if ($path === $requestUri) {
        $routeFound = true;
        call_user_func($callback);
    }
}

// Variable pour vérifier si une route correspond
$routeFound = false;

// Ajout des routes disponibles
route('/', function () {
    $controller = new MainController();
    $controller->home();
});

route('/categorie', function () {
    $controller = new CatalogController();
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;
    if ($id) {
        $controller->category(['id' => $id]);
    } else {
        echo "<h1>Erreur</h1><p>ID de catégorie manquant.</p>";
    }
});

route('/type', function () {
    $controller = new CatalogController();
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;
    if ($id) {
        $controller->type(['id' => $id]);
    } else {
        echo "<h1>Erreur</h1><p>ID de type manquant.</p>";
    }
});

route('/marque', function () {
    $controller = new CatalogController();
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;
    if ($id) {
        $controller->brand(['id' => $id]);
    } else {
        echo "<h1>Erreur</h1><p>ID de marque manquant.</p>";
    }
});

route('/contact', function () {
    echo "<h1>Page de contact</h1><p>Cette page est en cours d'implémentation.</p>";
});

route('/test', function () {
    echo "<h1>Test réussi !</h1>";
});

// Gestion des erreurs 404 si aucune route ne correspond
if (!$routeFound) {
    http_response_code(404);
    echo "<h1>404 - Page non trouvée</h1>";
    echo "<p>L'URL demandée est : " . htmlspecialchars($requestUri) . "</p>";
}
