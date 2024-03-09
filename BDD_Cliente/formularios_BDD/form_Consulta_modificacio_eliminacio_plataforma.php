<?php
// Se incluyen los archivos necesarios
include 'clase_plataforma.php'; 
include 'conexion.php';
include 'verificacion_sesion.php';

// Sección para mostrar el formulario de cierre de sesión o el mensaje de inicio de sesión
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

// Creación de un objeto Plataforma
$Plataformas = new Plataforma($servername, $username, $password);

// Manejo de las peticiones POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_joc = $_POST["id_joc"];
    if (isset($_POST["consulta"])) {
        // Consulta de información de la Plataforma por ID
        $result = $Plataformas->consultaPerId($id_joc);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            echo "<div class='container mt-4'>";
            echo "<h2>Información del Plataforma con ID $id_joc:</h2>";
            echo "<p>ID: {$row['id']} - Nombre: {$row['nom']} </p>";
            echo "</div>";
        } else {
            echo "<div class='container mt-4'>";
            echo "<p class='alert alert-warning'>No se ha encontrado ninguna Plataforma con ID $id_joc.</p>";
            echo "</div>";
        }
    } elseif (isset($_POST["modifica"])) {
        // Modificación de la Plataforma por ID
        $result = $Plataformas->consultaPerId($id_joc);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class='container mt-4'>
                <h2>Modificación de Plataforma con ID <?php echo $id_joc; ?>:</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    Nombre del Plataforma: <input type="text" name="nom" value="<?php echo $row['nom']; ?>" class="form-control" required><br>
                    <input type="hidden" name="id_joc" value="<?php echo $id_joc; ?>">
                    <input type="submit" name="guarda_modificacio" class="btn btn-success" value="Guardar Modificación">
                </form>
            </div>
            <?php
        } else {
            echo "<div class='container mt-4'>";
            echo "<p class='alert alert-warning'>No se ha encontrado ninguna Plataforma con ID $id_joc para modificar.</p>";
            echo "</div>";
        }
    } elseif (isset($_POST["guarda_modificacio"])) {
        // Guardar la modificación de la Plataforma por ID
        $nom = $_POST["nom"];
        $result = $Plataformas->modificar($id_joc, $nom);
        if ($result > 0) {
            echo "<div class='container mt-4'>";
            echo "<p class='alert alert-success'>Modificación del Plataforma con ID $id_joc realizada con éxito.</p>";
            echo "</div>";
        } else {
            echo "<div class='container mt-4'>";
            echo "<p class='alert alert-danger'>No se ha podido realizar la modificación del Plataforma con ID $id_joc.</p>";
            echo "</div>";
        }
    } elseif (isset($_POST["elimina"])) {
        // Eliminar la Plataforma por ID
        $Plataformas->eliminar($id_joc);
        echo "<div class='container mt-4'>";
        echo "<p class='alert alert-success'>Plataforma eliminada con éxito.</p>";
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta, Modificación y Eliminación de Plataformas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Consulta, Modificación y Eliminación de Plataformas:</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mb-4">
            <div class="form-group">
                <label for="id_joc">ID del Plataforma:</label>
                <input type="number" name="id_joc" class="form-control" required>
            </div>
            <button type="submit" name="consulta" class="btn btn-primary"><i class="fas fa-search"></i> Consulta</button>
            <button type="submit" name="modifica" class="btn btn-warning"><i class="fas fa-edit"></i> Modifica</button>
            <button type="submit" name="elimina" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Elimina</button>
        </form>
    </div>
</body>
</html>
