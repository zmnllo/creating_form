<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

// Ajouter un exercice librement (sans liste prédéfinie)
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
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        body { 
            font-family: Montserrat;  
            text-align: center; 
            background:#0D0D0D; 
            color: #ebebeb; 
        }
        form { 
            display: inline-block; 
            padding: 20px; 
            border-radius: 10px; 
            background: radial-gradient(circle, #2B3C43, #1E2A2F);  
        }
        input, button { 
            padding: 10px;
            margin: 10px;
            width: 250px;
            border-radius: 20px;
            background:rgba(13, 13, 13, 0.4);
            color: #ebebeb;
            border: 0px;
        }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { border: 1px solid #232323; padding: 10px; text-align: center; }
        th { background-color: #232323; }
        .back-link {             
            display: block;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
            font-weight: bold; 
        }
        .back-link:hover {
            text-decoration: underline;
        }     
        .add-button { 
            margin: 15px;
            display: inline-block; 
            margin-top: 20px; 
            padding: 10px 15px; 
            background: linear-gradient(180deg, #df3e3f, #e55a1c);
            color: white; 
            text-decoration: none; 
            border-radius: 5px; 
            border: none;
        }
    </style>
</head>
<body>

<h1>Ajouter un exercice</h1>
<form method="post">
    <label>Nom de l'exercice :</label>
    <input type="text" name="nom_exercice" required>
    <button class="add-button" type="submit">Ajouter</button>
</form>

<h2>Liste des exercices existants</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nom de l'exercice</th>
    </tr>
    <?php foreach ($exercices as $exo) { ?>
        <tr>
            <td><?= $exo['id_exercice_type'] ?></td>
            <td><?= htmlspecialchars($exo['nom_exercice']) ?></td>
        </tr>
    <?php } ?>
</table>

<a href="exercice.php" class="back-link">Retour</a>

</body>
</html>
