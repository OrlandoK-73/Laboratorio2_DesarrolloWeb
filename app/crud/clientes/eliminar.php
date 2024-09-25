<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/crud/conexion.php"); 

// Verifica si se pasó el código a través del método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];    
    $stmt = $pdo->prepare("DELETE FROM Clientes WHERE codigo = ?");
    $stmt->execute([$codigo]);
    header('Location: ../../../Clientes.php');
    exit();
    
} else {
    
    header('Location: ../../../Clientes.php');
    exit();
}
?>
