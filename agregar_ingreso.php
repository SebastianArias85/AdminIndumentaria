<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST["producto_id"];
    $cantidad = $_POST["cantidad"];
    $fecha_ingreso = date("Y-m-d"); // Obtener la fecha actual

    // Insertar el nuevo ingreso en la tabla 'ingresos'
    $sql = "INSERT INTO ingresos (id_indumentaria, fecha_ingreso, cantidad_ingreso) VALUES ('$producto_id', '$fecha_ingreso', '$cantidad')";
    if (mysqli_query($conn, $sql)) {
        echo "Ingreso agregado exitosamente.";
        header("Location: index.php");
    } else {
        echo "Error al agregar el ingreso: " . mysqli_error($conn);
    }
}

// Consultar los productos existentes en la base de datos
$sql = "SELECT id, nombre FROM indumentaria";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Ingreso</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Agregar Ingreso</h1>
        <a href="index.php" class="btn btn-primary">Menu Principal</a>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="producto">Producto:</label>
                <select id="producto" name="producto_id" class="form-control">
                    <?php
                    // Mostrar opciones del desplegable con los productos
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" min="1" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Ingreso</button>
        </form>
    </div>
</body>
</html>
