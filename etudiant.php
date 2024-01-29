<?php

require_once 'db.php';

class Etudiant {
    private $nom;
    private $prenom;
    private $email;
    private $db;

    public function __construct($nom, $prenom, $email) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->db = new Database();
    }

    public function add() {
        try {
            $conn = $this->db->connect_db();
            $query = "INSERT INTO etudiants (nom, prenom, email) VALUES (:nom, :prenom, :email)";
            $stmt = $conn->prepare($query);

            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':prenom', $this->prenom);
            $stmt->bindParam(':email', $this->email);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Erreur lors de l\'ajout de l\'étudiant : ' . $e->getMessage());
        }
    }

    public function all() {
        try {
            $conn = $this->db->connect_db();
            $query = "SELECT * FROM etudiants";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Erreur lors de la récupération des étudiants : ' . $e->getMessage());
        }
    }
}

?>
