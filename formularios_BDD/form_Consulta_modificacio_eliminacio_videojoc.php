<?php
include 'clase_videojocs.php'; 
include 'conexion.php';


$videojocs = new videojocs($servername, $username, $password);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_joc = $_POST["id_joc"];
    if (isset($_POST["consulta"])) {

        $result = $videojocs->consultaPerId($id_joc);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            echo "<h2>Informació del Videojoc amb ID $id_joc:</h2>";
            echo "<p>ID: {$row['id']} - Nom: {$row['nom']} - Data Llançament: {$row['data_llancament']} - PEGI: {$row['pegi']}</p>";
        } else {
            echo "<p>No s'ha trobat cap videojoc amb ID $id_joc.</p>";
        }
    } elseif (isset($_POST["modifica"])) {

        $result = $videojocs->consultaPerId($id_joc);
        if ($result->rowCount() > 0) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            ?>
            <h2>Modificació de Videojoc amb ID <?php echo $id_joc; ?>:</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                Nom del Joc: <input type="text" name="nom" value="<?php echo $row['nom']; ?>" required><br>
                Data Llançament: <input type="date" name="data_llancament" value="<?php echo $row['data_llancament']; ?>" required><br>
                PEGI: <input type="number" name="pegi" value="<?php echo $row['pegi']; ?>" required><br>
                <input type="hidden" name="id_joc" value="<?php echo $id_joc; ?>">
                <input type="submit" name="guarda_modificacio" value="Guardar Modificació">
            </form>
            <?php
        } else {
            echo "<p>No s'ha trobat cap videojoc amb ID $id_joc per a modificar.</p>";
        }
    } elseif (isset($_POST["guarda_modificacio"])) {
        $nom = $_POST["nom"];
        $data_llancament = $_POST["data_llancament"];
        $pegi = $_POST["pegi"];

        $result = $videojocs->modificar($id_joc, $nom, $data_llancament, $pegi);
        if ($result > 0) {
            echo "<p>Modificació del Videojoc amb ID $id_joc realitzada amb èxit.</p>";
        } else {
            echo "<p>No s'ha pogut realitzar la modificació del Videojoc amb ID $id_joc.</p>";
        }
    

    // if (isset($_POST["consulta"])) {
    //     $result = $videojocs->consultaTots();
    //     echo "<h2>Llista de Videojocs:</h2>";
    //     while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    //         echo "<p>ID: {$row['id']} - Nom: {$row['nom']} - Data Llançament: {$row['data_llancament']} - PEGI: {$row['pegi']}</p>";
    //     }
    // } elseif (isset($_POST["modifica"])) {
    //     $result = $videojocs->modificar($id_joc,$nom,$data_llancament,$pegi);
    //     exit();
    } elseif (isset($_POST["elimina"])) {
        $videojocs->eliminar($id_joc);
        echo "<p>Videojoc eliminat amb èxit.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consulta, Modificació i Eliminació de Videojocs</title>
</head>
<body>

<h2>Consulta, Modificació i Eliminació de Videojocs:</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    ID del Videojoc: <input type="number" name="id_joc" required><br>
    <input type="submit" name="consulta" value="Consulta">
    <input type="submit" name="modifica" value="Modifica">
    <input type="submit" name="elimina" value="Elimina">
</form>

</body>
</html>
