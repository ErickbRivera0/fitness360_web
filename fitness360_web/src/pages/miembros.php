<?php
require_once __DIR__ . '/../includes/conexion.php';

// Obtener si el usuario es admin
$isAdmin = false;
if (isset($_SESSION['IDMiembro'])) {
    $idSesion = $_SESSION['IDMiembro'];
    $result = $mysqli->query("SELECT EsAdmin FROM Miembros WHERE IDMiembro = $idSesion");
    if ($row = $result->fetch_assoc()) {
        $isAdmin = $row['EsAdmin'] == 1;
    }
}

// Procesar modificación
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificar'])) {
    $id = $_POST['id_miembro'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $stmt = $mysqli->prepare("UPDATE Miembros SET NombreCompleto=?, CorreoElectronico=?, NumeroTelefono=? WHERE IDMiembro=?");
    $stmt->bind_param("sssi", $nombre, $correo, $telefono, $id);
    if ($stmt->execute()) {
        $mensaje = "¡Miembro modificado correctamente!";
    } else {
        $mensaje = "Error al modificar: " . $mysqli->error;
    }
    $stmt->close();
}

// Procesar cambio de contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cambiar_contrasena'])) {
    $id = $_POST['id_miembro_pass'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    if ($id && $nueva_contrasena) {
        $hash = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("UPDATE Miembros SET Password=? WHERE IDMiembro=?");
        $stmt->bind_param("si", $hash, $id);
        if ($stmt->execute()) {
            $mensaje = "¡Contraseña cambiada correctamente!";
        } else {
            $mensaje = "Error al cambiar la contraseña: " . $mysqli->error;
        }
        $stmt->close();
    }
}

// Procesar cambio de admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cambiar_admin'])) {
    $id = intval($_POST['id_miembro']);
    $esAdmin = intval($_POST['es_admin']);
    $stmt = $mysqli->prepare("UPDATE Miembros SET EsAdmin=? WHERE IDMiembro=?");
    $stmt->bind_param("ii", $esAdmin, $id);
    if ($stmt->execute()) {
        echo $esAdmin ? "Usuario ahora es administrador." : "Usuario ahora es usuario normal.";
    } else {
        echo "Error al cambiar privilegio: " . $mysqli->error;
    }
    $stmt->close();
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
    .miembros-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
    }
    .miembros-table th, .miembros-table td {
        border: 1px solid #ddd;
        padding: 12px 8px;
        font-weight: bold;
        color: #222;
        background: #fff;
    }
    .miembros-table th {
        background: #f5f5f5;
        color: #222;
    }
    .miembros-table tr:hover {
        background-color: #e9ecef;
    }
    .form-modificar {
        margin-bottom: 24px;
        background: #f9f9f9;
        padding: 16px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        width: 400px;
    }
    </style>
    <script>
    function cargarMiembro(id, nombre, correo, telefono) {
        document.getElementById('id_miembro').value = id;
        document.getElementById('nombre').value = nombre;
        document.getElementById('correo').value = correo;
        document.getElementById('telefono').value = telefono;
        document.getElementById('id_miembro_pass').value = id; // Para el formulario de contraseña
    }

    function cambiarAdmin(id, esAdmin) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if(xhr.readyState === 4 && xhr.status === 200){
                alert(xhr.responseText);
            }
        };
        xhr.send("cambiar_admin=1&id_miembro=" + id + "&es_admin=" + (esAdmin ? 1 : 0));
    }
    </script>
</head>
<body>

<?php if ($mensaje) echo "<div class='mensaje'>$mensaje</div>"; ?>

<h2>Miembros</h2>
<table class="miembros-table">
    <thead>
        <tr>
            <th>Nombre Completo</th>
            <th>Correo Electrónico</th>
            <th>Número Teléfono</th>
            <th>Admin</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $data = obtenerMiembros();
        foreach ($data as $row) {
            $checked = $row['EsAdmin'] == 1 ? 'checked' : '';
            echo "<tr style='cursor:pointer;' onclick=\"cargarMiembro('{$row['IDMiembro']}', '{$row['NombreCompleto']}', '{$row['CorreoElectronico']}', '{$row['NumeroTelefono']}')\">
                    <td>{$row['NombreCompleto']}</td>
                    <td>{$row['CorreoElectronico']}</td>
                    <td>{$row['NumeroTelefono']}</td>
                    <td>
                        <input type='checkbox' ".($isAdmin ? "" : "disabled")." onclick=\"event.stopPropagation(); cambiarAdmin({$row['IDMiembro']}, this.checked)\" $checked>
                    </td>
                  </tr>";
        }
        ?>
    </tbody>
</table>

<!-- Formulario de modificar miembro y cambiar contraseña juntos -->
<h2 style="text-align:center; color:#111;">Modificar Miembro y Cambiar Contraseña</h2>
<form method="POST" class="form-modificar" style="margin: 0 auto; display: flex; flex-direction: column; align-items: center; color: #111;">
    <input type="hidden" name="id_miembro" id="id_miembro">
    <input type="hidden" name="id_miembro_pass" id="id_miembro_pass">
    <label for="nombre" style="color:#111; width:100%;">Nombre Completo:</label>
    <input type="text" name="nombre" id="nombre" required style="color:#111;" <?php echo $isAdmin ? '' : 'disabled'; ?>>
    <label for="correo" style="color:#111; width:100%;">Correo Electrónico:</label>
    <input type="email" name="correo" id="correo" required style="color:#111;" <?php echo $isAdmin ? '' : 'disabled'; ?>>
    <label for="telefono" style="color:#111; width:100%;">Número Teléfono:</label>
    <input type="text" name="telefono" id="telefono" required style="color:#111;" <?php echo $isAdmin ? '' : 'disabled'; ?>>
    <label for="nueva_contrasena" style="color:#111; width:100%; margin-top:16px;">Nueva Contraseña:</label>
    <input type="password" name="nueva_contrasena" id="nueva_contrasena" style="color:#111;" <?php echo $isAdmin ? '' : 'disabled'; ?>>
    <div style="display:flex; gap:10px; margin-top:16px;">
        <button type="submit" name="modificar" style="background:#007bff; color:#fff; border:none; border-radius:4px; padding:10px 20px; cursor:pointer;" <?php echo $isAdmin ? '' : 'disabled'; ?>>
            Modificar Miembro
        </button>
        <button type="submit" name="cambiar_contrasena" style="background:#007bff; color:#fff; border:none; border-radius:4px; padding:10px 20px; cursor:pointer;" <?php echo $isAdmin ? '' : 'disabled'; ?>>
            Cambiar Contraseña
        </button>
    </div>
</form>

</body>
</html>