<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'Etudiant.php'; // Include the Etudiant class file

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];

    try {
        $etudiant = new Etudiant($nom, $prenom, $email);
        $etudiant->add();
        header("Location: index.php"); // Redirect to the page that displays the list of students
        exit();
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
