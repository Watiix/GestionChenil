<?php
namespace Lucancstr\GestionChenil\views;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Les Amis Fidèles' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f2f2;
        }
        header {
            background-color: rgb(55, 118, 173);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand,
        .navbar-nav .nav-link {
            color: white;
            font-weight: 500;
        }
        .navbar-brand:hover,
        .navbar-nav .nav-link:hover {
            color: #dce9f7;
        }
        .content {
            margin: 20px auto;
            max-width: 1200px;
        }
        .logo-img {
            height: 40px;
            object-fit: contain;
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(55, 118, 173);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="/img/logo.png" alt="Logo Les Amis Fidèles" class="me-3 logo-img">
                Les Amis Fidèles
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/utilisateurs">Utilisateurs</a></li>
                    <li class="nav-item"><a class="nav-link" href="/reservations">Réservation</a></li>
                    <li class="nav-item"><a class="nav-link" href="/animaux">Animaux</a></li>
                    <li class="nav-item"><a class="nav-link" href="/calendrier">Calendrier</a></li>
                    <li class="nav-item"><a class="nav-link" href="/rapports">Rapports</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="content container">
    <?= $content ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
