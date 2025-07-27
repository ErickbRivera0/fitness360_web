<?php
// Conexión a la base de datos (Railway)
$host = 'tramway.proxy.rlwy.net';
$port = 41615;
$db   = 'fitness360';
$user = 'root';
$pass = 'pzrbJzPSKtWnwWVdNEGyCKKGSqlYhMvR';
$charset = 'utf8mb4';

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serie = $_POST["serie"];
    $estado = $_POST["estado"];
    $descripcion = $_POST["descripcion"];
    $caracteristicas = $_POST["caracteristicas"];

    $sql = "INSERT INTO Maquinaria (serie, estado, descripcion, caracteristicas) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $serie, $estado, $descripcion, $caracteristicas);

    if ($stmt->execute()) {
        $mensaje = "¡Maquinaria registrada correctamente!";
    } else {
        $mensaje = "Error al registrar: " . $conn->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Maquinaria</title>
    <style>
        form {
            max-width: 400px;
            margin: 32px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 24px;
        }
        label {
            display: block;
            margin-top: 12px;
            color: #111;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 18px;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .mensaje {
            text-align: center;
            margin-bottom: 16px;
            color: green;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Agregar Maquinaria</h2>
    <?php if ($mensaje) echo "<div class='mensaje'>$mensaje</div>"; ?>
    <form method="POST" action="">
        <label for="serie">Serie de la máquina:</label>
        <input type="text" name="serie" id="serie" required>

        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="">Seleccione...</option>
            <option value="Nueva">Nueva</option>
            <option value="Usada">Usada</option>
        </select>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" rows="2" required></textarea>

        <label for="caracteristicas">Características:</label>
        <textarea name="caracteristicas" id="caracteristicas" rows="3"></textarea>

        <button type="submit">Agregar Maquinaria</button>
    </form>
</body>
</html>