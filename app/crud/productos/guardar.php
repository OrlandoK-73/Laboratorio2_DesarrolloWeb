<?php
session_start(); // Iniciar la sesión
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/crud/conexion.php"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['codigo'])) {
    // Obtener los datos del formulario
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $observaciones = $_POST['observaciones'];

    // Actualizar producto en la base de datos
    $sql = "UPDATE Producto SET descripcion = :descripcion, precio = :precio, observaciones = :observaciones WHERE codigo = :codigo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'descripcion' => $descripcion,
        'precio' => $precio,
        'observaciones' => $observaciones,
        'codigo' => $codigo,
    ]);

    // Establecer un mensaje de éxito en la sesión
    $_SESSION['mensaje'] = "MODIFICACIÓN GUARDADA";

    // Redirigir después de guardar
    header('Location: http://localhost:8181/Productos.php');
    exit();
} else {
    // Si no se recibe un código, redirigir a la lista
    header('Location: http://localhost:8181/Productos.php');
    exit();
}
?>
