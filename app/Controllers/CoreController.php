<?php

namespace App\Controllers;

class CoreController
{
    protected function show(string $viewName, array $viewData = [])
    {
        extract($viewData);

        require_once __DIR__ . '/../Views/partials/header.tpl.php';
        require_once __DIR__ . '/../Views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../Views/partials/footer.tpl.php';
    }
}
