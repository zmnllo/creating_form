<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

// Vérifier si un ID d'exercice est reçu et valide
$id_exercice_type = filter_input(INPUT_GET, 'id_exercice_type', FILTER_VALIDATE_INT);

if (!$id_exercice_type) {
    die("Erreur : Aucun ID d'exercice valide reçu.");
}

// Récupérer l'exercice à modifier
$query = "SELECT * FROM exercice_type WHERE id_exercice_type = :id_exercice_type";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_exercice_type', $id_exercice_type, PDO::PARAM_INT);
$stmt->execute();
$exercice = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$exercice) {
    die("Erreur : Exercice introuvable. Vérifie si l'ID existe bien en base.");
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_exercice = trim($_POST['nom_exercice']);

    if (empty($nom_exercice)) {
        echo "Erreur : Le nom de l'exercice ne peut pas être vide.";
    } else {
        // Mise à jour du nom de l'exercice
        $updateQuery = "UPDATE exercice_type SET nom_exercice = :nom_exercice WHERE id_exercice_type = :id_exercice_type";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':nom_exercice', $nom_exercice, PDO::PARAM_STR);
        $stmt->bindParam(':id_exercice_type', $id_exercice_type, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: exercices.php?success=modification");
            exit();
        } else {
            echo "Erreur lors de la modification.";
            var_dump($stmt->errorInfo());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un exercice</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        body { 
            font-family: Montserrat; 
            text-align: center; 
            margin-top: 50px; 
            background:#0D0D0D; 
            color: #ebebeb; 
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
        form {
            display: inline-block;
            padding: 20px;
            border-radius: 10px;
            background: radial-gradient(circle, #2B3C43, #1E2A2F);
        }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
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

        .add-button:hover {
            background: linear-gradient(180deg,rgb(173, 53, 53),rgb(182, 75, 26));

        }
    </style>
</head>
<body>

<h1>Modifier un exercice</h1>

<form method="post">
    <label>Nom de l'exercice :</label>
    <input type="text" name="nom_exercice" value="<?= htmlspecialchars($exercice['nom_exercice']) ?>" required>
    <button class="add-button" type="submit">Mettre à jour</button>
</form>

<br>
<a href="exercices.php" class="back-link">Retour</a>

</body>
</html>
