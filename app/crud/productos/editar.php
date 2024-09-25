<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/crud/conexion.php"); 

if (isset($_GET['Cod'])) {
    $codigo = $_GET['Cod'];

    // Obtener el producto correspondiente
    $sql = "SELECT * FROM Producto WHERE codigo = :codigo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['codigo' => $codigo]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        die("Producto no encontrado.");
    }
} elseif (isset($_POST['guardar'])) {
    // Actualizar producto
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $observaciones = $_POST['observaciones'];

    $sql = "UPDATE Producto SET descripcion = :descripcion, precio = :precio, observaciones = :observaciones WHERE codigo = :codigo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'descripcion' => $descripcion,
        'precio' => $precio,
        'observaciones' => $observaciones,
        'codigo' => $codigo,
    ]);

    header('Location: Productos.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../../css/style.css"> <!-- Asegúrate de tener un CSS adecuado -->
</head>
<body>
    <h1>Editar Producto</h1>
    <form action="guardar.php" method="post"> <!-- Cambiado a guardar.php -->
        <input type="hidden" name="codigo" value="<?= htmlspecialchars($producto['codigo']) ?>">
        <label>Descripción:</label><br>
        <input type="text" name="descripcion" value="<?= htmlspecialchars($producto['descripcion']) ?>" required><br>
        <label>Precio:</label><br>
        <input type="number" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" step="0.01" required><br>
        <label>Observaciones:</label><br>
        <textarea name="observaciones"><?= htmlspecialchars($producto['observaciones']) ?></textarea><br>
        <input type="submit" name="guardar" value="Guardar">
    </form>
    <a href="http://localhost:8181/Productos.php">Volver a la lista</a>
</body>
</html>