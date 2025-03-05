<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

// Verif si l'id est passé
$id_programme = filter_input(INPUT_GET, 'id_programme', FILTER_VALIDATE_INT);
if (!$id_programme) {
    die("Erreur : Aucun ID de programme valide reçu.");
}

// Récupération des programmes
$query = "SELECT * FROM programme WHERE id_programme = :id_programme";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_programme', $id_programme, PDO::PARAM_INT);
$stmt->execute();
$programme = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$programme) {
    die("Erreur : Programme introuvable.");
}

// Récupérer les exos du programme
$queryExercices = "SELECT e.*, et.nom_exercice 
                   FROM exercice e 
                   JOIN exercice_type et ON e.id_exercice_type = et.id_exercice_type
                   WHERE e.id_programme = :id_programme";
$stmtExercices = $pdo->prepare($queryExercices);
$stmtExercices->bindParam(':id_programme', $id_programme, PDO::PARAM_INT);
$stmtExercices->execute();
$exercices = $stmtExercices->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les types d'exos
$queryTypes = "SELECT * FROM exercice_type";
$stmtTypes = $pdo->query($queryTypes);
$typesExercices = $stmtTypes->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Modification du nom du prog
    if (!empty($_POST['nom_programme'])) {
        $nom_programme = $_POST['nom_programme'];
        $updateQuery = "UPDATE programme SET nom_programme = :nom_programme WHERE id_programme = :id_programme";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':nom_programme', $nom_programme, PDO::PARAM_STR);
        $stmt->bindParam(':id_programme', $id_programme, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Modification des exos existants
    if (!empty($_POST['exercices'])) {
        foreach ($_POST['exercices'] as $id_exercice => $data) {
            $id_exercice_type = $data['id_exercice_type'];
            $repetitions = !empty($data['repetitions']) ? $data['repetitions'] : NULL;
            $temps = !empty($data['temps']) ? $data['temps'] : NULL;

            $updateExoQuery = "UPDATE exercice SET id_exercice_type = :id_exercice_type, repetitions = :repetitions, temps = :temps WHERE id_exercice = :id_exercice";
            $stmtExo = $pdo->prepare($updateExoQuery);
            $stmtExo->bindParam(':id_exercice_type', $id_exercice_type, PDO::PARAM_INT);
            $stmtExo->bindParam(':repetitions', $repetitions);
            $stmtExo->bindParam(':temps', $temps);
            $stmtExo->bindParam(':id_exercice', $id_exercice, PDO::PARAM_INT);
            $stmtExo->execute();
        }
    }

    // Ajout d'un exo
    if (!empty($_POST['new_exercice']['id_exercice_type'])) {
        $id_exercice_type = $_POST['new_exercice']['id_exercice_type'];
        $repetitions = !empty($_POST['new_exercice']['repetitions']) ? $_POST['new_exercice']['repetitions'] : NULL;
        $temps = !empty($_POST['new_exercice']['temps']) ? $_POST['new_exercice']['temps'] : NULL;

        $insertExoQuery = "INSERT INTO exercice (id_programme, id_exercice_type, repetitions, temps) VALUES (:id_programme, :id_exercice_type, :repetitions, :temps)";
        $stmtInsertExo = $pdo->prepare($insertExoQuery);
        $stmtInsertExo->bindParam(':id_programme', $id_programme, PDO::PARAM_INT);
        $stmtInsertExo->bindParam(':id_exercice_type', $id_exercice_type, PDO::PARAM_INT);
        $stmtInsertExo->bindParam(':repetitions', $repetitions);
        $stmtInsertExo->bindParam(':temps', $temps);
        $stmtInsertExo->execute();
    }

    header("Location: programmes.php?success=modification");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un programme</title>
    <style>
        body { font-family: Montserrat, sans-serif; text-align: center; }
        form { display: inline-block; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
        select, input, button { padding: 10px; margin: 10px; width: 250px; }
    </style>
</head>
<body>

<h1>Modifier le programme : <?= htmlspecialchars($programme['nom_programme']) ?></h1>

<form method="post">
    <label>Nom du programme :</label>
    <input type="text" name="nom_programme" value="<?= htmlspecialchars($programme['nom_programme']) ?>" required>

    <h2>Modifier les exercices</h2>
    <?php foreach ($exercices as $exo) { ?>
        <div>
            <label>Exercice :</label>
            <select name="exercices[<?= $exo['id_exercice'] ?>][id_exercice_type]">
                <?php foreach ($typesExercices as $type) { ?>
                    <option value="<?= $type['id_exercice_type'] ?>" <?= $type['id_exercice_type'] == $exo['id_exercice_type'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($type['nom_exercice']) ?>
                    </option>
                <?php } ?>
            </select>
            <input type="text" name="exercices[<?= $exo['id_exercice'] ?>][repetitions]" value="<?= htmlspecialchars($exo['repetitions'] ?? '') ?>" placeholder="Répétitions">
            <input type="text" name="exercices[<?= $exo['id_exercice'] ?>][temps]" value="<?= htmlspecialchars($exo['temps'] ?? '') ?>" placeholder="Temps">
        </div>
    <?php } ?>

    <h2>Ajouter un nouvel exercice</h2>
    <div>
        <label>Exercice :</label>
        <select name="new_exercice[id_exercice_type]">
            <option value="">-- Choisir un exercice --</option>
            <?php foreach ($typesExercices as $type) { ?>
                <option value="<?= $type['id_exercice_type'] ?>"><?= htmlspecialchars($type['nom_exercice']) ?></option>
            <?php } ?>
        </select>
        <input type="text" name="new_exercice[repetitions]" placeholder="Répétitions">
        <input type="text" name="new_exercice[temps]" placeholder="Temps">
    </div>

    <button type="submit">Mettre à jour</button>
</form>

<br>
<a href="programmes.php">Retour</a>

</body>
</html>
