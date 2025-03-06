<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

// Récupérer les objectifs
$queryObjectifs = "SELECT * FROM objectif";
$stmtObjectifs = $pdo->query($queryObjectifs);
$objectifs = $stmtObjectifs->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_programme = htmlspecialchars($_POST['nom_programme']);
    $id_objectif = intval($_POST['id_objectif']);
    $niveau = $_POST['niveau'];

    if (!empty($nom_programme) && !empty($id_objectif) && !empty($niveau)) {
        $query = "INSERT INTO programme (nom_programme, id_objectif, niveau) VALUES (:nom_programme, :id_objectif, :niveau)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom_programme', $nom_programme, PDO::PARAM_STR);
        $stmt->bindParam(':id_objectif', $id_objectif, PDO::PARAM_INT);
        $stmt->bindParam(':niveau', $niveau, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: programmes.php?success=ajout");
            exit();
        } else {
            echo "Erreur lors de l'ajout du programme.";
        }
    } else {
        echo "Tous les champs doivent être remplis.";
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Programme</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; background-color: #f9f9f9; }
        form { display: inline-block; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: white; }
        input, select, button {
            padding: 10px;
            margin: 10px;
            width: 250px;
        }
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
        }     </style>
</head>
<body>

    <h1>Ajouter un Programme</h1>

    <!-- Affichage des messages -->
    <?php if (!empty($successMessage)) : ?>
        <p class="success"><?= $successMessage ?></p>
    <?php endif; ?>

    <?php if (!empty($errorMessage)) : ?>
        <p class="error"><?= $errorMessage ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nom du programme :</label>
        <input type="text" name="nom_programme" required>

        <label>Objectif associé :</label>
        <select name="id_objectif" required>
            <option value="">Sélectionnez un objectif</option>
            <?php foreach ($objectifs as $objectif): ?>
                <option value="<?= $objectif['id_objectif'] ?>"><?= htmlspecialchars($objectif['nom_objectif']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Niveau :</label>
    <select name="niveau" required>
        <option value="">Sélectionner un niveau</option>
        <option value="Débutant">Débutant</option>
        <option value="Intermédiaire">Intermédiaire</option>
        <option value="Avancé">Avancé</option>
    </select>

        <button type="submit">Ajouter</button>
    </form>

    <a href="programmes.php" class="back-link">Retour</a>

</body>
</html>
