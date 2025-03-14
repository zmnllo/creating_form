<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

$successMessage = "";
$errorMessage = "";

// Récupérer les objectifs existants
$queryObjectifs = "SELECT * FROM objectif";
$stmtObjectifs = $pdo->query($queryObjectifs);
$objectifs = $stmtObjectifs->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les niveaux existants
$queryNiveaux = "SELECT * FROM niveau";
$stmtNiveaux = $pdo->query($queryNiveaux);
$niveaux = $stmtNiveaux->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_programme = trim($_POST['nom_programme']);
    $id_objectif = filter_input(INPUT_POST, 'id_objectif', FILTER_VALIDATE_INT);
    $id_niveau = filter_input(INPUT_POST, 'id_niveau', FILTER_VALIDATE_INT);

    if (!empty($nom_programme) && $id_objectif !== false && $id_niveau !== false) {
        $query = "INSERT INTO programme (nom_programme, id_objectif, id_niveau) VALUES (:nom_programme, :id_objectif, :id_niveau)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom_programme', $nom_programme, PDO::PARAM_STR);
        $stmt->bindParam(':id_objectif', $id_objectif, PDO::PARAM_INT);
        $stmt->bindParam(':id_niveau', $id_niveau, PDO::PARAM_INT);
        

        if ($stmt->execute()) {
            header("Location: programmes.php?success=ajout");
            exit();
        } else {
            $errorMessage = "Erreur lors de l'ajout du programme.";
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
    <title>Ajouter un Programme</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        body { 
            font-family: Montserrat; 
            text-align: center; 
            margin-top: 50px; 
            background:#0D0D0D; 
            color: #ebebeb; 
        }
        form { 
            display: inline-block; 
            padding: 20px;  
            border-radius: 10px; 
            background: radial-gradient(circle, #2B3C43, #1E2A2F); 
        }
        input, select, button { 
            padding: 10px;
            margin: 10px;
            width: 250px;
            border-radius: 20px;
            background:rgba(13, 13, 13, 0.4);
            color: #ebebeb;
            border: 0px;
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
        }     
        .add-button { 
            margin: 15px;
            display: inline-block; 
            margin-top: 20px; 
            padding: 10px 15px; 
            background: linear-gradient(180deg, #df3e3f, #e55a1c);
            color: white; 
            text-decoration: none; 
            border-radius: 5px; 
            border: none;
        }
    </style>
</head>
<body>

<h1>Ajouter un Programme</h1>

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
    <select name="id_niveau" required>
        <option value="">Sélectionner un niveau</option>
        <?php foreach ($niveaux as $niveau): ?>
            <option value="<?= $niveau['id_niveau'] ?>"><?= htmlspecialchars($niveau['nom_niveau']) ?></option>
        <?php endforeach; ?>
    </select>

    <button class="add-button" type="submit">Ajouter</button>
</form>

<a href="programmes.php" class="back-link">Retour</a>

</body>
</html>
