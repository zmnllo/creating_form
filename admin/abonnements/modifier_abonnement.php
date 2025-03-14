<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';


$successMessage = "";
$errorMessage = "";

// Vérifier si un ID est passé dans l'URL 
$id_abonnement = filter_input(INPUT_GET, 'id_abonnement', FILTER_VALIDATE_INT);
if (!$id_abonnement) {
    die("Erreur : Aucun ID d'abonnement valide reçu.");
}

// Récupérer les infos de l'abonnement sélectionné
$query = "SELECT * FROM abonnement WHERE id_abonnement = :id_abonnement";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_abonnement', $id_abonnement, PDO::PARAM_INT);
$stmt->execute();
$abonnement = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$abonnement) {
    die("Erreur : Abonnement introuvable.");
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_abonnement = $_POST['nom_abonnement'];
    $prix_abonnement = $_POST['prix_abonnement'];

    if (!empty($nom_abonnement) && $prix_abonnement !== false) {
        $nom_abonnement = trim($nom_abonnement);

        // Mettre à jour l'abonnement en base de données
        $updateQuery = "UPDATE abonnement SET nom_abonnement = :nom_abonnement, prix_abonnement = :prix_abonnement WHERE id_abonnement = :id_abonnement";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':nom_abonnement', $nom_abonnement, PDO::PARAM_STR);
        $stmt->bindParam(':prix_abonnement', $prix_abonnement, PDO::PARAM_STR);
        $stmt->bindParam(':id_abonnement', $id_abonnement, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: abonnements.php?success=modification");
            exit();
        } else {
            $errorMessage = "Erreur lors de la mise à jour.";
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
    <title>Modifier un Abonnement</title>
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

        .add-button:hover {
            background: linear-gradient(180deg,rgb(173, 53, 53),rgb(182, 75, 26));

        }
 
        </style>
</head>
<body>

    <h1>Modifier un Abonnement</h1>

    <!-- Affichage des messages -->
    <?php if (!empty($successMessage)) : ?>
        <p class="success"><?= $successMessage ?></p>
    <?php endif; ?>

    <?php if (!empty($errorMessage)) : ?>
        <p class="error"><?= $errorMessage ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom_abonnement" value="<?= htmlspecialchars($abonnement['nom_abonnement']) ?>" required>

        <label>Prix (€) :</label>
        <input type="number" name="prix_abonnement" step="1" value="<?= htmlspecialchars($abonnement['prix_abonnement']) ?>" required>

        <button class="add-button" type="submit">Mettre à jour</button>
    </form>
    
    <a href="abonnements.php" class="back-link">Retour</a>
<style></style>
</body>
</html>
