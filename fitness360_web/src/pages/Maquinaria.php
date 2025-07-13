<?php
require_once __DIR__ . '/../includes/conexion.php';
if (!isset($_SESSION['Rol']) || $_SESSION['Rol'] !== 'admin') {
    header("Location: index.php?page=home");
    exit;
}
?>
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
</style>

<h2>Miembros</h2>
<table class="miembros-table">
    <thead>
        <tr>
            <th>Nombre Completo</th>
            <th>Correo Electrónico</th>
            <th>Número Teléfono</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $data = obtenerMiembros();
        foreach ($data as $row) {
            echo "<tr>
                    <td>{$row['NombreCompleto']}</td>
                    <td>{$row['CorreoElectronico']}</td>
                    <td>{$row['NumeroTelefono']}</td>
                  </tr>";
        }
        ?>
    </tbody>
</table>