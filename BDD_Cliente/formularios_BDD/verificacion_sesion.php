<?php
session_start();

function verificarSesion() {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
}
?>
