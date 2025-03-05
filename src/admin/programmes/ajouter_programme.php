<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

$successMessage = "";
$errorMessage = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['nom_programme'])) {
        $nom_programme = htmlspecialchars($_POST['nom_programme']);

        // Insérer le prog dans la bdd
        $query = "INSERT INTO programme (nom_programme) VALUES (:nom_programme)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom_programme', $nom_programme, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: programmes.php?success=ajout");
            exit;
        } else {
            $errorMessage = "Erreur lors de l'ajout du programme.";
        }
    } else {
        $errorMessage = "Le champ doit être rempli.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un programme</title>
</head>
<body>

    <h1>Ajouter un programme</h1>

    <?php if (!empty($errorMessage)) { echo "<p style='color:red;'>$errorMessage</p>"; } ?>

    <form method="post">
        <label>Nom du programme :</label>
        <input type="text" name="nom_programme" required>
        <button type="submit">Ajouter</button>
    </form>

    <br>
    <a href="programmes.php">Retour</a>

</body>
</html>
