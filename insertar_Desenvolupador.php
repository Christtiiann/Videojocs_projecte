<?php
class Insertar
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

    public function inserir()
    {
        try {
            foreach ($this->data as $key => $videojuego) {
                if ($key !== "desenvolupador" && $videojuego !== null) {
                    $desenvolupadors = explode(',', $videojuego['Desenvolupador']);
                    
                    foreach ($desenvolupadors as $desenvolupador) {
                        $desenvolupador = trim($desenvolupador);

                        $checkSql = "SELECT COUNT(*) FROM desenvolupador WHERE nom = :nom";
                        $checkStmt = $this->conn->prepare($checkSql);
                        $checkStmt->bindParam(':nom', $desenvolupador);
                        $checkStmt->execute();
                        $count = $checkStmt->fetchColumn();

                        if ($count == 0) {
                            $insertSql = "INSERT INTO desenvolupador (nom) VALUES (:nom)";
                            $insertStmt = $this->conn->prepare($insertSql);
                            $insertStmt->bindParam(':nom', $desenvolupador);
                            $insertStmt->execute();
                        } else {
                            echo "EL desenvolupador '$desenvolupador' ya existe en la base de datos. No se realizará la inserción.";
                        }
                    }
                }
            }
            echo "Inserció realitzada amb èxit";
        } catch (PDOException $e) {
            echo "Error en l'inserció: " . $e->getMessage();
        }
    }
}

$insertar = new Insertar();
$insertar->inserir();
?>
