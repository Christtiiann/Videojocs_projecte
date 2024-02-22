<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
include "conexion.php";
include "clase_plataforma.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    
        $nom = test_input($_POST["nom"]);
        
    
        $plataformas = new plataforma ($servername, $username, $password);


        $plataformas->inserir( $nom );
        
    }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Formulario de Plataforma</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <label for="nom">Plataforma:</label>
    <input type="text" name="nom" value=""><br>

    <input type="submit" name="submit" value="Enviar">  
</form>

</body>
</html>