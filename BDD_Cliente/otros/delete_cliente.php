<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
include "conexion.php";
include "clase_cliente.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = test_input($_POST["id"]);

    $client = new Client($servername, $username, $password);
    $client->eliminar($id);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Formulario de Eliminación</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <label for="id">ID del Cliente a Eliminar:</label>
    <input type="text" name="id" value=""><br>

    <input type="submit" name="submit" value="Eliminar">  
</form>

</body>
</html>
