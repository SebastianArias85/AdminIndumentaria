<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Consultar las existencias de los productos con su precio unitario
$sql = "SELECT 
            ind.id, 
            ind.nombre, 
            ind.precio, 
            IFNULL(ingresos.total_cantidad_ingreso, 0) AS ingresos, 
            IFNULL(egresos.total_cantidad_egreso, 0) AS egresos, 
            IFNULL(ingresos.total_cantidad_ingreso, 0) - IFNULL(egresos.total_cantidad_egreso, 0) AS existencias
        FROM 
            indumentaria AS ind
        LEFT JOIN (
            SELECT 
                id_indumentaria, 
                SUM(cantidad_ingreso) AS total_cantidad_ingreso 
            FROM 
                ingresos 
            GROUP BY 
                id_indumentaria
        ) AS ingresos ON ind.id = ingresos.id_indumentaria
        LEFT JOIN (
            SELECT 
                id_indumentaria, 
                SUM(cantidad_egreso) AS total_cantidad_egreso 
            FROM 
                egresos 
            GROUP BY 
                id_indumentaria
        ) AS egresos ON ind.id = egresos.id_indumentaria";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Existencias de Productos</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Existencias de Productos</h1>
        <a href="index.php" class="btn btn-primary">Menu Principal</a>
        <table class="table mt-4">
            <thead class="thead-light">
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
    </div>
</body>
</html>
