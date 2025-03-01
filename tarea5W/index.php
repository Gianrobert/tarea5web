<?php
// config.php - Archivo de configuración
$site_name = "Portal de APIs";
?>

<!-- index.php - Página principal -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $site_name; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef;
        }
        .navbar-brand {
            font-size: 1.75rem;
            font-weight: bold;
            color: #ffffff !important;
        }
        .nav-link {
            font-size: 1.2rem;
            color: #ffffff !important;
        }
        .container h1 {
            margin-top: 2rem;
            font-size: 3rem;
            color: #495057;
        }
        .container p {
            font-size: 1.25rem;
            color: #6c757d;
        }
        .navbar {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php"><?php echo $site_name; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="pages/gender.php">Predicción de Género</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/age.php">Predicción de Edad</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/universities.php">Universidades</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/weather.php">Clima</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/pokemon.php">Pokémon</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/news.php">Noticias</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/currency.php">Conversión de Monedas</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/images.php">Imágenes con IA</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/country.php">Datos de País</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/jokes.php">Generador de Chistes</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5 text-center">
        <h1>Bienvenido al <?php echo $site_name; ?></h1>
        <p>Selecciona una API del menú para interactuar.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
