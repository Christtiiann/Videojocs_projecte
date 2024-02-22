<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
include "conexion.php";
include "clase_genere.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    
        $nom = test_input($_POST["nom"]);
        
    
        $generes = new genere ($servername, $username, $password);


        $generes->inserir( $nom );
        
    }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Formulario de Genere</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <label for="nom">Genere:</label>
    <input type="text" name="nom" value=""><br>

    <input type="submit" name="submit" value="Enviar">  
</form>

</body>
</html>