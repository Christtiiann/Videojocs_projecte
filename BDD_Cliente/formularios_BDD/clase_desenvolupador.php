<?php
class desenvolupador {

    private $conn;

    public function __construct($servername, $username, $password) {
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=videojocs_projecte", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function inserir( $nom) {
        try {
            $sql = "INSERT INTO desenvolupador ( nom ) VALUES (:nom)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->execute();
            
            echo "Inserció realitzada amb èxit";
        } catch (PDOException $e) {
            echo "Error en l'inserció: " . $e->getMessage();
        }
    }

    public function consultaPerId($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM desenvolupador WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function consultaTots() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM desenvolupador ");
            $stmt->execute();
            return ($stmt);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function modificar($id, $nom) {
        try {
            $sql = "UPDATE desenvolupador SET nom=:nom WHERE id=:id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nom', $nom);
            
            $stmt->execute();
            
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error en la modificació: " . $e->getMessage();
        }
    }

    public function eliminar($id) {
        try {
            $sql = "DELETE FROM desenvolupador WHERE id= :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);

            $stmt->execute();
            var_dump($stmt);
        } catch (PDOException $e) {
            echo "Error en l'eliminació: " . $e->getMessage();
        }
    }
}
