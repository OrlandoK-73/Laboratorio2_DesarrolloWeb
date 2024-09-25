<?php
session_start(); // Iniciar la sesión
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/crud/conexion.php"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];

    // Prepara y ejecuta la consulta para eliminar el producto
    $stmt = $pdo->prepare("DELETE FROM Producto WHERE codigo = ?");
    $stmt->execute([$codigo]);
    $_SESSION['mensaje'] = "PRODUCTO ELIMINADO CON ÉXITO";

    // Redirigir después de eliminar
    header('Location: http://localhost:8181/Productos.php');
    exit();
} else {
    // Si no se recibe un código, redirigir a la lista
    header('Location: http://localhost:8181/Productos.php');
    exit();
}
?>
