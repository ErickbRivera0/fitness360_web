<?php
session_start();

$page = $_GET['page'] ?? 'login'; 
$public_pages = ['login', 'registro'];

if (!isset($_SESSION['IDMiembro']) && !in_array($page, $public_pages)) {
    header("Location: index.php?page=login");
    exit;
}

$allowed_pages = [
    'home', 'servicios', 'planes', 'contacto', 'maquinaria', 'miembros', 'registro', 'login',
    'reservar', 'historial', 'pagos', 'logout', 'admin_pagos', 'historial_registros'
];


if (!in_array($page, $public_pages)) {
    include 'includes/header.php';
}

if (in_array($page, $allowed_pages)) {
    include "pages/$page.php";
}


if (!in_array($page, $public_pages)) {
    include 'includes/footer.php';
}
?>
