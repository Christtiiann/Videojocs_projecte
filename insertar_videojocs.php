<?php
class insertar {
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "iesmanacor";
    private $conn;
    private $jsonData;
    private $data;

    public function __construct() {
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

    public function inserir() {
        try {
            foreach ($this->data as $key => $videojuego) {
                if ($key !== "videojocs" && $videojuego !== null) {
                    $nom = $videojuego['Nom'];
                    $llancament = $videojuego['Llancament'];

                    $desenvolupador = $videojuego['Desenvolupador'];
                    $query = "SELECT id FROM desenvolupador WHERE nom = :desenvolupador";
                    $stmtDesenvolupador = $this->conn->prepare($query);
                    $stmtDesenvolupador->bindParam(':desenvolupador', $desenvolupador);
                    $stmtDesenvolupador->execute();
                    $idDesenvolupador = $stmtDesenvolupador->fetchColumn();


                    $sql = "INSERT INTO videojocs (nom, data_llancament, id_desenvolupador) VALUES (:nom, :data_llancament, :id_desenvolupador)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':data_llancament', $llancament);
                    $stmt->bindParam(':id_desenvolupador', $idDesenvolupador);
                    $stmt->execute();
                }
            }
            echo "Inserció realitzada amb èxit";
        } catch (PDOException $e) {
            echo "Error en l'inserció: " . $e->getMessage();
        }
    }
}

$insertar = new insertar();
$insertar->inserir();
?>
