<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Monedas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://th.bing.com/th/id/OIP.04OfN3miKAxRNjG83wTK_QHaHa?rs=1&pid=ImgDetMain');
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
    <h2 class="mb-4">Conversor de Monedas</h2>
    <form method="GET" action="/pages/currency.php" class="mb-4">
        <div class="form-group">
            <label for="amount">Cantidad:</label>
            <input type="number" id="amount" name="amount" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="from">De:</label>
            <select id="from" name="from" class="form-control" required>
                <option value="USD">Dólar Estadounidense</option>
                <option value="EUR">Euro</option>
                <option value="JPY">Yen Japonés</option>
                <option value="GBP">Libra Esterlina</option>
                <option value="DOP">Peso Dominicano</option>
            </select>
        </div>
        <div class="form-group">
            <label for="to">A:</label>
            <select id="to" name="to" class="form-control" required>
                <option value="USD">Dólar Estadounidense</option>
                <option value="EUR">Euro</option>
                <option value="JPY">Yen Japonés</option>
                <option value="GBP">Libra Esterlina</option>
                <option value="DOP">Peso Dominicano</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Convertir</button>
    </form>
    <form method="GET" action="/index.php">
        <button type="submit" class="btn btn-secondary">Volver al inicio</button>
    </form>

    <?php
    if (isset($_GET['amount']) && isset($_GET['from']) && isset($_GET['to'])) {
        $amount = htmlspecialchars($_GET['amount']);
        $from = htmlspecialchars($_GET['from']);
        $to = htmlspecialchars($_GET['to']);
        $api_url = "https://api.exchangerate-api.com/v4/latest/" . urlencode($from);

        // Agregar manejo de errores
        $response = @file_get_contents($api_url);
        if ($response === FALSE) {
            echo "<div class='alert alert-danger mt-4'><h3>Error al conectar con la API.</h3></div>";
        } else {
            $data = json_decode($response, true);
            
            if (isset($data['rates'][$to])) {
                $rate = $data['rates'][$to];
                $converted = $amount * $rate;
                echo "<div class='alert alert-success mt-4'><h3>$amount $from son $converted $to.</h3></div>";
            } else {
                echo "<div class='alert alert-warning mt-4'><h3>No se pudo obtener el tipo de cambio.</h3></div>";
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