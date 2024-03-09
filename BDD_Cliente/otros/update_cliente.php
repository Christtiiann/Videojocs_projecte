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
    $nom = test_input($_POST["nom"]);
    $llinatge1 = test_input($_POST["llinatge1"]);
    $llinatge2 = test_input($_POST["llinatge2"]);
    $email = test_input($_POST["email"]);

    $client = new Client($servername, $username, $password);
    $result = $client->modificar($id, $nom, $llinatge1, $llinatge2, $email);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Formulario de Modificación</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <label for="id">ID del Cliente a Modificar:</label>
    <input type="text" name="id" value=""><br>

    <label for="nom">Nombre:</label>
    <input type="text" name="nom" value=""><br>

    <label for="llinatge1">Llinatge1:</label>
    <input type="text" name="llinatge1" value=""><br>

    <label for="llinatge2">Llinatge2:</label>
    <input type="text" name="llinatge2" value=""><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value=""><br>

    <input type="submit" name="submit" value="Modificar">  
</form>

</body>
</html>
