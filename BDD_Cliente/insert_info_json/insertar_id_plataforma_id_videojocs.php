<?php

class InsertarRelacionesVideojocPlataforma
{
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "iesmanacor";
    private $conn;
    private $jsonData;
    private $data;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=videojocs_projecte", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            $this->jsonData = file_get_contents("dades.json");
            $this->data = json_decode($this->jsonData, true);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function inserirRelacions()
    {
        try {
            foreach ($this->data as $key => $videojuego) {
                if ($key !== "plataforma" && $videojuego !== null) {
                    $videojocNom = $videojuego['Nom']; 

                    
                    $sqlVideojocId = "SELECT id FROM videojocs WHERE nom = :nom";
                    $stmtVideojocId = $this->conn->prepare($sqlVideojocId);
                    $stmtVideojocId->bindParam(':nom', $videojocNom);
                    $stmtVideojocId->execute();
                    $idVideojoc = $stmtVideojocId->fetchColumn();


                    if (!$idVideojoc) {
                        echo "No se encontró el videojuego '$videojocNom'. La relación no será insertada.";
                        continue; 
                    }

                    $plataformas = explode(',', $videojuego['Plataforma']);

                    foreach ($plataformas as $plataforma) {
                        $plataforma = trim($plataforma);

                        $sqlPlataformaId = "SELECT id FROM plataforma WHERE nom = :nom";
                        $stmtPlataformaId = $this->conn->prepare($sqlPlataformaId);
                        $stmtPlataformaId->bindParam(':nom', $plataforma);
                        $stmtPlataformaId->execute();
                        $idPlataforma = $stmtPlataformaId->fetchColumn();


                        $sqlRelacion = "INSERT INTO videojoc_plataforma (id_videojoc, id_plataforma) VALUES (:id_videojoc, :id_plataforma)";
                        $stmtRelacion = $this->conn->prepare($sqlRelacion);
                        $stmtRelacion->bindParam(':id_videojoc', $idVideojoc);
                        $stmtRelacion->bindParam(':id_plataforma', $idPlataforma);
                        $stmtRelacion->execute();
                    }
                }
            }
            echo "Inserció de relacions realitzada amb èxit";
        } catch (PDOException $e) {
            echo "Error en l'inserció de relacions: " . $e->getMessage();
        }
    }
}

$insertarRelaciones = new InsertarRelacionesVideojocPlataforma();
$insertarRelaciones->inserirRelacions();
?>

