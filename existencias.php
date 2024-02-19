<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Consultar las existencias de los productos con su precio unitario
$sql = "SELECT ind.id, ind.nombre, ind.precio, SUM(ing.cantidad_ingreso) AS ingresos, IFNULL(SUM(egr.cantidad_egreso), 0) AS egresos, (SUM(ing.cantidad_ingreso) - IFNULL(SUM(egr.cantidad_egreso), 0)) AS existencias FROM indumentaria AS ind LEFT JOIN ingresos AS ing ON ind.id = ing.id_indumentaria LEFT JOIN egresos AS egr ON ind.id = egr.id_indumentaria GROUP BY ind.id, ind.nombre, ind.precio";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Existencias de Productos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
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
    <h1>Existencias de Productos</h1> <br>
    <a href="index.php">Menu Principal</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio Unitario</th>
                <th>Ingresos</th>
                <th>Egresos</th>
                <th>Existencias</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar los productos y sus existencias en la tabla
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>$" . $row["precio"] . "</td>";
                    echo "<td>" . $row["ingresos"] . "</td>";
                    echo "<td>" . $row["egresos"] . "</td>";
                    echo "<td>" . $row["existencias"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay productos disponibles.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
