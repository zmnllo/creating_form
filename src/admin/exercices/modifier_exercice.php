<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

$id_exercice = filter_input(INPUT_GET, 'id_exercice', FILTER_VALIDATE_INT);
if (!$id_exercice) {
    die("Erreur : Aucun ID d'exercice valide reçu.");
}

$query = "SELECT * FROM exercice WHERE id_exercice = :id_exercice";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_exercice', $id_exercice, PDO::PARAM_INT);
$stmt->execute();
$exercice = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$exercice) {
    die("Erreur : Exercice introuvable.");
}

$typesQuery = "SELECT * FROM exercice_type";
$typesStmt = $pdo->query($typesQuery);
$types = $typesStmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_exercice_type = filter_input(INPUT_POST, 'id_exercice_type', FILTER_VALIDATE_INT);
    $repetitions = !empty($_POST['repetitions']) ? $_POST['repetitions'] : NULL;
    $temps = !empty($_POST['temps']) ? $_POST['temps'] : NULL;

    if (!$id_exercice_type) {
        echo "Erreur : Type d'exercice invalide.";
    } else {
        $updateQuery = "UPDATE exercice SET id_exercice_type = :id_exercice_type, repetitions = :repetitions, temps = :temps WHERE id_exercice = :id_exercice";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':id_exercice_type', $id_exercice_type, PDO::PARAM_INT);
        $stmt->bindParam(':repetitions', $repetitions);
        $stmt->bindParam(':temps', $temps);
        $stmt->bindParam(':id_exercice', $id_exercice, PDO::PARAM_INT);

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
        body { font-family: Arial, sans-serif; text-align: center; }
        form { display: inline-block; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
        select, input, button { padding: 10px; margin: 10px; width: 250px; }
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
        }    </style>
</head>
<body>

<h1>Modifier un exercice</h1>

<form method="post">
    <label>Exercice :</label>
    <select name="id_exercice_type" required>
        <?php foreach ($types as $type) { ?>
            <option value="<?= $type['id_exercice_type'] ?>" <?= $type['id_exercice_type'] == $exercice['id_exercice_type'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($type['nom_exercice']) ?>
            </option>
        <?php } ?>
    </select>

    <label>Répétitions :</label>
    <input type="text" name="repetitions" value="<?= htmlspecialchars($exercice['repetitions'] ?? '') ?>">

    <label>Temps :</label>
    <input type="text" name="temps" value="<?= htmlspecialchars($exercice['temps'] ?? '') ?>">
    <button type="submit">Mettre à jour</button>
</form>

<br>
<a href="exercices.php" class="back-link">Retour</a>

</body>
</html>
