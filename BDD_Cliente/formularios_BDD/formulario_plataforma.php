<!DOCTYPE HTML>  
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Plataforma</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease;
        }

        label {
            font-weight: bold;
            margin-bottom: 12px;
            display: block;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #007bff;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #0056b3;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>  

<?php
include "conexion.php";
include "clase_plataforma.php";
include 'verificacion_sesion.php';

// Verificación y manejo de la sesión
if (isset($_SESSION['user'])) {
    echo '<form method="post" action="logout.php" class="text-right">';
    echo '<button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</button>';
    echo '</form>';
} else {
    echo '<p class="alert alert-info">Inicia sesión para acceder a las funciones.</p>';
}
verificarSesion();

// Procesamiento del formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = test_input($_POST["nom"]);
    
    // Crear instancia de la clase Plataforma
    $plataformas = new plataforma($servername, $username, $password);

    // Insertar la plataforma
    $plataformas->inserir($nom);
}

// Función para limpiar y validar datos de entrada
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<div class="container">
    <h2 class="mt-4 text-center">Formulario de Plataforma</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <div class="form-group">
            <label for="nom"><i class="fas fa-gamepad"></i> Plataforma:</label>
            <input type="text" class="form-control" name="nom" placeholder="Ingrese el nombre de la plataforma" required>
        </div>

        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Enviar">  
    </form>
</div>

</body>
</html>
