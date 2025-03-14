<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

$successMessage = "";
$errorMessage = "";


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_abonnement = $_POST['nom_abonnement'];
    $prix_abonnement = $_POST['prix_abonnement'];

    if (!empty($nom_abonnement) && $prix_abonnement !== false) {
        // Insertion dans la base de données
        $query = "INSERT INTO abonnement (nom_abonnement, prix_abonnement) VALUES (:nom_abonnement, :prix_abonnement)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom_abonnement', $nom_abonnement, PDO::PARAM_STR);
        $stmt->bindParam(':prix_abonnement', $prix_abonnement, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Rediriger avec message de succès
            header("Location: abonnements.php?success=ajout");
            exit();
        } else {
            $errorMessage = "Erreur lors de l'ajout de l'abonnement.";
        }
    } else {
        $errorMessage = "Tous les champs doivent être remplis correctement.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Abonnement</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        body { font-family: Montserrat; 
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

    
        </style>
</head>
<body>

    <h1>Ajouter un Abonnement</h1>

    <?php if (!empty($successMessage)) : ?>
        <p class="success"><?= $successMessage ?></p>
    <?php endif; ?>

    <?php if (!empty($errorMessage)) : ?>
        <p class="error"><?= $errorMessage ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nom de l'abonnement :</label>
        <input type="text" name="nom_abonnement" required>

        <label>Prix (€) :</label>
        <input type="number" name="prix_abonnement" step="1" required>

        <button class="add-button" type="submit">Ajouter</button>
    </form>

    <a href="abonnements.php" class="back-link">Retour</a>

</body>
</html>
