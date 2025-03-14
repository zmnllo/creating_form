<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

// Vérifier s'il y a un message de succès ou d'erreur
$successMessage = $_SESSION['success_message'] ?? "";
$errorMessage = $_SESSION['error_message'] ?? "";
unset($_SESSION['success_message'], $_SESSION['error_message']);

// Requête pour récupérer tous les programmes avec leur objectif, niveau et exercices
$query = "SELECT 
    p.id_programme, p.nom_programme, 
    o.nom_objectif, 
    n.nom_niveau,
    e.id_exercice, e.repetitions, e.temps, 
    et.nom_exercice
FROM programme p
LEFT JOIN objectif o ON p.id_objectif = o.id_objectif
LEFT JOIN niveau n ON p.id_niveau = n.id_niveau
LEFT JOIN exercice e ON p.id_programme = e.id_programme
LEFT JOIN exercice_type et ON e.id_exercice_type = et.id_exercice_type
ORDER BY p.id_programme, e.id_exercice";

$stmt = $pdo->prepare($query);
$stmt->execute();
$programmes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organisation des programmes pour affichage
$programmeData = [];

foreach ($programmes as $prog) {
    $id_programme = $prog['id_programme'];

    if (!isset($programmeData[$id_programme])) {
        $programmeData[$id_programme] = [
            'nom_programme' => $prog['nom_programme'],
            'nom_objectif' => $prog['nom_objectif'],
            'nom_niveau' => $prog['nom_niveau'],
            'exercices' => []
        ];
    }

    if (!empty($prog['nom_exercice'])) {
        $programmeData[$id_programme]['exercices'][] = [
            'id_exercice' => $prog['id_exercice'],
            'nom_exercice' => $prog['nom_exercice'],
            'repetitions' => $prog['repetitions'] ?? '-',
            'temps' => $prog['temps'] ?? '-'
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Programmes</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        body { font-family: Montserrat; text-align: center; background:#0D0D0D; color: #ebebeb;}
        table { width: 90%; margin: auto; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #232323; padding: 10px; text-align: center; }
        th { background-color: #232323; }

        .edit-btn, .delete-btn { 
            color: white; 
            padding: 5px 10px; 
            text-decoration: none; 
            border-radius: 5px;
        }
        .edit-btn { background-color: #3498db; }
        .edit-btn:hover { background-color: #2980b9; }
        .delete-btn { background-color: #e74c3c; }
        .delete-btn:hover { background-color: #c0392b; }

        .add-button { display: inline-block; margin-top: 20px; padding: 10px 15px; background-color:rgb(46, 169, 70); color: white; text-decoration: none; border-radius: 5px; }
        .add-button:hover {
            background-color:rgb(38, 113, 53);
        }
        .btn-accueil { 
            display: block;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
            font-weight: bold; 
        }
        .btn-accueil:hover {
            text-decoration: underline;
        }
        .success { color: green; font-weight: bold; margin-top: 10px; }
        .error { color: red; font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>

<h1>Liste des Programmes</h1>

<?php if (!empty($successMessage)) : ?>
    <p class="success"><?= $successMessage ?></p>
<?php endif; ?>

<?php if (!empty($errorMessage)) : ?>
    <p class="error"><?= $errorMessage ?></p>
<?php endif; ?>

<table>
    <tr>
        <th>Nom du Programme</th>
        <th>Objectif</th>
        <th>Niveau</th>
        <th>Exercices</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($programmeData as $id_programme => $programme) : ?>
        <tr>
            <td><?= htmlspecialchars($programme['nom_programme']) ?></td>
            <td><?= htmlspecialchars($programme['nom_objectif']) ?></td>
            <td><?= htmlspecialchars($programme['nom_niveau']) ?></td>
            <td>
                <?php if (!empty($programme['exercices'])) : ?>
                    <ul>
                        <?php foreach ($programme['exercices'] as $exercice) : ?>
                            <li>
                                <?= htmlspecialchars($exercice['nom_exercice']) ?> 
                                (<?= htmlspecialchars($exercice['repetitions']) ?> répétitions / <?= htmlspecialchars($exercice['temps']) ?> sec)
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    Aucun exercice
                <?php endif; ?>
            </td>
            <td>
                <a href="modifier_programme.php?id_programme=<?= $id_programme ?>" class="edit-btn">Modifier</a>
                <a href="supprimer_programme.php?id_programme=<?= $id_programme ?>" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce programme ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<br>

<a href="ajouter_programme.php" class="add-button">+ Ajouter un Programme</a>
<a href="../administrateur/admin.php" class="btn-accueil">Retour</a>

</body>
</html>
