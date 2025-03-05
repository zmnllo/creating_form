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
    $nom_abonnement = filter_input(INPUT_POST, 'nom_abonnement', FILTER_SANITIZE_STRING);
    $prix_abonnement = filter_input(INPUT_POST, 'prix_abonnement', FILTER_VALIDATE_FLOAT);

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
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        form { display: inline-block; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
        input, button {
            padding: 10px;
            margin: 10px;
            width: 250px;
        }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .back-link { display: block; margin-top: 20px; text-decoration: none; color: #3498db; font-weight: bold; }
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

        <button type="submit">Mettre à jour</button>
    </form>

    <a href="abonnements.php" class="back-link">Retour</a>

</body>
</html>
