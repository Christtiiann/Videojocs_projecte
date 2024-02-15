<?php
// class insertar {
// private $servername="127.0.0.1";
// private $username="root";
// private $password="iesmanacor";

//  private $conn;
//  private $jsonData;
//  private $data;

//     public function __construct() {
//         try {
//             $this->conn = new PDO("mysql:host=$this->servername;dbname=videojocs_projecte", $this->username, $this->password);
//             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             echo "Connected successfully";
//             $this->jsonData = file_get_contents("dades.json");
//             $this->data = json_decode($this->jsonData, true);
//         } catch (PDOException $e) {
//             echo "Connection failed: " . $e->getMessage();
//         }
//     }
//     public function inserir() {
//         try {
//             foreach ($this->data as $key => $videojuego) {
//                 if ($key !== "plataforma" && $videojuego !== null) {
//                     $plataforma = $videojuego['Plataforma'];
    
//                     $checkSql = "SELECT COUNT(*) FROM plataforma WHERE nom = :nom";
//                     $checkStmt = $this->conn->prepare($checkSql);
//                     $checkStmt->bindParam(':nom', $plataforma);
//                     $checkStmt->execute();
//                     $count = $checkStmt->fetchColumn();
//                     //  var_dump($this->data);
//                     if ($count == 0) {
    
//                         $insertSql = "INSERT INTO plataforma (nom) VALUES (:nom)";
//                         $insertStmt = $this->conn->prepare($insertSql);
//                         $insertStmt->bindParam(':nom', $plataforma);
//                         $insertStmt->execute();
//                     } else {
//                         echo "La plataforma '$plataforma' ya existe en la base de datos. No se realizará la inserción.";
//                     }
//                 }
//             }
//             echo "Inserció realitzada amb èxit";
//         } catch (PDOException $e) {
//             echo "Error en l'inserció: " . $e->getMessage();
//         }
//     }
// }
// //     public function inserir() {
// //         try {
// //             // var_dump($this->data);
// //             foreach ($this->data as $key => $videojuego) {
// //                 if ($key !== "plataforma" && $videojuego !== null) {
// //                     $plataforma = $videojuego['Plataforma'];
// //                     $sql = "INSERT INTO plataforma (nom) VALUES (:nom)";
// //                     $stmt = $this->conn->prepare($sql);
// //                     $stmt->bindParam(':nom', $plataforma);
// //                     $stmt->execute();
// //                 }
// //             }
// //             echo "Inserció realitzada amb èxit";
// //         } catch (PDOException $e) {
// //             echo "Error en l'inserció: " . $e->getMessage();
// //         }
// //     }
// // }

// $insertar = new insertar();
// $insertar->inserir();

?>
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
                if ($key !== "plataforma" && $videojuego !== null) {
                    $plataformas = explode(',', $videojuego['Plataforma']);
                    
                    foreach ($plataformas as $plataforma) {
                        $plataforma = trim($plataforma);

                        $checkSql = "SELECT COUNT(*) FROM plataforma WHERE nom = :nom";
                        $checkStmt = $this->conn->prepare($checkSql);
                        $checkStmt->bindParam(':nom', $plataforma);
                        $checkStmt->execute();
                        $count = $checkStmt->fetchColumn();

                        if ($count == 0) {
                            $insertSql = "INSERT INTO plataforma (nom) VALUES (:nom)";
                            $insertStmt = $this->conn->prepare($insertSql);
                            $insertStmt->bindParam(':nom', $plataforma);
                            $insertStmt->execute();
                        } else {
                            echo "La plataforma '$plataforma' ya existe en la base de datos. No se realizará la inserción.";
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


