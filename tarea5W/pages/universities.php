<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidades</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Buscar Universidades</h1>
            <form method="GET" action="/pages/universities.php" class="box">
                <div class="field">
                    <label class="label" for="country">País:</label>
                    <div class="control">
                        <input class="input" type="text" id="country" name="country" required>
                    </div>
                </div>
                <div class="control">
                    <button class="button is-primary" type="submit">Buscar</button>
                </div>
            </form>
            <form method="GET" action="/index.php">
                <div class="control">
                    <button class="button is-link" type="submit">Volver al inicio</button>
                </div>
            </form>
            <div class="content">
                <?php
                    if (isset($_GET['country'])) {
                        $country = htmlspecialchars($_GET['country']);
                        $api_url = "http://universities.hipolabs.com/search?country=" . urlencode($country);

                        // Agregar manejo de errores
                        $response = @file_get_contents($api_url);
                        if ($response === FALSE) {
                            echo "<div class='notification is-danger'><h3>Error al conectar con la API.</h3></div>";
                        } else {
                            $data = json_decode($response, true);
                            
                            if (count($data) > 0) {
                                echo "<div class='notification is-primary'><h3>Universidades en $country:</h3></div>";
                                echo "<ul>";
                                foreach ($data as $university) {
                                    echo "<li>{$university['name']}</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "<div class='notification is-warning'><h3>No se encontraron universidades en $country.</h3></div>";
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </section>
</body>
</html>