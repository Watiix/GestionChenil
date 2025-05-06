    <?php
        namespace Lucancstr\GestionChenil\views;
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            header {
                background-color: #f8f9fa;
                padding: 15px 0;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
            header a {
                color: #343a40;
                transition: color 0.3s;
                text-decoration: none;
            }
            header a:hover {
                color: #007bff;
            }
            h1 {
                font-size: 1.5rem;
                font-weight: bold;
            }
            .content {
                margin: 20px auto;
                max-width: 1200px;
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/" class="h2 mb-0">Watix Corner</a>
                    <nav>
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/logout">Logout</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/profile">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin">Admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/gestion">Gestion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/panier">Panier</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <div class="content container">
            <?= $content ?>
        </div>  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
