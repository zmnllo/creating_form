<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../bdd.php'; 

$id_objectif = filter_input(INPUT_GET, 'id_objectif', FILTER_VALIDATE_INT);

if (!$id_objectif) {
    die("Erreur : Aucun ID d'objectif valide reçu.");
}

$query = "SELECT * FROM objectif WHERE id_objectif = :id_objectif";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_objectif', $id_objectif, PDO::PARAM_INT);
$stmt->execute();
$objectif = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$objectif) {
    die("Erreur : Objectif introuvable.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_objectif = filter_input(INPUT_POST, 'nom_objectif', FILTER_SANITIZE_STRING);

    if (!empty($nom_objectif)) {
        $nom_objectif = trim($nom_objectif);

        $updateQuery = "UPDATE objectif SET nom_objectif = :nom_objectif WHERE id_objectif = :id_objectif";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':nom_objectif', $nom_objectif, PDO::PARAM_STR);
        $stmt->bindParam(':id_objectif', $id_objectif, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: objectifs.php?success=modification");
            exit();
        } else {
            die("Erreur lors de la mise à jour.");
        }
    } else {
        die("Le champ est vide.");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Objectif</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        form { display: inline-block; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
        input, button {
            padding: 10px;
            margin: 10px;
            width: 250px;
        }
        .back-link { display: block; margin-top: 20px; text-decoration: none; color: #3498db; font-weight: bold; }
    </style>
</head>
<body>

    <h1>Modifier un Objectif</h1>

    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom_objectif" value="<?= htmlspecialchars($objectif['nom_objectif']) ?>" required>

        <button type="submit">Mettre à jour</button>
    </form>

    <a href="objectifs.php" class="back-link">Retour</a>

</body>
</html>
