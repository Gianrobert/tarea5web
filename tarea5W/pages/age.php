<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Predicción de Edad</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://th.bing.com/th/id/OIP.fvGA451KCPL3D8CCMd3ekAHaD5?w=303&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
<div class="container mt-5 bg-white p-4 rounded">
    <h2 class="mb-4">Predicción de Edad</h2>
    <form method="GET" action="/pages/age.php" class="mb-3">
        <div class="form-group">
            <label for="name">Introduce un nombre:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Predecir</button>
    </form>
    <form method="GET" action="/index.php">
        <button type="submit" class="btn btn-secondary">Volver al inicio</button>
    </form>
</div>

<?php

if (isset($_GET['name'])) {
    $name = htmlspecialchars($_GET['name']);
    $api_url = "https://api.agify.io/?name=" . urlencode($name);

    // Agregar manejo de errores
    $response = @file_get_contents($api_url);
    if ($response === FALSE) {
        echo "<div class='container mt-3'><h3 class='text-danger'>Error al conectar con la API.</h3></div>";
    } else {
        $data = json_decode($response, true);
        
        if (isset($data['age'])) {
            echo "<div class='container mt-3'><h3>Resultado: {$data['age']} años</h3></div>";
        } else {
            echo "<div class='container mt-3'><h3>No se pudo determinar la edad.</h3></div>";
        }
    }
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>