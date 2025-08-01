<?php
$host = 'tramway.proxy.rlwy.net';
$port = 41615;
$db   = 'fitness360';
$user = 'root';
$pass = 'pzrbJzPSKtWnwWVdNEGyCKKGSqlYhMvR'; 
$charset = 'utf8mb4';


$mysqli = new mysqli($host, $user, $pass, $db, $port);


if ($mysqli->connect_errno) {
    die("Error de conexión: " . $mysqli->connect_error);
}

function crearMiembro($nombre, $correo, $telefono) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO Miembros (NombreCompleto, CorreoElectronico, NumeroTelefono) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $telefono);
    $stmt->execute();
    $stmt->close();
}


function obtenerMiembros() {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM Miembros");
    $miembros = [];
    while ($row = $result->fetch_assoc()) {
        $miembros[] = $row;
    }
    return $miembros;
}


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


function actualizarMiembro($id, $nombre, $correo, $telefono) {
    global $mysqli;
    $stmt = $mysqli->prepare("UPDATE Miembros SET NombreCompleto = ?, CorreoElectronico = ?, NumeroTelefono = ? WHERE IDMiembro = ?");
    $stmt->bind_param("sssi", $nombre, $correo, $telefono, $id);
    $stmt->execute();
    $stmt->close();
}


function eliminarMiembro($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM Miembros WHERE IDMiembro = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>
