<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clima</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://th.bing.com/th/id/OIP.vcp5b8HlpT7cDPtMnbob4wHaD4?rs=1&pid=ImgDetMain');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Clima</h2>
        <form method="GET" action="/pages/weather.php" class="mb-3">
            <div class="form-group">
                <label for="city">Ciudad:</label>
                <input type="text" id="city" name="city" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
        <form method="GET" action="/index.php">
            <button type="submit" class="btn btn-secondary">Volver al inicio</button>
        </form>

        <?php
if (isset($_GET['city'])) {
    $city = htmlspecialchars($_GET['city']);

    // Obtener las coordenadas de la ciudad desde Nominatim (OpenStreetMap)
    $geo_url = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($city);
    $geo_response = @file_get_contents($geo_url);
    
    if ($geo_response === FALSE || empty($geo_response)) {
        echo "<div class='alert alert-danger mt-3'><h3>Error al obtener coordenadas de la ciudad.</h3></div>";
    } else {
        $geo_data = json_decode($geo_response, true);
        
        if (!empty($geo_data) && isset($geo_data[0]['lat']) && isset($geo_data[0]['lon'])) {
            $lat = $geo_data[0]['lat'];
            $lon = $geo_data[0]['lon'];

            // Obtener el clima desde Open-Meteo
            $weather_url = "https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&current_weather=true";
            $weather_response = @file_get_contents($weather_url);

            if ($weather_response === FALSE) {
                echo "<div class='alert alert-danger mt-3'><h3>Error al conectar con Open-Meteo.</h3></div>";
            } else {
                $weather_data = json_decode($weather_response, true);

                if (isset($weather_data['current_weather'])) {
                    $temp = $weather_data['current_weather']['temperature'];
                    $wind_speed = $weather_data['current_weather']['windspeed'];
                    
                    echo "<div class='alert alert-info mt-3'><h3>El clima en $city es de $temp °C con viento de $wind_speed km/h.</h3></div>";
                } else {
                    echo "<div class='alert alert-warning mt-3'><h3>No se pudo obtener el clima de $city.</h3></div>";
                }
            }
        } else {
            echo "<div class='alert alert-warning mt-3'><h3>No se encontraron coordenadas para $city.</h3></div>";
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
