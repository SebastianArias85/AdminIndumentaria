<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Función para eliminar un producto por su ID
function eliminarProducto($conn, $id)
{
    $sql = "DELETE FROM indumentaria WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Verificar si se ha enviado la solicitud de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
    $producto_id = $_POST["producto_id"];
    if (eliminarProducto($conn, $producto_id)) {
        echo "Producto eliminado correctamente.";
    } else {
        echo "Error al eliminar el producto.";
    }
}

// Consultar todos los productos
$sql = "SELECT * FROM indumentaria";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Lista de Productos</h1> <br>
    <a href="index.php">Menu Principal</a>
    <table style="margin-top: 20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acción</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar los productos en la tabla con botones de eliminación
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["descripcion"] . "</td>";
                    echo "<td>$" . $row["precio"] . "</td>";
                    echo "<td>";
                    echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                    echo "<input type='hidden' name='producto_id' value='" . $row["id"] . "'>";
                    echo "<input type='submit' name='eliminar' value='Eliminar'>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td>"; // Nueva columna para el botón de modificar
                    echo "<form action='modificar_producto.php' method='get'>";
                    echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                    echo "<input type='submit' value='Modificar'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay productos disponibles.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>