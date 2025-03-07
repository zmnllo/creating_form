<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

// Ajouter un exercice dans exercice_type
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_exercice = trim($_POST['nom_exercice']);

    if (!empty($nom_exercice)) {
        $query = "INSERT INTO exercice_type (nom_exercice) VALUES (:nom_exercice)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom_exercice', $nom_exercice, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            header("Location: exercices.php?success=ajout");
            exit();
        } else {
            echo "Erreur lors de l'ajout.";
        }
    } else {
        echo "Veuillez entrer un nom d'exercice.";
    }
}

// Récupérer la liste des exercices existants
$queryExercices = "SELECT * FROM exercice_type ORDER BY nom_exercice ASC";
$stmt = $pdo->query($queryExercices);
$exercices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des exercices</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        form { display: inline-block; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
        input, button { padding: 10px; margin: 10px; width: 250px; }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 10px; text-align: center; }
        .back-link { display: block; margin-top: 15px; color: #3498db; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<h1>Ajouter un nouvel exercice</h1>
<form method="post">
    <label>Nom de l'exercice :</label>
    <input type="text" name="nom_exercice" required>
    <button type="submit">Ajouter</button>
</form>

<h2>Liste des exercices existants</h2>
<table>
    <tr>
        <th>Nom de l'exercice</th>
    </tr>
    <?php foreach ($exercices as $exo) { ?>
        <tr>
            <td><?= htmlspecialchars($exo['nom_exercice']) ?></td>
        </tr>
    <?php } ?>
</table>

<a href="../admin.php" class="back-link">Retour</a>

</body>
</html>
