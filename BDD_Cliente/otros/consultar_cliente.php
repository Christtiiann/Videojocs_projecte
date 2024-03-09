<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
include "conexion.php";
include "clase_cliente.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $client = new Client($servername, $username, $password);
        $result = $client->consultaTots();

        if ($result) {
            echo "<h2>Resultados de la Consulta</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido1</th>
                        <th>Apellido2</th>
                        <th>Email</th>
                    </tr>";

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nom']}</td>
                        <td>{$row['llinatge1']}</td>
                        <td>{$row['llinatge2']}</td>
                        <td>{$row['email']}</td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "No se encontraron resultados.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<h2>Formulario de Consulta de Todos los Clientes</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <input type="submit" name="submit" value="Consultar Todos">  
</form>

</body>
</html>
