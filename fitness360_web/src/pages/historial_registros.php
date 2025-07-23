<?php
require_once __DIR__ . '/../includes/conexion.php';

// Solo permitir acceso a usuarios logueados
if (!isset($_SESSION['IDMiembro'])) {
    header("Location: index.php?page=login");
    exit;
}

$idMiembro = $_SESSION['IDMiembro'];
$mensaje = "";

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $peso = $_POST['peso'];
    $cintura = $_POST['cintura'];
    $cadera = $_POST['cadera'];
    $pecho = $_POST['pecho'];
    $biceps = $_POST['biceps'];
    $notas = $_POST['notas'];

    $stmt = $mysqli->prepare("INSERT INTO Progreso (IDMiembro, TipoMetrica, Valor, FechaRegistroProgreso, Notas) VALUES 
        (?, 'Peso', ?, NOW(), ?),
        (?, 'Cintura', ?, NOW(), ?),
        (?, 'Cadera', ?, NOW(), ?),
        (?, 'Pecho', ?, NOW(), ?),
        (?, 'Bíceps', ?, NOW(), ?)");
    $stmt->bind_param(
        "idsidsidsidsids",
        $idMiembro, $peso, $notas,
        $idMiembro, $cintura, $notas,
        $idMiembro, $cadera, $notas,
        $idMiembro, $pecho, $notas,
        $idMiembro, $biceps, $notas
    );
    if ($stmt->execute()) {
        $mensaje = "<div class='success'>¡Progreso registrado correctamente!</div>";
    } else {
        $mensaje = "<div class='error'>Error al registrar el progreso.</div>";
    }
}

// Mostrar formulario y registros
echo "<style>
.progreso-form-container {
    max-width: 500px;
    margin: 30px auto;
    background: #f8f9fa;
    padding: 28px 36px;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    font-family: Arial, sans-serif;
}
.progreso-form-container h2 {
    text-align: center;
    color: #007bff;
    margin-bottom: 18px;
}
.progreso-form label {
    font-weight: bold;
    margin-top: 10px;
    display: block;
}
.progreso-form input, .progreso-form textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 14px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 1rem;
}
.progreso-form button {
    background: #007bff;
    color: #fff;
    border: none;
    padding: 10px 22px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
    transition: background 0.2s;
}
.progreso-form button:hover {
    background: #0056b3;
}
.success { color: #28a745; text-align: center; font-weight: bold; margin-bottom: 18px; }
.error { color: #c00; text-align: center; font-weight: bold; margin-bottom: 18px; }
label { color: #888; font-weight: bold; }
</style>";

echo "<div class='progreso-form-container'>";
echo "<h2>Agregar Progreso Corporal</h2>";
echo $mensaje;
?>
<form class="progreso-form" method="post">
    <label for="peso">Peso (kg):</label>
    <input type="number" step="0.01" name="peso" id="peso" required>

    <label for="cintura">Cintura (cm):</label>
    <input type="number" step="0.01" name="cintura" id="cintura" required>

    <label for="cadera">Cadera (cm):</label>
    <input type="number" step="0.01" name="cadera" id="cadera" required>

    <label for="pecho">Pecho (cm):</label>
    <input type="number" step="0.01" name="pecho" id="pecho" required>

    <label for="biceps">Bíceps (cm):</label>
    <input type="number" step="0.01" name="biceps" id="biceps" required>

    <label for="notas">Notas (opcional):</label>
    <textarea name="notas" id="notas" rows="2"></textarea>

    <button type="submit">Guardar progreso</button>
</form>
</div>

<ul>
