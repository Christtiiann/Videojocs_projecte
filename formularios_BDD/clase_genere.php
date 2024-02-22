<?php
class genere {

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
            $sql = "INSERT INTO genere ( nom ) VALUES (:nom)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->execute();
            
            echo "Inserció realitzada amb èxit";
        } catch (PDOException $e) {
            echo "Error en l'inserció: " . $e->getMessage();
        }
    }
    public function consultaPerNom($nom) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM genere WHERE nom = :nom");
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function consultaTots() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM genere ");
            $stmt->execute();
            return ($stmt);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function modificar($id, $nom) {
        try {
            $sql = "UPDATE genere SET nom=:nom WHERE id=:id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nom', $nom);
            
            $stmt->execute();
            
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error en la modificació: " . $e->getMessage();
        }
    }
    public function eliminarPerNom($nom) {
        try {
            $sql = "DELETE FROM genere WHERE nom= :nom";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error en l'eliminació: " . $e->getMessage();
        }
    }
    public function eliminar($id) {
        try {
            $sql = "DELETE FROM genere WHERE id= :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error en l'eliminació: " . $e->getMessage();
        }
    }
}
