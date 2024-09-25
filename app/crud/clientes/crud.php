<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/crud/conexion.php");

$codigo = null;
$nombre = null;
$telefono = null;
$correo = null;
$opcion = 0;

// Valida que botón se oprime
if (isset($_POST["crear"])) {
    $opcion = 1;
}
if (isset($_POST["editar"])) {
    $opcion = 2;
}
if (isset($_POST["eliminar"])) {
    $opcion = 3;
}

// Valida que los datos no estén nulos   
if (isset($_POST["codigo"])) {
    $codigo = $_POST["codigo"];
}

if (isset($_POST["nombre"])) {
    $nombre = $_POST["nombre"];
}
if (isset($_POST["telefono"])) {
    $telefono = $_POST["telefono"];
}
if (isset($_POST["correo"])) {
    $correo = $_POST["correo"];
}

// Preparar la consulta según la opción
try {
    if ($opcion == 1) { // Insertar
        $stmt = $pdo->prepare("INSERT INTO Clientes (nombre, telefono, correo) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $telefono, $correo]);
    } elseif ($opcion == 2) { // Editar
        $stmt = $pdo->prepare("UPDATE Clientes SET nombre=?, telefono=?, correo=? WHERE codigo=?");
        $stmt->execute([$nombre, $telefono, $correo, $codigo]);
    } elseif ($opcion == 3) { // Eliminar
        $stmt = $pdo->prepare("DELETE FROM Clientes WHERE codigo=?");
        $stmt->execute([$codigo]);
    }

    // Comprobar si se ejecutó correctamente
  //  echo "Ejecutado con éxito.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    header('Location: ../../../Clientes.php');
    exit(); // Asegúrate de salir después del redireccionamiento
}
?>
