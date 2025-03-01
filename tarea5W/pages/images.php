<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generación de Imágenes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Imágenes</h2>
        <form method="GET" action="/pages/images.php">
            <div>
                <label for="query">Introduce un término de búsqueda:</label>
                <input type="text" id="query" name="query" required>
            </div>
            <button type="submit">Buscar</button>
        </form>
        <form method="GET" action="/index.php">
            <button type="submit">Volver al inicio</button>
        </form>

        <?php
        if (isset($_GET['query'])) {
            $query = htmlspecialchars($_GET['query']);
            $api_url = "https://api.openai.com/v1/images/generations";
            
            // Reemplaza 'YOUR_API_KEY' con tu clave real de OpenAI
            $api_key = 'YOUR_API_KEY';
            
            // Datos para enviar a la API de OpenAI
            $data = json_encode([
                'prompt' => $query,
                'n' => 1,  // Número de imágenes a generar
                'size' => '1024x1024',  // Tamaño de la imagen
            ]);
            
            // Inicializar cURL
            $ch = curl_init();
            
            // Configurar cURL para la solicitud POST
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $api_key
            ]);
            
            // Ejecutar la solicitud y obtener la respuesta
            $response = curl_exec($ch);
            
            // Comprobar si hubo un error en la solicitud
            if ($response === FALSE) {
                echo "<div class='error'><h3>Error al conectar con la API.</h3></div>";
            } else {
                $data = json_decode($response, true);
                
                if (isset($data['data']) && count($data['data']) > 0) {
                    echo "<div><h3>Resultado de la generación de la imagen:</h3></div>";
                    echo "<ul class='result'>";
                    foreach ($data['data'] as $image) {
                        echo "<li><img src='{$image['url']}' alt='Imagen generada'></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<div class='error'><h3>No se encontraron imágenes para '$query'.</h3></div>";
                }
            }
            
            // Cerrar la conexión cURL
            curl_close($ch);
        }
        ?>
    </div>
</body>
</html>



