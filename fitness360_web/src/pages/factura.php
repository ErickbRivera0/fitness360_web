<?php
include('../includes/conexion.php');
include('../includes/header.php');

// Supongamos que pasas el ID de la factura por GET
$id_factura = isset($_GET['id']) ? $_GET['id'] : 0;

$query = "SELECT f.id_factura, f.fecha, c.nombre, c.correo, s.nombre_servicio, s.precio
          FROM facturas f
          JOIN clientes c ON f.id_cliente = c.id_cliente
          JOIN servicios s ON f.id_servicio = s.id_servicio
          WHERE f.id_factura = $id_factura";

$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
?>
    <div style="width: 80%; margin: auto; padding: 20px;">
        <h2>Factura #<?php echo $row['id_factura']; ?></h2>
        <p><strong>Fecha:</strong> <?php echo $row['fecha']; ?></p>
        <p><strong>Cliente:</strong> <?php echo $row['nombre']; ?> (<?php echo $row['correo']; ?>)</p>
        <hr>
        <p><strong>Servicio:</strong> <?php echo $row['nombre_servicio']; ?></p>
        <p><strong>Precio:</strong> L. <?php echo number_format($row['precio'], 2); ?></p>
        <hr>
        <h3>Total: L. <?php echo number_format($row['precio'], 2); ?></h3>
    </div>
<?php
} else {
    echo "<p>No se encontró la factura.</p>";
}

include('../includes/footer.php');
?>
