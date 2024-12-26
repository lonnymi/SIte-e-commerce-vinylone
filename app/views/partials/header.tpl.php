<!DOCTYPE html>
<html lang="fr">
<?php
    $baseRoute = $_SERVER['BASE_URI'] ?? '/';
?>
<head>
    <meta charset="UTF-8">
    <title>Vinyl Collector</title>
    <link rel="stylesheet" href="/final_mvc/public/assets/css/styles.css">

</head>

<body>
    <header class="site-header">
        <div class="container">
            <div class="logo">
                <a href="/">
                    <h1>Vinyl Collector</h1>
                    <p>Le son qui fait vibrer</p>
                </a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="/">Accueil</a></li>
                    <li><a href="/categories">Catégories</a></li>
                    <li><a href="/types">Types de produits</a></li>
                    <li><a href="/brands">Marques</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="site-main">
