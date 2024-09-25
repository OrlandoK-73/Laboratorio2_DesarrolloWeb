<?php
include_once("app/crud/conexion.php"); // Asegúrate de que la ruta es correcta

echo '<table class="table"><thead>
    <tr scope="row"><th>Código</th><th>Descripción</th><th>Precio</th><th>Observaciones</th><th>Operaciones</th></tr>
    </thead><tbody>';

$sql = "SELECT codigo, descripcion, precio, observaciones FROM Producto";

try {
    $stmt = $pdo->query($sql); // Usa $pdo aquí
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr scope="row">
            <td>' . htmlspecialchars($row["codigo"]) . '</td>
            <td>' . htmlspecialchars($row["descripcion"]) . '</td>
            <td>' . htmlspecialchars($row["precio"]) . '</td>
            <td>' . htmlspecialchars($row["observaciones"]) . '</td>
            <td>
                <a href="app/crud/productos/editar.php?Cod=' . urlencode($row["codigo"]) . '">
                    <input type="button" class="btn btn-warning" value="Editar">
                </a>
                <form action="app/crud/productos/eliminar.php" method="post" style="display:inline;">
                    <input type="hidden" name="codigo" value="' . htmlspecialchars($row["codigo"]) . '">
                    <input type="submit" class="btn btn-danger" value="Eliminar" onclick="return confirm(\'¿Estás seguro de eliminar?\');">
                </form>
            </td>
        </tr>';
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . htmlspecialchars($e->getMessage());
}

echo "</tbody></table>";
?>
