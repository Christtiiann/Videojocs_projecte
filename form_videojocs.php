<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
include "conexion.php";
include "clase_videojocs.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    
        $nom = test_input($_POST["nom"]);
        $data_llancament= test_input($_POST["data_llancament"]);
        $pegi = test_input($_POST["pegi"]);
    
        $videojocs = new videojocs($servername, $username, $password);


        $videojocs->inserir( $nom, $data_llancament, $pegi);
        
    }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Formulario de Videojocs</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <label for="nom">Nombre:</label>
    <input type="text" name="nom" value=""><br>

    <label for="data_llancament">Data_llancament</label>
    <input type="text" name="data_llancament" value=""><br>

    <label for="pegi">pegi</label>
    <input type="text" name="pegi" value=""><br>

    <input type="submit" name="submit" value="Enviar">  
</form>

</body>
</html>

