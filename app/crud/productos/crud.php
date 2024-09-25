<?php
include_once("../conexion.php"); // Asegúrate de que este archivo contenga la conexión PDO

$codigo = null;
$nombre = null;
$precio = null;
$observacion = null;
$opcion = 0;

if (isset($_POST["crear"])) {
    $opcion = 1;
}
if (isset($_POST["editar"])) {
    $opcion = 2;
}
if (isset($_POST["eliminar"])) {
    $opcion = 3;
}

// Obtiene datos del formulario
if (isset($_POST["codigo"])) {
    $codigo = $_POST["codigo"];
}
if (isset($_POST["producto"])) {
    $nombre = $_POST["producto"];
}
if (isset($_POST["valor"])) {
    $precio = $_POST["valor"];
}
if (isset($_POST["observaciones"])) {
    $observacion = $_POST["observaciones"];
}

try {
    // Preparar la consulta según la opción
    if ($opcion == 1) { // Insertar
        $stmt = $pdo->prepare("INSERT INTO Producto (codigo, descripcion, precio, observaciones) VALUES (?, ?, ?, ?)");
        $stmt->execute([$codigo, $nombre, $precio, $observacion]);
    } elseif ($opcion == 2) { // Editar
        $stmt = $pdo->prepare("UPDATE producto SET descripcion=?, precio=?, observaciones=? WHERE codigo=?");
        $stmt->execute([$nombre, $precio, $observacion, $codigo]);
    } elseif ($opcion == 3) { // Eliminar
        $stmt = $pdo->prepare("DELETE FROM producto WHERE codigo=?");
        $stmt->execute([$codigo]);
    }

    // Comprobar si se ejecutó correctamente
    if ($stmt->rowCount() > 0) {
     //   echo "Ejecutado con éxito.";
    } else {
        echo "No se realizaron cambios.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Redirigir después de cerrar la conexión
    header('Location: ../../../Productos.php');
    exit();
}
?>
