<?php
$host = 'switchback.proxy.rlwy.net';     // switchback.proxy.rlwy.net 
$port = 16032;
$db   = 'railway';
$user = 'root';
$pass = 'JWjKAeEeGIkWRYzAdOmEhPqkFnUoKsKn'; // pon aquí la contraseña real
$charset = 'utf8mb4';

// Crear conexión mysqli
$mysqli = new mysqli($host, $user, $pass, $db, $port);

// Verificar conexión
if ($mysqli->connect_errno) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Métodos CRUD para la tabla Miembros
// Crear un miembro
function crearMiembro($nombre, $correo, $telefono) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO Miembros (NombreCompleto, CorreoElectronico, NumeroTelefono) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $telefono);
    $stmt->execute();
    $stmt->close();
}

// Leer todos los miembros
function obtenerMiembros() {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM Miembros");
    $miembros = [];
    while ($row = $result->fetch_assoc()) {
        $miembros[] = $row;
    }
    return $miembros;
}

// Leer un miembro por ID
function obtenerMiembroPorId($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT * FROM Miembros WHERE IDMiembro = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $miembro = $result->fetch_assoc();
    $stmt->close();
    return $miembro;
}

// Actualizar un miembro
function actualizarMiembro($id, $nombre, $correo, $telefono) {
    global $mysqli;
    $stmt = $mysqli->prepare("UPDATE Miembros SET NombreCompleto = ?, CorreoElectronico = ?, NumeroTelefono = ? WHERE IDMiembro = ?");
    $stmt->bind_param("sssi", $nombre, $correo, $telefono, $id);
    $stmt->execute();
    $stmt->close();
}

// Eliminar un miembro
function eliminarMiembro($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM Miembros WHERE IDMiembro = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>
