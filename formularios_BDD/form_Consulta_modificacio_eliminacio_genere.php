<?php
include 'clase_genere.php';
include 'conexion.php';

$genere = new genere($servername, $username, $password);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_joc = $_POST["nom_joc"];

    if (isset($_POST["consulta"])) {

        $result = $genere->consultaPerNom($nom_joc);
        if ($result->rowCount() > 0) {
            echo "text";
            var_dump($result);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            echo "<h2>Informació del Genere amb Nom $nom_joc:</h2>";
            echo "<p>ID: {$row['id']} - Nom: {$row['nom']}</p>";
        } else {
            echo "<p>No s'ha trobat cap videojoc amb Nom $nom_joc.</p>";
        }
    } elseif (isset($_POST["modifica"])) {

        $result = $genere->consultaPerNom($nom_joc);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            ?>
            <h2>Modificació de Genere amb Nom <?php echo $nom_joc; ?>:</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                Nom del Joc: <input type="text" name="nom" value="<?php echo $row['nom']; ?>" required><br>
                <input type="hidden" name="id_joc" value="<?php echo $row['id']; ?>">
                <input type="submit" name="guarda_modificacio" value="Guardar Modificació">
            </form>
            <?php
        } else {
            echo "<p>No s'ha trobat cap videojoc amb Nom $nom_joc per a modificar.</p>";
        }
    } elseif (isset($_POST["guarda_modificacio"])) {
        $id_joc = $_POST["id_joc"];
        $nom = $_POST["nom"];

        $result = $genere->modificar($id_joc, $nom);
        if ($result > 0) {
            echo "<p>Modificació del Genere amb Nom $nom realitzada amb èxit.</p>";
        } else {
            echo "<p>No s'ha pogut realitzar la modificació del Genere amb Nom $nom.</p>";
        }
    } elseif (isset($_POST["elimina"])) {

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
<html>
<head>
    <title>Consulta, Modificació i Eliminació de Genere</title>
</head>
<body>

<h2>Consulta, Modificació i Eliminació de Genere per Nom:</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Nom del Genere: <input type="text" name="nom_joc" required><br>
    <input type="submit" name="consulta" value="Consulta">
    <input type="submit" name="modifica" value="Modifica">
    <input type="submit" name="elimina" value="Elimina">
</form>

</body>
</html>
