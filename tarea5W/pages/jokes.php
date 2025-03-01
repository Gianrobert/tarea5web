<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chistes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Chistes</h2>
    <div class="text-center mb-4">
        <form method="GET" action="/pages/jokes.php" class="d-inline">
            <button type="submit" class="btn btn-primary">Obtener chiste</button>
        </form>
        <form method="GET" action="/index.php" class="d-inline">
            <button type="submit" class="btn btn-secondary">Volver al inicio</button>
        </form>
    </div>

    <?php
        $api_url = "https://official-joke-api.appspot.com/jokes/random";
        $response = @file_get_contents($api_url);
        if ($response === FALSE) {
            echo "<div class='alert alert-danger mt-4 text-center'><h3>Error al conectar con la API.</h3></div>";
        } else {
            $data = json_decode($response, true);
            
            if (isset($data['setup'])) {
                $setup = $data['setup'];
                $punchline = $data['punchline'];

                // Traducir el chiste al español
                $translate_url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=es&dt=t&q=" . urlencode($setup);
                $translated_setup = json_decode(file_get_contents($translate_url), true)[0][0][0];

                $translate_url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=es&dt=t&q=" . urlencode($punchline);
                $translated_punchline = json_decode(file_get_contents($translate_url), true)[0][0][0];

                echo "<div class='card mt-4'>
                        <div class='card-body'>
                            <h5 class='card-title text-center'>{$translated_setup}</h5>
                            <p class='card-text text-center'>{$translated_punchline}</p>
                        </div>
                      </div>";
            } else {
                echo "<div class='alert alert-warning mt-4 text-center'><h3>No se pudo obtener el chiste.</h3></div>";
            }
        }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>