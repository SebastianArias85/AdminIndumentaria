<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];

    // Insertar los datos en la tabla 'indumentaria'
    $sql = "INSERT INTO indumentaria (nombre, descripcion, precio) VALUES ('$nombre', '$descripcion', '$precio')";
    if (mysqli_query($conn, $sql)) {
        // Redireccionar a index.php después de agregar el producto
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Producto</title> 
</head>
<body>
    <h1>Agregar Nuevo Producto</h1> <br>
    <a href="index.php">Menu Principal</a>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion"></textarea><br>
        <label for="precio">Precio:</label><br>
        <input type="number" id="precio" name="precio" min="0" step="0.01" required><br><br>
        <input type="submit" value="Agregar Producto">
    </form>
</body>
</html>
