<?php
include_once("app/crud/conexion.php"); // Asegúrate de que la ruta es correcta

echo '<table class="table"><thead>
    <tr scope="row"><th>Código</th><th>Nombre</th><th>Teléfono</th><th>Correo</th><th>Operaciones</th></tr>
    </thead><tbody>';

$sql = "SELECT codigo, nombre, telefono, correo FROM Clientes";

try {
    $stmt = $pdo->query($sql); // Usa $pdo aquí
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr scope="row">
            <td>' . htmlspecialchars($row["codigo"]) . '</td>
            <td>' . htmlspecialchars($row["nombre"]) . '</td>
            <td>' . htmlspecialchars($row["telefono"]) . '</td>
            <td>' . htmlspecialchars($row["correo"]) . '</td>
            <td>
                <a href="app/crud/clientes/editar.php?Cod=' . htmlspecialchars($row["codigo"]) . '">
                    <input type="button" class="btn btn-warning" value="Editar">
                </a>
                <form action="app/crud/clientes/eliminar.php" method="post" style="display:inline;">
                    <input type="hidden" name="codigo" value="' . htmlspecialchars($row["codigo"]) . '">
                    <input type="submit" class="btn btn-danger" value="Eliminar" onclick="return confirm(\'¿Estás seguro de eliminar?\');">
                </form>
            </td>
        </tr>';
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}

echo "</tbody></table>";
?>
