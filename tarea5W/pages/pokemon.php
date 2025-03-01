<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemons</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://th.bing.com/th/id/OIP.SfONx9yCjjYx6EgAIVR-PwHaEh?rs=1&pid=ImgDetMain');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #ffffff; /* Cambiar el color del texto a blanco */
        }
        .card {
            background-color: rgba(255, 255, 255, 0.8);
            color: #000000; /* Cambiar el color del texto dentro de la tarjeta a negro */
        }
        .form-group label, .form-control, .btn {
            color: #000000; /* Cambiar el color del texto de los formularios y botones a negro */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Pokemons</h2>
        <form method="GET" action="/pages/pokemon.php" class="mb-3">
            <div class="form-group">
                <label for="name">Introduce un nombre de pokemon:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-2">Buscar</button>
            </div>
        </form>
        <form method="GET" action="/index.php" class="text-center">
            <button type="submit" class="btn btn-secondary">Volver al inicio</button>
        </form>
    </div>

    <?php
        if (isset($_GET['name'])) {
            $name = htmlspecialchars($_GET['name']);
            $api_url = "https://pokeapi.co/api/v2/pokemon/" . urlencode($name);

            // Agregar manejo de errores
            $response = @file_get_contents($api_url);
            if ($response === FALSE) {
                echo "<div class='alert alert-danger mt-4 text-center'><h3>Error al conectar con la API.</h3></div>";
            } else {
                $data = json_decode($response, true);
                
                if (isset($data['name'])) {
                    echo "<div class='d-flex justify-content-center mt-4'>";
                    echo "<div class='card' style='width: 18rem;'>";
                    echo "<img src='{$data['sprites']['front_default']}' class='card-img-top' alt='{$data['name']}'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>Nombre: {$data['name']}</h5>";
                    echo "<p class='card-text'>Peso: {$data['weight']}</p>";
                    echo "<p class='card-text'>Altura: {$data['height']}</p>";
                    echo "<p class='card-text'>Experiencia base: {$data['base_experience']}</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<div class='alert alert-warning mt-4 text-center'><h3>No se pudo obtener la información de $name.</h3></div>";
                }
            }
        }
    ?>
</body>
</html>