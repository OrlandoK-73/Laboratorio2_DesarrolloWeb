<?php
$host = 'db';  // Nombre del servicio de base de datos en Docker
$dbname = 'lab2';  // El nombre de tu base de datos
$username = 'root';  // Usuario root
$password = 'rootpassword';  // Contraseña del usuario root

try {
    // Crear una nueva conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Configurar PDO para que arroje excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Error en la conexión: " . $e->getMessage());
    die("Error en la conexión a la base de datos.");
}
?>
