<?php
include 'clase_desenvolupador.php'; 
include 'conexion.php';
include 'verificacion_sesion.php';

// Encabezado y botón de cierre de sesión si el usuario está autenticado
echo '<div class="container mt-4">';
if (isset($_SESSION['user'])) {
    echo '<form method="post" action="logout.php" class="float-right">';
    echo '<button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</button>';
    echo '</form>';
} else {
    echo '<p class="alert alert-info">Inicia sesión para acceder a las funciones.</p>';
}
// Verificación de la sesión
verificarSesion();
echo '</div>';

// Creación de instancia de la clase Desenvolupador con parámetros de conexión
$Desenvolupadors = new Desenvolupador($servername, $username, $password);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_joc = $_POST["id_joc"];
    if (isset($_POST["consulta"])) {
        // Consulta de información del desarrollador por ID
        $result = $Desenvolupadors->consultaPerId($id_joc);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            echo "<h2>Información del Desenvolupador con ID $id_joc:</h2>";
            echo "<p>ID: {$row['id']} - Nombre: {$row['nom']} </p>";
        } else {
            echo "<p>No se ha encontrado ningún Desenvolupador con ID $id_joc.</p>";
        }
    } elseif (isset($_POST["modifica"])) {
        // Formulario de modificación del desarrollador por ID
        $result = $Desenvolupadors->consultaPerId($id_joc);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            ?>
            <h2>Modificación de Desenvolupador con ID <?php echo $id_joc; ?>:</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                Nombre del Desenvolupador: <input type="text" name="nom" value="<?php echo $row['nom']; ?>" required><br>
                <input type="hidden" name="id_joc" value="<?php echo $id_joc; ?>">
                <input type="submit" name="guarda_modificacio" value="Guardar Modificación">
            </form>
            <?php
        } else {
            echo "<p>No se ha encontrado ningún Desenvolupador con ID $id_joc para modificar.</p>";
        }
    } elseif (isset($_POST["guarda_modificacio"])) {
        // Guardar la modificación del Desenvolupador por ID
        $nom = $_POST["nom"];
        $result = $Desenvolupadors->modificar($id_joc, $nom);
        if ($result > 0) {
            echo "<p>Modificación del Desenvolupador con ID $id_joc realizada con éxito.</p>";
        } else {
            echo "<p>No se ha podido realizar la modificación del Desenvolupador con ID $id_joc.</p>";
        }
    } elseif (isset($_POST["elimina"])) {
        // Eliminar el Desenvolupador por ID
        $Desenvolupadors->eliminar($id_joc);
        echo "<p>Desenvolupador eliminado con éxito.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta, Modificación y Eliminación de Desenvolupadors</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">

</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4">Consulta, Modificación y Eliminación de Desenvolupadors:</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mb-4">
        <div class="form-group">
            <label for="id_joc">ID del Desenvolupador:</label>
            <input type="number" name="id_joc" class="form-control" required>
        </div>
        <button type="submit" name="consulta" class="btn btn-primary"><i class="fas fa-search"></i> Consulta</button>
        <button type="submit" name="modifica" class="btn btn-warning"><i class="fas fa-edit"></i> Modifica</button>
        <button type="submit" name="elimina" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Elimina</button>
    </form>
</div>

</body>
</html>
