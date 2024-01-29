<!DOCTYPE html>
<html>
<head>
    <title>Gestion des étudiants</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un étudiant</h1>
        <form action="ajouter_etudiant.php" method="post">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" class="form-control" id="prenom" name="prenom">
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

        <h1>Liste des étudiants</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'Etudiant.php'; // Include the Etudiant class file
                try {
                    $etudiant = new Etudiant('', '', '');
                    $students = $etudiant->all();
                    foreach ($students as $student) {
                        echo "<tr>";
                        echo "<td>" . $student['nom'] . "</td>";
                        echo "<td>" . $student['prenom'] . "</td>";
                        echo "<td>" . $student['email'] . "</td>";
                        echo "</tr>";
                    }
                } catch (Exception $e) {
                    echo "Erreur : " . $e->getMessage();
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
