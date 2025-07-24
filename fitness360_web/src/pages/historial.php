<?php
if (!isset($_SESSION['IDMiembro'])) {
    header("Location: index.php?page=login");
    exit;
}
require_once __DIR__ . '/../includes/conexion.php';

$idMiembro = $_SESSION['IDMiembro'];
$result = $mysqli->query("SELECT C.NombreClase, R.FechaHoraReserva FROM Reserva R JOIN Clases C ON R.IDClase = C.IDClase WHERE R.IDMiembro = $idMiembro ORDER BY R.FechaHoraReserva DESC");


echo "<style>
.historial-container {
    max-width: 800px;
    margin: 30px auto;
    background: #f8f9fa;
    padding: 32px 40px;
    border-radius: 14px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.10);
    font-family: Arial, sans-serif;
}
.historial-title {
    text-align: center;
    color: #007bff;
    margin-bottom: 28px;
    font-size: 2rem;
    letter-spacing: 1px;
}
.historial-table, .progreso-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    margin-bottom: 32px;
}
.historial-table th, .historial-table td,
.progreso-table th, .progreso-table td {
    border: 1px solid #e0e0e0;
    padding: 13px 10px;
    color: #222;
    font-size: 1rem;
}
.historial-table th, .progreso-table th {
    background: #007bff;
    color: #fff;
    font-weight: bold;
    letter-spacing: 0.5px;
}
.historial-table tr:nth-child(even), .progreso-table tr:nth-child(even) {
    background: #f4f8fb;
}
.historial-table tr:hover, .progreso-table tr:hover {
    background: #e9ecef;
}
.no-records {
    text-align: center;
    color: #888;
    margin: 20px 0 30px 0;
    font-size: 1.1rem;
}
</style>";

echo "<div class='historial-container'>";
echo "<div class='historial-title'>Historial de Asistencia</div>";

if ($result->num_rows > 0) {
    echo "<table class='historial-table'>";
    echo "<thead><tr><th>Clase</th><th>Fecha y Hora</th></tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['NombreClase']) . "</td>
                <td>" . date('d/m/Y H:i', strtotime($row['FechaHoraReserva'])) . "</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<div class='no-records'>No hay historial de asistencia.</div>";
}

// Progreso
echo "<div class='historial-title' style='margin-top:40px;'>Progreso</div>";
$progreso = $mysqli->query("SELECT TipoMetrica, Valor, FechaRegistroProgreso, Notas FROM Progreso WHERE IDMiembro = $idMiembro ORDER BY FechaRegistroProgreso DESC");

if ($progreso->num_rows > 0) {
    echo "<table class='progreso-table'>";
    echo "<thead><tr><th>Métrica</th><th>Valor</th><th>Fecha</th><th>Notas</th></tr></thead><tbody>";
    while ($row = $progreso->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['TipoMetrica']) . "</td>
                <td>" . htmlspecialchars($row['Valor']) . "</td>
                <td>" . date('d/m/Y', strtotime($row['FechaRegistroProgreso'])) . "</td>
                <td>" . htmlspecialchars($row['Notas']) . "</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<div class='no-records'>No hay registros de progreso.</div>";
}
echo "</div>";
?>