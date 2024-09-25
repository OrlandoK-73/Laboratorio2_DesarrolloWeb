<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/crud/conexion.php"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Prepara y ejecuta la consulta para insertar un nuevo cliente
    $stmt = $pdo->prepare("INSERT INTO Clientes (nombre, telefono, correo) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $telefono, $correo]);

    // Redirige después de guardar
    header('Location: ../../../Clientes.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cliente</title>
</head>
<body>
    <h1>Crear Nuevo Cliente</h1>
    <form action="guardar.php" method="post">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br>
        <label>Teléfono:</label><br>
        <input type="text" name="telefono"><br>
        <label>Correo:</label><br>
        <input type="email" name="correo"><br>
        <input type="submit" value="Crear">
    </form>
    <a href="listar.php">Volver a la lista</a>
</body>
</html>
