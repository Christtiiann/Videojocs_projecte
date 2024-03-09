<?php
// Incluimos los archivos necesarios
include 'clase_genere.php';
include 'conexion.php';
include 'verificacion_sesion.php';

// Mostramos el formulario de cierre de sesión o mensaje de inicio de sesión
echo '<div class="container mt-4">';
if (isset($_SESSION['user'])) {
    echo '<form method="post" action="logout.php" class="float-right">';
    echo '<button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</button>';
    echo '</form>';
} else {
    echo '<p class="alert alert-info">Inicia sesión para acceder a las funciones.</p>';
}
// Verificamos la sesión
verificarSesion();
echo '</div>';

// Creamos una instancia de la clase 'genere'
$genere = new genere($servername, $username, $password);

// Procesamos la solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos el nombre del género desde el formulario
    $nom_joc = $_POST["nom_joc"];

    if (isset($_POST["consulta"])) {
        // Realizamos una consulta por nombre
        $result = $genere->consultaPerNom($nom_joc);
        if ($result->rowCount() > 0) {
            // Mostramos la información del género encontrado
            $row = $result->fetch(PDO::FETCH_ASSOC);
            echo "<h2>Informació del Genere amb Nom $nom_joc:</h2>";
            echo "<p>ID: {$row['id']} - Nom: {$row['nom']}</p>";
        } else {
            echo "<p>No s'ha trobat cap videojoc amb Nom $nom_joc.</p>";
        }
    } elseif (isset($_POST["modifica"])) {
        // Realizamos una consulta por nombre para la modificación
        $result = $genere->consultaPerNom($nom_joc);
        if ($result->rowCount() > 0) {
            // Mostramos el formulario de modificación con la información actual del género
            $row = $result->fetch(PDO::FETCH_ASSOC);
            ?>
            <h2>Modificació de Genere amb Nom <?php echo $nom_joc; ?>:</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    Nom del Joc: <input type="text" name="nom" value="<?php echo $row['nom']; ?>" class="form-control" required><br>
                </div>
                <input type="hidden" name="id_joc" value="<?php echo $row['id']; ?>">
                <button type="submit" name="guarda_modificacio" class="btn btn-success"><i class="fas fa-save"></i> Guardar Modificació</button>
            </form>
            <?php
        } else {
            echo "<p>No s'ha trobat cap videojoc amb Nom $nom_joc per a modificar.</p>";
        }
    } elseif (isset($_POST["guarda_modificacio"])) {
        // Procesamos la solicitud de modificación
        $id_joc = $_POST["id_joc"];
        $nom = $_POST["nom"];

        $result = $genere->modificar($id_joc, $nom);
        if ($result > 0) {
            echo "<p>Modificació del Genere amb Nom $nom realitzada amb èxit.</p>";
        } else {
            echo "<p>No s'ha pogut realitzar la modificació del Genere amb Nom $nom.</p>";
        }
    } elseif (isset($_POST["elimina"])) {
        // Procesamos la solicitud de eliminación por nombre
        $result = $genere->eliminarPerNom($nom_joc);
        if ($result > 0) {
            echo "<p>Genere amb Nom $nom_joc eliminat amb èxit.</p>";
        } else {
            echo "<p>No s'ha pogut eliminar el Genere amb Nom $nom_joc.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta, Modificació i Eliminació de Genere</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <style>

    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4">Consulta, Modificació i Eliminació de Genere per Nom:</h2>
    <!-- Formulario de consulta, modificación y eliminación por nombre -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mb-4">
        <div class="form-group">
            <label for="nom_joc">Nom del Genere:</label>
            <input type="text" name="nom_joc" class="form-control" required>
        </div>
        <!-- Botones de acción -->
        <button type="submit" name="consulta" class="btn btn-primary"><i class="fas fa-search"></i> Consulta</button>
        <button type="submit" name="modifica" class="btn btn-warning"><i class="fas fa-edit"></i> Modifica</button>
        <button type="submit" name="elimina" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Elimina</button>
    </form>
</div>

</body>
</html>
<!-- Recordar que 'genere' se hizo por nombre por petición de Miquel Vera -->
