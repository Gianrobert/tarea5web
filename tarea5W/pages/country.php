<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Países</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Api sobre paises</h2>
                <form method="GET" action="/pages/country.php" class="mb-3">
                    <div class="form-group">
                        <label for="country">País:</label>
                        <input type="text" id="country" name="country" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
                <form method="GET" action="/index.php">
                    <button type="submit" class="btn btn-secondary">Volver al inicio</button>
                </form>
            </div>
        </div>

        <?php
        if (isset($_GET['country'])) {
            $country = htmlspecialchars($_GET['country']);
            $api_url = "https://restcountries.com/v3.1/name/" . urlencode($country);

            $response = @file_get_contents($api_url);
            if ($response === FALSE) {
                echo "<div class='alert alert-danger mt-3'>Error al conectar con la API.</div>";
            } else {
                $data = json_decode($response, true);

                if (count($data) > 0) {
                    echo "<div class='card mt-3'>";
                    echo "<div class='card-body'>";
                    echo "<h3 class='card-title'>Bandera:</h3>";
                    echo "<img src='{$data[0]['flags']['png']}' alt='Bandera de {$data[0]['name']['common']}' class='img-fluid mb-3'>";

                    echo "<h3 class='card-title'>Información de {$data[0]['name']['common']}:</h3>";
                    echo "<p><strong>Nombre:</strong> {$data[0]['name']['common']}</p>";
                    echo "<p><strong>Capital:</strong> {$data[0]['capital'][0]}</p>";
                    echo "<p><strong>Población:</strong> {$data[0]['population']}</p>";
                    echo "<p><strong>Área:</strong> {$data[0]['area']} km²</p>";
                    echo "<p><strong>Región:</strong> {$data[0]['region']}</p>";
                    echo "<p><strong>Subregión:</strong> {$data[0]['subregion']}</p>";

                    echo "<h3 class='card-title'>Idiomas:</h3>";
                    echo "<ul class='list-group'>";
                    foreach ($data[0]['languages'] as $language) {
                        echo "<li class='list-group-item'>{$language}</li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<div class='alert alert-warning mt-3'>No se encontró información de $country.</div>";
                }
            }
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
