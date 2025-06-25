<?php

if (!isset($_SESSION['IDMiembro'])) {
    header("Location: index.php?page=login");
    exit;
}
require_once __DIR__ . '/../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idMiembro = $_SESSION['IDMiembro'];
    $idClase = $_POST['id_clase'];
    $stmt = $mysqli->prepare("INSERT INTO Reserva (IDMiembro, IDClase, FechaHoraReserva) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $idMiembro, $idClase);
    $stmt->execute();
    echo "<p class='success'>¡Clase reservada!</p>";
}

// Mostrar clases disponibles
$result = $mysqli->query("SELECT IDClase, NombreClase, Horario FROM Clases");
?>

<style>
.reserva-container {
    max-width: 600px;
    margin: 30px auto;
    background:rgb(30, 32, 34);
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgb(5, 5, 5);
    font-family: Arial, sans-serif;
}
.reserva-container h2 {
    text-align: center;
    color: #333;
    margin-bottom: 24px;
}
.reserva-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 18px;
}
.reserva-table th, .reserva-table td {
    padding: 10px 8px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}
.reserva-table th {
    background: #007bff;
    color: #fff;
}
.reserva-table tr:hover {
    background:rgb(0, 0, 0);
}
.reserva-select {
    width: 100%;
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
    margin-bottom: 16px;
}
.reserva-btn {
    background: #007bff;
    color: #fff;
    border: none;
    padding: 10px 22px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.2s;
}
.reserva-btn:hover {
    background: #0056b3;
}
.success {
    color: #28a745;
    text-align: center;
    font-weight: bold;
    margin-bottom: 18px;
}
</style>

<div class="reserva-container">
    <h2>Reservar Clase</h2>
    <form method="post">
        <label for="id_clase"><b>Selecciona una clase:</b></label>
        <select class="reserva-select" name="id_clase" id="id_clase" required>
            <option value="" disabled selected>Elige una clase...</option>
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?= $row['IDClase'] ?>">
                    <?= htmlspecialchars($row['NombreClase']) ?> - <?= htmlspecialchars($row['Horario']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button class="reserva-btn" type="submit">Reservar</button>
    </form>
</div>