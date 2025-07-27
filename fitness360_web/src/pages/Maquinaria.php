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

// Procesar el formulario de inventario
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Insertar nuevo inventario
    if (isset($_POST['agregar'])) {
        $nombre = trim($_POST["nombre"]);
        $tipo = trim($_POST["tipo"]);
        $marca = trim($_POST["marca"]);
        $serie = trim($_POST["serie"]);
        $observaciones = trim($_POST["observaciones"]);
        $fecha = trim($_POST["fecha"]);

        // Validar que todos los campos estén llenos
        if ($nombre === "" || $tipo === "" || $marca === "" || $serie === "" || $observaciones === "" || $fecha === "") {
            $mensaje = "Todos los campos son obligatorios para ingresar inventario.";
        } else {
            $sql = "INSERT INTO Inventario (Nombre, Tipo, Marca, Serie, Observaciones, FechaIngreso) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $nombre, $tipo, $marca, $serie, $observaciones, $fecha);

            if ($stmt->execute()) {
                $mensaje = "¡Inventario registrado correctamente!";
                // Vaciar los campos del formulario después de agregar
                $nombre = $tipo = $marca = $serie = $observaciones = $fecha = "";
                unset($id_inventario);
            } else {
                $mensaje = "Error al registrar: " . $conn->error;
            }
            $stmt->close();
        }
    }

    // Modificar inventario existente
    if (isset($_POST['modificar'])) {
        $id_inventario = $_POST['id_inventario'];
        $nombre = $_POST["nombre"];
        $tipo = $_POST["tipo"];
        $marca = $_POST["marca"];
        $serie = $_POST["serie"];
        $observaciones = $_POST["observaciones"];
        $fecha = $_POST["fecha"];

        $sql = "UPDATE Inventario SET Nombre=?, Tipo=?, Marca=?, Serie=?, Observaciones=?, FechaIngreso=? WHERE IDInventario=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nombre, $tipo, $marca, $serie, $observaciones, $fecha, $id_inventario);

        if ($stmt->execute()) {
            $mensaje = "¡Inventario modificado correctamente!";
        } else {
            $mensaje = "Error al modificar: " . $conn->error;
        }
        $stmt->close();
    }

    // Eliminar inventario
    if (isset($_POST['eliminar'])) {
        $id_inventario = $_POST['id_inventario'];

        $sql = "DELETE FROM Inventario WHERE IDInventario=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_inventario);

        if ($stmt->execute()) {
            $mensaje = "¡Inventario eliminado correctamente!";
        } else {
            $mensaje = "Error al eliminar: " . $conn->error;
        }
        $stmt->close();
    }
}

// Procesar el formulario de mantenimiento
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_mantenimiento'])) {
    $id_inventario_m = $_POST["id_inventario_m"];
    $fecha_m = $_POST["fecha_m"];
    $descripcion_m = $_POST["descripcion_m"];

    $sql = "INSERT INTO Mantenimiento (IDInventario, Fecha, Descripcion) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id_inventario_m, $fecha_m, $descripcion_m);

    if ($stmt->execute()) {
        $mensaje = "¡Mantenimiento registrado correctamente!";
    } else {
        $mensaje = "Error al registrar mantenimiento: " . $conn->error;
    }
    $stmt->close();
}

// Obtener la lista de inventario
$sql_inventario = "SELECT IDInventario, Nombre, Tipo, Marca, Serie, Observaciones, FechaIngreso FROM Inventario";
$result_inventario = $conn->query($sql_inventario);

// Obtener la lista de mantenimiento
$sql_mantenimiento = "SELECT M.IDMantenimiento, M.IDInventario, I.Nombre, I.Marca, M.Fecha, M.Descripcion 
                      FROM Mantenimiento M 
                      JOIN Inventario I ON M.IDInventario = I.IDInventario
                      ORDER BY M.Fecha DESC";
$result_mantenimiento = $conn->query($sql_mantenimiento);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Inventario y Mantenimiento</title>
    <style>
        .container {
            display: flex;
        }
        .form-container {
            width: 40%;
            margin: 32px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 24px;
        }
        .table-container {
            width: 60%;
            margin: 32px;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }
        .inventario-table, .mantenimiento-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        .inventario-table th, .inventario-table td,
        .mantenimiento-table th, .mantenimiento-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            color: #000;
        }
        .inventario-table th, .mantenimiento-table th {
            background-color: #f2f2f2;
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
    <h2 style="text-align:center;">Administrar Inventario y Mantenimiento</h2>
    <div class="container">
        <div class="form-container">
            <?php if ($mensaje) echo "<div class='mensaje'>$mensaje</div>"; ?>
            <form method="POST" action="">
                <input type="hidden" name="id_inventario" id="id_inventario" value="<?php echo isset($id_inventario) ? htmlspecialchars($id_inventario) : ''; ?>">

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : ''; ?>">

                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo" required>
                    <option value="">Seleccione...</option>
                    <option value="Maquina" <?php echo (isset($tipo) && $tipo == 'Maquina') ? 'selected' : ''; ?>>Maquina</option>
                    <option value="Pesa" <?php echo (isset($tipo) && $tipo == 'Pesa') ? 'selected' : ''; ?>>Pesa</option>
                    <option value="Mancuerna" <?php echo (isset($tipo) && $tipo == 'Mancuerna') ? 'selected' : ''; ?>>Mancuerna</option>
                </select>

                <label for="marca">Marca:</label>
                <input type="text" name="marca" id="marca" required value="<?php echo isset($marca) ? htmlspecialchars($marca) : ''; ?>">

                <label for="serie">Serie:</label>
                <input type="text" name="serie" id="serie" required value="<?php echo isset($serie) ? htmlspecialchars($serie) : ''; ?>">

                <label for="observaciones">Observaciones:</label>
                <textarea name="observaciones" id="observaciones" rows="3" required><?php echo isset($observaciones) ? htmlspecialchars($observaciones) : ''; ?></textarea>

                <label for="fecha">Fecha de ingreso:</label>
                <input type="date" name="fecha" id="fecha" required value="<?php echo isset($fecha) ? htmlspecialchars($fecha) : ''; ?>">

                <button type="submit" name="agregar">Agregar Inventario</button>
                <button type="submit" name="modificar">Modificar Inventario</button>
                <button type="submit" name="eliminar">Eliminar Inventario</button>
            </form>
            <hr>
            <form method="POST" action="">
                <label for="id_inventario_m">Inventario para mantenimiento:</label>
                <select name="id_inventario_m" id="id_inventario_m" required>
                    <option value="">Seleccione...</option>
                    <?php
                    $inv = $conn->query("SELECT IDInventario, Nombre, Marca FROM Inventario");
                    while($row = $inv->fetch_assoc()) {
                        echo "<option value='".$row["IDInventario"]."'>".$row["Nombre"]." - ".$row["Marca"]."</option>";
                    }
                    ?>
                </select>
                <label for="fecha_m">Fecha de mantenimiento:</label>
                <input type="date" name="fecha_m" id="fecha_m" required>
                <label for="descripcion_m">Descripción del mantenimiento:</label>
                <textarea name="descripcion_m" id="descripcion_m" rows="2" required></textarea>
                <button type="submit" name="agregar_mantenimiento">Agregar Mantenimiento</button>
            </form>
        </div>
        <div class="table-container">
            <h3>Inventario Registrado</h3>
            <table class="inventario-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Serie</th>
                        <th>Observaciones</th>
                        <th>Fecha Ingreso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_inventario->num_rows > 0) {
                        while($row = $result_inventario->fetch_assoc()) {
                            echo "<tr onclick=\"seleccionarInventario(".
                                $row["IDInventario"].",'".
                                htmlspecialchars($row["Nombre"], ENT_QUOTES)."','".
                                htmlspecialchars($row["Tipo"], ENT_QUOTES)."','".
                                htmlspecialchars($row["Marca"], ENT_QUOTES)."','".
                                htmlspecialchars($row["Serie"], ENT_QUOTES)."','".
                                htmlspecialchars($row["Observaciones"], ENT_QUOTES)."','".
                                htmlspecialchars($row["FechaIngreso"], ENT_QUOTES).
                                "')\">";
                            echo "<td>".$row["IDInventario"]."</td>";
                            echo "<td>".$row["Nombre"]."</td>";
                            echo "<td>".$row["Tipo"]."</td>";
                            echo "<td>".$row["Marca"]."</td>";
                            echo "<td>".$row["Serie"]."</td>";
                            echo "<td>".$row["Observaciones"]."</td>";
                            echo "<td>".$row["FechaIngreso"]."</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No se ha registrado inventario.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <h3>Mantenimientos Registrados</h3>
            <table class="mantenimiento-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Inventario</th>
                        <th>Marca</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_mantenimiento->num_rows > 0) {
                        while($row = $result_mantenimiento->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row["IDMantenimiento"]."</td>";
                            echo "<td>".$row["Nombre"]."</td>";
                            echo "<td>".$row["Marca"]."</td>";
                            echo "<td>".$row["Fecha"]."</td>";
                            echo "<td>".$row["Descripcion"]."</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No se ha registrado mantenimiento.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function seleccionarInventario(id, nombre, tipo, marca, serie, observaciones, fecha) {
            document.getElementById('id_inventario').value = id;
            document.getElementById('nombre').value = nombre;
            document.getElementById('tipo').value = tipo;
            document.getElementById('marca').value = marca;
            document.getElementById('serie').value = serie;
            document.getElementById('observaciones').value = observaciones;
            document.getElementById('fecha').value = fecha;
        }
    </script>
</body>
</html>