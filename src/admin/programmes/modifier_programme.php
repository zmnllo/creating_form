<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

// Vérifier si un ID de programme est reçu
$id_programme = filter_input(INPUT_GET, 'id_programme', FILTER_VALIDATE_INT);
if (!$id_programme) {
    die("Erreur : Aucun ID de programme valide reçu.");
}

// Récupérer les détails du programme
$query = "SELECT * FROM programme WHERE id_programme = :id_programme";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_programme', $id_programme, PDO::PARAM_INT);
$stmt->execute();
$programme = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$programme) {
    die("Erreur : Programme introuvable.");
}

// Récupérer les objectifs disponibles
$queryObjectifs = "SELECT * FROM objectif";
$stmtObjectifs = $pdo->query($queryObjectifs);
$objectifs = $stmtObjectifs->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les exercices existants du programme
$queryExercices = "SELECT e.*, et.nom_exercice 
                   FROM exercice e 
                   JOIN exercice_type et ON e.id_exercice_type = et.id_exercice_type
                   WHERE e.id_programme = :id_programme";
$stmtExercices = $pdo->prepare($queryExercices);
$stmtExercices->bindParam(':id_programme', $id_programme, PDO::PARAM_INT);
$stmtExercices->execute();
$exercices = $stmtExercices->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les types d'exercices
$queryTypes = "SELECT * FROM exercice_type";
$stmtTypes = $pdo->query($queryTypes);
$typesExercices = $stmtTypes->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_programme = trim($_POST['nom_programme']);
    $id_objectif = isset($_POST['id_objectif']) ? intval($_POST['id_objectif']) : null;
    $niveau = trim($_POST['niveau']); // Débutant, Intermédiaire, Avancé

    // Vérifier que tous les champs requis sont remplis
    if (!empty($nom_programme) && !empty($id_objectif) && !empty($niveau)) {
        $updateQuery = "UPDATE programme 
                        SET nom_programme = :nom_programme, id_objectif = :id_objectif, niveau = :niveau 
                        WHERE id_programme = :id_programme";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':nom_programme', $nom_programme, PDO::PARAM_STR);
        $stmt->bindParam(':id_objectif', $id_objectif, PDO::PARAM_INT);
        $stmt->bindParam(':niveau', $niveau, PDO::PARAM_STR);
        $stmt->bindParam(':id_programme', $id_programme, PDO::PARAM_INT);
        $stmt->execute();
    } else {
        die("Erreur : Tous les champs sont obligatoires.");
    }

    // Modifier les exercices existants
    if (!empty($_POST['exercices'])) {
        foreach ($_POST['exercices'] as $id_exercice => $data) {
            if (!empty($data['id_exercice_type'])) {
                $id_exercice_type = $data['id_exercice_type'];
                $repetitions = !empty($data['repetitions']) ? $data['repetitions'] : null;
                $temps = !empty($data['temps']) ? $data['temps'] : null;

                $updateExoQuery = "UPDATE exercice 
                                   SET id_exercice_type = :id_exercice_type, repetitions = :repetitions, temps = :temps 
                                   WHERE id_exercice = :id_exercice";
                $stmtExo = $pdo->prepare($updateExoQuery);
                $stmtExo->bindParam(':id_exercice_type', $id_exercice_type, PDO::PARAM_INT);
                $stmtExo->bindParam(':repetitions', $repetitions);
                $stmtExo->bindParam(':temps', $temps);
                $stmtExo->bindParam(':id_exercice', $id_exercice, PDO::PARAM_INT);
                $stmtExo->execute();
            }
        }
    }

    // Ajouter un nouvel exercice
    if (!empty($_POST['new_exercice']['id_exercice_type'])) {
        $id_exercice_type = $_POST['new_exercice']['id_exercice_type'];
        $repetitions = !empty($_POST['new_exercice']['repetitions']) ? $_POST['new_exercice']['repetitions'] : null;
        $temps = !empty($_POST['new_exercice']['temps']) ? $_POST['new_exercice']['temps'] : null;

        $insertExoQuery = "INSERT INTO exercice (id_programme, id_exercice_type, repetitions, temps) 
                           VALUES (:id_programme, :id_exercice_type, :repetitions, :temps)";
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
        body { font-family: Arial, sans-serif; text-align: center; }
        form { display: inline-block; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; }
        select, input, button { padding: 10px; margin: 10px; width: 250px; }
        .back-link { display: block; margin-top: 15px; color: #3498db; text-decoration: none; font-weight: bold; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h1>Modifier le programme : <?= htmlspecialchars($programme['nom_programme']) ?></h1>

<form method="post">
    <label>Nom du programme :</label>
    <input type="text" name="nom_programme" value="<?= htmlspecialchars($programme['nom_programme']) ?>" required>

    <label>Objectif :</label>
    <select name="id_objectif" required>
        <?php foreach ($objectifs as $objectif) { ?>
            <option value="<?= $objectif['id_objectif'] ?>" <?= ($objectif['id_objectif'] == $programme['id_objectif']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($objectif['nom_objectif']) ?>
            </option>
        <?php } ?>
    </select>

    <label>Niveau :</label>
    <select name="niveau" required>
        <option value="Débutant" <?= ($programme['niveau'] == 'Débutant') ? 'selected' : '' ?>>Débutant</option>
        <option value="Intermédiaire" <?= ($programme['niveau'] == 'Intermédiaire') ? 'selected' : '' ?>>Intermédiaire</option>
        <option value="Avancé" <?= ($programme['niveau'] == 'Avancé') ? 'selected' : '' ?>>Avancé</option>
    </select>

    <button type="submit">Mettre à jour</button>
</form>

<a href="programmes.php" class="back-link">Retour</a>

</body>
</html>
