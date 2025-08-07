<?php

// Verifica si el ID de la factura está presente
if (isset($_GET['id_factura'])) {
    $idFactura = intval($_GET['id_factura']);

    // Obtener los datos de la factura, pago y miembro desde la base de datos..
    $stmt = $mysqli->prepare("
        SELECT 
            f.IDFactura, 
            f.NumeroFactura, 
            f.FechaEmision, 
            f.Total, 
            p.DescripcionPago, 
            p.Monto, 
            p.FechaPago, 
            p.MetodoPago, 
            p.EstadoPago, 
            p.IDTransaccion, 
            p.FechaInicioPeriodo, 
            p.FechaFinPeriodo, 
            m.NombreCompleto, 
            m.CorreoElectronico
        FROM Facturas f
        JOIN Pagos p ON f.IDPago = p.IDPago
        JOIN Miembros m ON p.IDMiembro = m.IDMiembro
        WHERE f.IDFactura = ?
    ");
    $stmt->bind_param("i", $idFactura);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si se encuentra la factura, obtenemos los datos
        $factura = $result->fetch_assoc();

        // Asignar variables para mostrar en la factura
        $nombreCompleto = $factura['NombreCompleto'] ?: 'No encontrado';
        $email = $factura['CorreoElectronico'] ?: 'No encontrado';
        $descripcionPago = $factura['DescripcionPago'] ?: 'No encontrado';
        $fechaPago = $factura['FechaPago'] ?: 'No encontrado';
        $metodoPago = $factura['MetodoPago'] ?: 'No encontrado';
        $estadoPago = $factura['EstadoPago'] ?: 'No encontrado';
        $idTransaccion = $factura['IDTransaccion'] ?: 'No encontrado';

        // Mostrar los datos de la factura (para ver el resultado rápidamente)
        //echo "Factura ID: " . $factura['IDFactura'] . "<br>";
        //echo "Número de factura: " . $factura['NumeroFactura'] . "<br>";
        //echo "Fecha de emisión: " . $factura['FechaEmision'] . "<br>";
        //echo "Total: " . $factura['Total'] . "<br>";
    } else {
        echo "Factura no encontrada.";
        exit;
    }

    $stmt->close();
} else {
    echo "No se ha proporcionado un ID de factura.";
    exit;
}

// HTML de la factura
$factura_html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura #' . htmlspecialchars($factura['NumeroFactura']) . '</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        .factura-card {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 1);
            padding: 40px;
        }
        .factura-titulo {
            text-align: center;
            color: #007bff;
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .factura-datos p {
            font-size: 1.1em;
            margin: 10px 0;
            color: #000;
        }
        .factura-datos p b {
            font-weight: bold;
            color: #000;
        }
        hr {
            margin: 20px 0;
            border: 1px solid #007bff;
        }
        .factura-footer {
            text-align: center;
            margin-top: 40px;
        }
        .factura-footer a {
            display: inline-block;
            padding: 12px 30px;
            background: #007bff;
            color: #fff;
            font-size: 1.2em;
            border-radius: 6px;
            text-decoration: none;
        }
        .factura-footer a:hover {
            background: #0056b3;
        }
        .factura-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #000;
        }
        .factura-header img {
            max-width: 150px;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="factura-card">
        <div class="factura-header">
            <img src="img/logop.png" alt="Logo">
            <div>
                <div><b>Factura #: ' . htmlspecialchars($factura['NumeroFactura']) . '</b></div>
                <div><b>Fecha de emisión:</b> ' . htmlspecialchars($factura['FechaEmision']) . '</div>
            </div>
        </div>
        <hr>
        <div class="factura-titulo">
            <p>Factura de pago</p>
        </div>
        <div class="factura-datos">
            <p><b>Nombre del cliente:</b> ' . $nombreCompleto . '</p>
            <p><b>Email:</b> ' . $email . '</p>
            <p><b>Descripción del pago:</b> ' . $descripcionPago . '</p>
            <p><b>Monto pagado:</b> $' . number_format($factura['Total'], 2) . '</p>
            <p><b>Fecha de pago:</b> ' . $fechaPago . '</p>
            <p><b>Método de pago:</b> ' . $metodoPago . '</p>
            <p><b>Estado del pago:</b> ' . $estadoPago . '</p>
            <p><b>ID de transacción:</b> ' . $idTransaccion . '</p>
        </div>
        <hr>
        <div class="factura-footer">
            <a href="index.php?page=factura&id_factura=' . urlencode($idFactura) . '&pdf=1">Descargar PDF</a>
        </div>
    </div>
</body>
</html>
';

// Si no es PDF, mostrar HTML
echo $factura_html;
?>