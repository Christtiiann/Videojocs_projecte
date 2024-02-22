<?php
include 'clase_plataforma.php'; 
include 'conexion.php';


$Plataformas = new Plataforma($servername, $username, $password);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_joc = $_POST["id_joc"];
    if (isset($_POST["consulta"])) {

        $result = $Plataformas->consultaPerId($id_joc);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            echo "<h2>Informació del Plataforma amb ID $id_joc:</h2>";
            echo "<p>ID: {$row['id']} - Nom: {$row['nom']} </p>";
        } else {
            echo "<p>No s'ha trobat cap Plataforma amb ID $id_joc.</p>";
        }
    } elseif (isset($_POST["modifica"])) {

        $result = $Plataformas->consultaPerId($id_joc);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            ?>
            <h2>Modificació de Plataforma amb ID <?php echo $id_joc; ?>:</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                Nom del Plataforma: <input type="text" name="nom" value="<?php echo $row['nom']; ?>" required><br>
                <input type="hidden" name="id_joc" value="<?php echo $id_joc; ?>">
                <input type="submit" name="guarda_modificacio" value="Guardar Modificació">
            </form>
            <?php
        } else {
            echo "<p>No s'ha trobat cap Plataforma amb ID $id_joc per a modificar.</p>";
        }
    } elseif (isset($_POST["guarda_modificacio"])) {
        $nom = $_POST["nom"];

        $result = $Plataformas->modificar($id_joc, $nom);
        if ($result > 0) {
            echo "<p>Modificació del Plataforma amb ID $id_joc realitzada amb èxit.</p>";
        } else {
            echo "<p>No s'ha pogut realitzar la modificació del Plataforma amb ID $id_joc.</p>";
        }
    } elseif (isset($_POST["elimina"])) {
        $Plataformas->eliminar($id_joc);
        echo "<p>Plataforma eliminat amb èxit.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consulta, Modificació i Eliminació de Plataformas</title>
</head>
<body>

<h2>Consulta, Modificació i Eliminació de Plataformas:</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    ID del Plataforma: <input type="number" name="id_joc" required><br>
    <input type="submit" name="consulta" value="Consulta">
    <input type="submit" name="modifica" value="Modifica">
    <input type="submit" name="elimina" value="Elimina">
</form>

</body>
</html>