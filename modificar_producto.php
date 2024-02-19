<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se ha enviado la solicitud de modificación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modificar"])) {
    $producto_id = $_POST["producto_id"];
    // Recuperar los nuevos datos del formulario
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    // Actualizar los datos del producto en la base de datos
    $sql = "UPDATE indumentaria SET nombre='$nombre', descripcion='$descripcion', precio='$precio' WHERE id=$producto_id";
    if (mysqli_query($conn, $sql)) {
        header("Location: productos.php");
        exit();
    } else {
        echo "Error al modificar el producto.";
    }
}

// Obtener el ID del producto a modificar desde la URL
if (isset($_GET["id"])) {
    $producto_id = $_GET["id"];
    // Consultar los datos del producto
    $sql = "SELECT * FROM indumentaria WHERE id=$producto_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    echo "ID del producto no especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
</head>
<body>
    <h1>Modificar Producto</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $row["nombre"]; ?>" required><br>
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion"><?php echo $row["descripcion"]; ?></textarea><br>
        <label for="precio">Precio:</label><br>
        <input type="number" id="precio" name="precio" value="<?php echo $row["precio"]; ?>" min="0" step="0.01" required><br><br>
        <input type="submit" name="modificar" value="Guardar">
    </form>
</body>
</html>
