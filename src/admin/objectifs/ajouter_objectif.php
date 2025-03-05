<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_objectif = filter_input(INPUT_POST, 'nom_objectif', FILTER_SANITIZE_STRING);

    switch (true) {
        case empty($nom_objectif):
            $errorMessage = "Le nom de l'objectif ne peut pas être vide.";
            break;

        default:
            $nom_objectif = trim($nom_objectif);

            $query = "INSERT INTO objectif (nom_objectif) VALUES (:nom_objectif)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nom_objectif', $nom_objectif, PDO::PARAM_STR);

            if ($stmt->execute()) {
                header("Location: objectifs.php?success=ajout");
                exit();
            } else {
                $errorMessage = "Erreur lors de l'ajout de l'objectif.";
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un objectif</title>
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

    <h1>Ajouter un objectif</h1>

    <?php if (!empty($successMessage)) : ?>
        <p class="success"><?= $successMessage ?></p>
    <?php endif; ?>

    <?php if (!empty($errorMessage)) : ?>
        <p class="error"><?= $errorMessage ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom_objectif" required>

        <button type="submit">Ajouter</button>
    </form>

    <a href="objectifs.php" class="back-link">Retour</a>

</body>
</html>
