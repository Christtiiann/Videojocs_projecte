<?php
class videojocs {

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

    public function inserir( $nom, $data_llancament,$pegi) {
        try {
            $sql = "INSERT INTO videojocs ( nom,data_llancament, pegi) VALUES (:nom, :data_llancament, :pegi)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':data_llancament', $data_llancament);
            $stmt->bindParam(':pegi', $pegi);
            
            $stmt->execute();
            
            echo "Inserció realitzada amb èxit";
        } catch (PDOException $e) {
            echo "Error en l'inserció: " . $e->getMessage();
        }
    }

    public function consultaTots() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM videojocs ");
            $stmt->execute();
            return ($stmt);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function modificar($id, $nom, $data_llancament, $pegi) {
        try {
            $sql = "UPDATE videojocs SET nom=:nom, data_llancament=:data_llancament, pegi=:pegi WHERE id=:id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':data_llancament', $data_llancament);
            $stmt->bindParam(':pegi', $pegi);
            
            $stmt->execute();
            
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error en la modificació: " . $e->getMessage();
        }
    }

    public function eliminar($id) {
        try {
            $sql = "DELETE FROM videojocs WHERE id= :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error en l'eliminació: " . $e->getMessage();
        }
    }
}

