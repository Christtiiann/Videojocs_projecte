<?php
include 'clase_desenvolupador.php'; 
include 'conexion.php';


$Desenvolupadors = new Desenvolupador($servername, $username, $password);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_joc = $_POST["id_joc"];
    if (isset($_POST["consulta"])) {

        $result = $Desenvolupadors->consultaPerId($id_joc);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            echo "<h2>Informació del Desenvolupador amb ID $id_joc:</h2>";
            echo "<p>ID: {$row['id']} - Nom: {$row['nom']} </p>";
        } else {
            echo "<p>No s'ha trobat cap Desenvolupador amb ID $id_joc.</p>";
        }
    } elseif (isset($_POST["modifica"])) {

        $result = $Desenvolupadors->consultaPerId($id_joc);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            ?>
            <h2>Modificació de Desenvolupador amb ID <?php echo $id_joc; ?>:</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                Nom del Desenvolupador: <input type="text" name="nom" value="<?php echo $row['nom']; ?>" required><br>
                <input type="hidden" name="id_joc" value="<?php echo $id_joc; ?>">
                <input type="submit" name="guarda_modificacio" value="Guardar Modificació">
            </form>
            <?php
        } else {
            echo "<p>No s'ha trobat cap Desenvolupador amb ID $id_joc per a modificar.</p>";
        }
    } elseif (isset($_POST["guarda_modificacio"])) {
        $nom = $_POST["nom"];

        $result = $Desenvolupadors->modificar($id_joc, $nom);
        if ($result > 0) {
            echo "<p>Modificació del Desenvolupador amb ID $id_joc realitzada amb èxit.</p>";
        } else {
            echo "<p>No s'ha pogut realitzar la modificació del Desenvolupador amb ID $id_joc.</p>";
        }
    } elseif (isset($_POST["elimina"])) {
        $Desenvolupadors->eliminar($id_joc);
        echo "<p>Desenvolupador eliminat amb èxit.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consulta, Modificació i Eliminació de Desenvolupadors</title>
</head>
<body>

<h2>Consulta, Modificació i Eliminació de Desenvolupadors:</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    ID del Desenvolupador: <input type="number" name="id_joc" required><br>
    <input type="submit" name="consulta" value="Consulta">
    <input type="submit" name="modifica" value="Modifica">
    <input type="submit" name="elimina" value="Elimina">
</form>

</body>
</html>
