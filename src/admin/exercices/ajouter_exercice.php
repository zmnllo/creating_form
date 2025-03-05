<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_exercice_type = $_POST['id_exercice_type'];
    $repetitions = !empty($_POST['repetitions']) ? $_POST['repetitions'] : NULL;
    $temps = !empty($_POST['temps']) ? $_POST['temps'] : NULL;

    $query = "INSERT INTO exercice (id_exercice_type, repetitions, temps) VALUES (:id_exercice_type, :repetitions, :temps)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_exercice_type', $id_exercice_type, PDO::PARAM_INT);
    $stmt->bindParam(':repetitions', $repetitions);
    $stmt->bindParam(':temps', $temps);

    if ($stmt->execute()) {
        header("Location: exercices.php?success=ajout");
        exit();
    } else {
        echo "Erreur lors de l'ajout.";
    }
}

$typesQuery = "SELECT * FROM exercice_type";
$typesStmt = $pdo->query($typesQuery);
$types = $typesStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un exercice</title>
</head>
<body>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un exercice</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        form { display: inline-block; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
        select, input, button { padding: 10px; margin: 10px; width: 250px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .back-link { display: block; margin-top: 20px; text-decoration: none; color: #3498db; font-weight: bold; }
        .submit-btn { background-color: #2ecc71; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>

<h1>Ajouter un exercice</h1>

<form method="post">
    <label>Exercice :</label>
    <select name="id_exercice_type" required>
        <?php foreach ($types as $type) { ?>
            <option value="<?= $type['id_exercice_type'] ?>"><?= htmlspecialchars($type['nom_exercice']) ?></option>
        <?php } ?>
    </select>

    <label>Répétitions :</label>
    <input type="text" name="repetitions">

    <label>Temps :</label>
    <input type="text" name="temps">

    <button class="submit-btn" type="submit">Ajouter</button>
</form>

<a href="exercices.php" class="back-link">Retour</a>

</body>
</html>


