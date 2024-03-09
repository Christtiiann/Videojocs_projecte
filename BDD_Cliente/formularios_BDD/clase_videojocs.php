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

    public function obtenerUltimoID() {
        try {
            $stmt = $this->conn->prepare("SELECT MAX(id) AS max_id FROM videojocs");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['max_id'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function inserirDesenvolupador($id_videojoc, $id_desenvolupador) {
        try {
            $sql = "UPDATE videojocs SET id_desenvolupador = :id_desenvolupador WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':id_desenvolupador', $id_desenvolupador);
            $stmt->execute();
            echo "Inserció de desenvolupador realitzada amb èxit";
        } catch (PDOException $e) {
            echo "Error en l'inserció de desenvolupador: " . $e->getMessage();
        }
    }

    public function inserirPlataforma($id_videojoc, $id_plataforma) {
        try {
            $sql = "INSERT INTO videojoc_plataforma (id_videojoc, id_plataforma) VALUES (:id_videojoc, :id_plataforma)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_videojoc', $id_videojoc);
            $stmt->bindParam(':id_plataforma', $id_plataforma);
            $stmt->execute();
            echo "Inserció de plataforma realitzada amb èxit";
        } catch (PDOException $e) {
            echo "Error en l'inserció de plataforma: " . $e->getMessage();
        }
    }

    public function inserirGenere($id_videojoc, $id_genere) {
        try {
            $sql = "INSERT INTO videojoc_genere (id_videojoc, id_genere) VALUES (:id_videojoc, :id_genere)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_videojoc', $id_videojoc);
            $stmt->bindParam(':id_genere', $id_genere);
            $stmt->execute();
            echo "Inserció de genere realitzada amb èxit";
        } catch (PDOException $e) {
            echo "Error en l'inserció de genere: " . $e->getMessage();
        }
    }

    public function consultaDesenvolupador() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM desenvolupador");
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "Error en la consulta de desenvolupador: " . $e->getMessage();
        }
    }

    public function consultaPlataforma() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM plataforma");
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "Error en la consulta de plataforma: " . $e->getMessage();
        }
    }

    public function consultaGenere() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM genere");
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "Error en la consulta de genere: " . $e->getMessage();
        }
    }

    public function consultaPerId($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM videojocs WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
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

