<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

$successMessage = "";
$errorMessage = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_abonnement = filter_input(INPUT_POST, 'nom_abonnement', FILTER_SANITIZE_STRING);
    $prix_abonnement = filter_input(INPUT_POST, 'prix_abonnement', FILTER_VALIDATE_FLOAT);

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
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        form { display: inline-block; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
        input, button {
            padding: 10px;
            margin: 10px;
            width: 250px;
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
        }     </style>
</head>
<body>

    <h1>Ajouter un Abonnement</h1>

    <!-- Affichage des messages -->
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

        <button type="submit">Ajouter</button>
    </form>

    <a href="abonnements.php" class="back-link">Retour</a>

</body>
</html>
