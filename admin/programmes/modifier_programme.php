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

// Récupérer le programme actuel
$query = "SELECT * FROM programme WHERE id_programme = :id_programme";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_programme', $id_programme, PDO::PARAM_INT);
$stmt->execute();
$programme = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$programme) {
    die("Erreur : Programme introuvable.");
}

// Récupérer les objectifs et niveaux
$objectifs = $pdo->query("SELECT * FROM objectif")->fetchAll(PDO::FETCH_ASSOC);
$niveaux = $pdo->query("SELECT * FROM niveau")->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les exercices du programme
$queryExercices = "SELECT e.*, et.nom_exercice 
                   FROM exercice e 
                   JOIN exercice_type et ON e.id_exercice_type = et.id_exercice_type
                   WHERE e.id_programme = :id_programme";
$stmtExercices = $pdo->prepare($queryExercices);
$stmtExercices->bindParam(':id_programme', $id_programme, PDO::PARAM_INT);
$stmtExercices->execute();
$exercices = $stmtExercices->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les types d'exercices
$typesExercices = $pdo->query("SELECT * FROM exercice_type")->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si le formulaire est soumis
$successMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_programme'])) {
        // Mise à jour du programme
        $nom_programme = $_POST['nom_programme'];
        $id_objectif = $_POST['id_objectif'];
        $id_niveau = $_POST['id_niveau'];

        $updateQuery = "UPDATE programme SET nom_programme = :nom_programme, id_objectif = :id_objectif, id_niveau = :id_niveau WHERE id_programme = :id_programme";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->execute([
            'nom_programme' => $nom_programme,
            'id_objectif' => $id_objectif,
            'id_niveau' => $id_niveau,
            'id_programme' => $id_programme
        ]);

        $successMessage = "Programme mis à jour avec succès.";
    }

    if (isset($_POST['add_exercise']) && !empty($_POST['new_exercice']['id_exercice_type'])) {
        // Ajout d'un nouvel exercice
        $id_exercice_type = $_POST['new_exercice']['id_exercice_type'];
        $repetitions = !empty($_POST['new_exercice']['repetitions']) ? $_POST['new_exercice']['repetitions'] : NULL;
        $temps = !empty($_POST['new_exercice']['temps']) ? $_POST['new_exercice']['temps'] : NULL;

        $insertExoQuery = "INSERT INTO exercice (id_programme, id_exercice_type, repetitions, temps) VALUES (:id_programme, :id_exercice_type, :repetitions, :temps)";
        $stmtInsertExo = $pdo->prepare($insertExoQuery);
        $stmtInsertExo->execute([
            'id_programme' => $id_programme,
            'id_exercice_type' => $id_exercice_type,
            'repetitions' => $repetitions,
            'temps' => $temps
        ]);

        $successMessage = "Exercice ajouté avec succès.";
    }
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
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>

<h1>Modifier le programme</h1>

<?php if (!empty($successMessage)) : ?>
    <p class="success"><?= $successMessage ?></p>
<?php endif; ?>

<!-- Formulaire de mise à jour du programme -->
<form method="post">
    <input type="hidden" name="update_programme" value="1">

    <label>Nom du programme :</label>
    <input type="text" name="nom_programme" value="<?= htmlspecialchars($programme['nom_programme']) ?>" required>

    <label>Objectif :</label>
    <select name="id_objectif">
        <?php foreach ($objectifs as $objectif) { ?>
            <option value="<?= $objectif['id_objectif'] ?>" <?= ($objectif['id_objectif'] == $programme['id_objectif']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($objectif['nom_objectif']) ?>
            </option>
        <?php } ?>
    </select>

    <label>Niveau :</label>
    <select name="id_niveau">
        <?php foreach ($niveaux as $niveau) { ?>
            <option value="<?= $niveau['id_niveau'] ?>" <?= ($niveau['id_niveau'] == $programme['id_niveau']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($niveau['nom_niveau']) ?>
            </option>
        <?php } ?>
    </select>

    <button type="submit">Enregistrer</button>
</form>

<h2>Ajouter un nouvel exercice</h2>
<!-- Formulaire d'ajout d'un exercice -->
<form method="post">
    <input type="hidden" name="add_exercise" value="1">

    <label>Exercice :</label>
    <select name="new_exercice[id_exercice_type]">
        <option value="">-- Choisir un exercice --</option>
        <?php foreach ($typesExercices as $type) { ?>
            <option value="<?= $type['id_exercice_type'] ?>"><?= htmlspecialchars($type['nom_exercice']) ?></option>
        <?php } ?>
    </select>
    <input type="text" name="new_exercice[repetitions]" placeholder="Répétitions">
    <input type="text" name="new_exercice[temps]" placeholder="Temps">
    
    <button type="submit">Ajouter</button>
</form>

<a href="programmes.php" class="back-link">Retour</a>

</body>
</html>
