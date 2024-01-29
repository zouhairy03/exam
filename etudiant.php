<?php
class Etudiant {
    private $nom;
    private $prenom;
    private $email;
    private $pdo;

    public function __construct($nom, $prenom, $email) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->pdo = $this->connect_db();
    }

    public function add() {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO etudiants (nom, prenom, email) VALUES (:nom, :prenom, :email)");
            $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout de l'étudiant : " . $e->getMessage());
        }
    }

    public function all() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM etudiants");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des étudiants : " . $e->getMessage());
        }
    }

    private function connect_db() {
        $host = 'localhost';
        $db = 'a';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
            return $pdo;
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
}
?>
