<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../bdd.php'; // Connexion à la base de données

$successMessage = "";
$errorMessage = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['nom_abonnement']) && !empty($_POST['prix_abonnement'])) {
        $nom_abonnement = htmlspecialchars($_POST['nom_abonnement']);
        $prix_abonnement = floatval($_POST['prix_abonnement']);

        // Insérer l'abonnement dans la base de données
        $query = "INSERT INTO abonnement (nom_abonnement, prix_abonnement) VALUES (:nom_abonnement, :prix_abonnement)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom_abonnement', $nom_abonnement, PDO::PARAM_STR);
        $stmt->bindParam(':prix_abonnement', $prix_abonnement, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: abonnements.php?success=ajout");
            exit;
        } else {
            $errorMessage = "Erreur lors de l'ajout de l'abonnement.";
        }
    } else {
        $errorMessage = "Tous les champs doivent être remplis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un abonnement</title>

</head>
<body>

    <h1>Ajouter un abonnement</h1>

    <!-- Messages de succès ou d'erreur -->
    <?php if (!empty($successMessage)) { echo "<p class='success'>$successMessage</p>"; } ?>
    <?php if (!empty($errorMessage)) { echo "<p class='error'>$errorMessage</p>"; } ?>

    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom_abonnement" required>

        <label>Prix (€) :</label>
        <input type="number" name="prix_abonnement" step="1" required>

        <button type="submit">Ajouter</button>
    </form>

    <br>
    <a href="abonnements.php">Retour</a>

</body>
</html>
