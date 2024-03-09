<?php
include 'clase_videojocs.php'; 
include 'conexion.php';
include 'verificacion_sesion.php';

// Encabezado y botón de cierre de sesión
echo '<div class="container mt-4">';
if (isset($_SESSION['user'])) {
    echo '<form method="post" action="logout.php" class="float-right">';
    echo '<button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</button>';
    echo '</form>';
} else {
    echo '<p class="alert alert-info">Inicia sesión para acceder a las funciones.</p>';
}
verificarSesion();
echo '</div>';

// Instancia de la clase de videojuegos
$videojocs = new videojocs($servername, $username, $password);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_joc = $_POST["id_joc"];
    
    // Consulta de información del videojuego por ID
    if (isset($_POST["consulta"])) {
        $result = $videojocs->consultaPerId($id_joc);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            echo "<h2>Información del Videojuego con ID $id_joc:</h2>";
            echo "<p>ID: {$row['id']} - Nombre: {$row['nom']} - Fecha de Lanzamiento: {$row['data_llancament']} - PEGI: {$row['pegi']}</p>";
        } else {
            echo "<p>No se ha encontrado ningún videojuego con ID $id_joc.</p>";
        }
    } 
    // Modificación de información del videojuego por ID
    elseif (isset($_POST["modifica"])) {
        $result = $videojocs->consultaPerId($id_joc);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            ?>
            <h2>Modificación de Videojuego con ID <?php echo $id_joc; ?>:</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <label for="nom">Nombre del Juego:</label>
                    <input type="text" name="nom" class="form-control" value="<?php echo $row['nom']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="data_llancament">Fecha de Lanzamiento:</label>
                    <input type="date" name="data_llancament" class="form-control" value="<?php echo $row['data_llancament']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="pegi">PEGI:</label>
                    <input type="number" name="pegi" class="form-control" value="<?php echo $row['pegi']; ?>" required>
                </div>
                <input type="hidden" name="id_joc" value="<?php echo $id_joc; ?>">
                <button type="submit" name="guarda_modificacio" class="btn btn-success">Guardar Modificación</button>
            </form>
            <?php
        } else {
            echo "<p>No se ha encontrado ningún videojuego con ID $id_joc para modificar.</p>";
        }
    } 
    // Guardar la modificación del videojuego por ID
    elseif (isset($_POST["guarda_modificacio"])) {
        $nom = $_POST["nom"];
        $data_llancament = $_POST["data_llancament"];
        $pegi = $_POST["pegi"];

        $result = $videojocs->modificar($id_joc, $nom, $data_llancament, $pegi);
        if ($result > 0) {
            echo "<p class='alert alert-success'>Modificación del Videojuego con ID $id_joc realizada con éxito.</p>";
        } else {
            echo "<p class='alert alert-danger'>No se pudo realizar la modificación del Videojuego con ID $id_joc.</p>";
        }
    } 
    // Eliminar el videojuego por ID
    elseif (isset($_POST["elimina"])) {
        $videojocs->eliminar($id_joc);
        echo "<p class='alert alert-success'>Videojuego eliminado con éxito.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta, Modificación y Eliminación de Videojuegos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Consulta, Modificación y Eliminación de Videojuegos:</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mb-4">
            <div class="form-group">
                <label for="id_joc">ID del Videojuego:</label>
                <input type="number" name="id_joc" class="form-control" required>
            </div>
            <button type="submit" name="consulta" class="btn btn-primary"><i class="fas fa-search"></i> Consulta</button>
            <button type="submit" name="modifica" class="btn btn-warning"><i class="fas fa-edit"></i> Modifica</button>
            <button type="submit" name="elimina" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Elimina</button>
        </form>
    </div>
</body>
</html>
