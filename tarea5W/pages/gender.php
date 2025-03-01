<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Predicción de Género</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, pink 50%, lightblue 50%);
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Predicción de Género🎭</h2>
        <form method="GET" action="/pages/gender.php">
            <div class="mb-3">
                <label for="name" class="form-label">Introduce un nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Predecir</button>
        </form>
        <form method="GET" action="/index.php">
            <button type="submit" class="btn btn-secondary mt-2">Volver al inicio</button>
        </form>
    </div>

    <?php
    if (isset($_GET['name'])) {
        $name = htmlspecialchars($_GET['name']);
        $api_url = "https://api.genderize.io/?name=" . urlencode($name);

        // Agregar manejo de errores
        $response = @file_get_contents($api_url);
        if ($response === FALSE) {
            echo "<div class='container mt-4'><div class='alert alert-danger' role='alert'><h3>Error al conectar con la API.</h3></div></div>";
        } else {
            $data = json_decode($response, true);
            
            if (isset($data['gender'])) {
                $gender = $data['gender'] == 'male' ? 'Masculino 🤴 💙' : 'Femenino 👸💖';
                echo "<div class='container mt-4'><div class='alert alert-success' role='alert'><h3>Resultado: $gender</h3></div></div>";
            } else {
                echo "<div class='container mt-4'><div class='alert alert-warning' role='alert'><h3>No se pudo determinar el género.</h3></div></div>";
            }
        }
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
