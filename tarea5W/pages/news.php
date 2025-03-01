<div>
    <h2>Noticias</h2>
    <form method="GET" action="/pages/news.php">
        <div>
            <label for="query">Introduce una palabra clave:</label>
            <input type="text" id="query" name="query" required>
        </div>
        <button type="submit">Buscar</button>
    </form>
    <form method="GET" action="/index.php">
        <button type="submit">Volver al inicio</button>
    </form>
</div>

<?php

if (isset($_GET['query'])) {
    $query = htmlspecialchars($_GET['query']);
    $api_url = "https://newsapi.org/v2/everything?q=" . urlencode($query) . "&apiKey=YOUR_API_KEY";

    // Agregar manejo de errores
    $response = @file_get_contents($api_url);
    if ($response === FALSE) {
    echo "<div><h3>Error al conectar con la API.</h3></div>";
    } else {
        $data = json_decode($response, true);
        
        if (isset($data['articles'])) {
            echo "<div><h3>Resultados para $query:</h3></div>";
            echo "<ul>";
            foreach ($data['articles'] as $article) {
                echo "<li><a href='{$article['url']}' target='_blank'>{$article['title']}</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<div><h3>No se encontraron noticias para $query.</h3></div>";
        }
    }
}

?>
