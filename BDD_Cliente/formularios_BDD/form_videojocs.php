<!DOCTYPE HTML>  
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Videojuegos</title>
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

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #007bff;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, select:focus {
            border-color: #0056b3;
        }

        select[multiple] {
            height: 150px;
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
include "clase_videojocs.php";
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
    $data_llancament = test_input($_POST["data_llancament"]);
    $pegi = test_input($_POST["pegi"]);
    
    // Crear instancia de la clase Videojuegos
    $videojocs = new videojocs($servername, $username, $password);

    // Insertar información básica del videojuego
    $videojocs->inserir($nom, $data_llancament, $pegi);

    // Obtener el ID del último videojuego insertado
    $id_videojoc = $videojocs->obtenerUltimoID();

    // Obtener y procesar el desarrollador
    $id_desenvolupador = test_input($_POST["id_desenvolupador"]);
    $videojocs->inserirDesenvolupador($id, $nom);

    // Obtener y procesar las plataformas seleccionadas
    if (isset($_POST['plataformas'])) {
        foreach ($_POST['plataformas'] as $id_plataforma) {
            $videojocs->inserirPlataforma($id_videojoc, $id_plataforma);
        }
    }

    // Obtener y procesar los géneros seleccionados
    if (isset($_POST['generes'])) {
        foreach ($_POST['generes'] as $id_genere) {
            $videojocs->inserirGenere($id_videojoc, $id_genere);
        }
    }
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
    <h2 class="mt-4 text-center">Formulario de Videojuegos</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <div class="form-group">
            <label for="nom"><i class="fas fa-gamepad"></i> Nombre:</label>
            <input type="text" class="form-control" name="nom" placeholder="Ingrese el nombre del videojuego" required>
        </div>

        <div class="form-group">
            <label for="data_llancament"><i class="far fa-calendar-alt"></i> Fecha de Lanzamiento:</label>
            <input type="text" class="form-control" name="data_llancament" placeholder="Ingrese la fecha de lanzamiento" required>
        </div>

        <div class="form-group">
            <label for="pegi"><i class="fas fa-certificate"></i> PEGI:</label>
            <input type="text" class="form-control" name="pegi" placeholder="Ingrese el PEGI" required>
        </div>

        <div class="form-group">
            <label for="id_desenvolupador"><i class="fas fa-code"></i> Desarrollador:</label>
            <select name="id_desenvolupador" class="form-control">
                <?php
                // Consultar y mostrar desarrolladores disponibles
                $videojocs = new videojocs($servername, $username, $password);
                $stmtDesenvolupadors = $videojocs->consultaDesenvolupador();
                while ($rowDesenvolupador = $stmtDesenvolupadors->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$rowDesenvolupador['id']}'>{$rowDesenvolupador['nom']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="plataformas[]"><i class="fas fa-laptop"></i> Plataformas:</label>
            <select multiple name="plataformas[]" class="form-control">
                <?php
                // Consultar y mostrar plataformas disponibles
                $stmtPlataformas = $videojocs->consultaPlataforma();
                while ($rowPlataforma = $stmtPlataformas->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$rowPlataforma['id']}'>{$rowPlataforma['nom']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="generes[]"><i class="fas fa-list"></i> Géneros:</label>
            <select multiple name="generes[]" class="form-control">
                <?php
                // Consultar y mostrar géneros disponibles
                $stmtGeneres = $videojocs->consultaGenere();
                while ($rowGenere = $stmtGeneres->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$rowGenere['id']}'>{$rowGenere['nom']}</option>";
                }
                ?>
            </select>
        </div>

        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Enviar">  
    </form>
</div>

</body>
</html>
