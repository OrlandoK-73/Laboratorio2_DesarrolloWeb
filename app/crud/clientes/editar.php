<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/crud/conexion.php"); 

$cliente = null;
if (isset($_GET['Cod'])) {
    $codigo = $_GET['Cod'];

    // Consulta para obtener el cliente
    $stmt = $pdo->prepare("SELECT * FROM Clientes WHERE codigo = ?");
    $stmt->execute([$codigo]);
    $cliente = $stmt->fetch();

    // Si no se encuentra el cliente, redirige
    if (!$cliente) {
        header('Location: ../../../Clientes.php');
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $codigo = $_POST['codigo']; 
    $stmt = $pdo->prepare("UPDATE Clientes SET nombre = ?, telefono = ?, correo = ? WHERE codigo = ?");
    $stmt->execute([$nombre, $telefono, $correo, $codigo]);
    header('Location: ../../../Clientes.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>
    <?php if ($cliente): ?>
        <form action="editar.php" method="post">
            <input type="hidden" name="codigo" value="<?= htmlspecialchars($cliente['codigo']) ?>">
            <label>Nombre:</label><br>
            <input type="text" name="nombre" value="<?= htmlspecialchars($cliente['nombre']) ?>" required><br>
            <label>Teléfono:</label><br>
            <input type="text" name="telefono" value="<?= htmlspecialchars($cliente['telefono']) ?>"><br>
            <label>Correo:</label><br>
            <input type="email" name="correo" value="<?= htmlspecialchars($cliente['correo']) ?>"><br>
            <input type="submit" name="guardar" value="Guardar">
        </form>
    <?php else: ?>
        <p>Cliente no encontrado.</p>
    <?php endif; ?>
    <a href="http://localhost:8181/Clientes.php">Volver a la lista</a>
</body>
</html>
