<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../administrateur/config.php'; // Vérifie bien le chemin vers config.php

$query = "SELECT p.id_programme, p.nom_programme, 
                 o.id_objectif, o.nom_objectif, 
                 e.id_exercice, e.repetitions, e.temps, 
                 et.nom_exercice
          FROM programme p
          LEFT JOIN programme_objectif po ON p.id_programme = po.id_programme
          LEFT JOIN objectif o ON po.id_objectif = o.id_objectif
          LEFT JOIN exercice e ON p.id_programme = e.id_programme
          LEFT JOIN exercice_type et ON e.id_exercice_type = et.id_exercice_type
          ORDER BY o.id_objectif, p.id_programme, e.id_exercice";

$stmt = $pdo->prepare($query);
if (!$stmt->execute()) {
    die("Erreur SQL : " . implode(" - ", $stmt->errorInfo()));
}

$programmes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérifie si la requête retourne des résultats
if (empty($programmes)) {
    die("Aucun programme trouvé.");
}

$programmeData = [];

foreach ($programmes as $prog) {
    $id_objectif = $prog['id_objectif'];
    $id_programme = $prog['id_programme'];

    if (!isset($programmeData[$id_objectif])) {
        $programmeData[$id_objectif] = [
            'nom_objectif' => !empty($prog['nom_objectif']) ? $prog['nom_objectif'] : 'Objectif inconnu',
            'programmes' => []
        ];
    }

    if (!isset($programmeData[$id_objectif]['programmes'][$id_programme])) {
        $programmeData[$id_objectif]['programmes'][$id_programme] = [
            'nom_programme' => !empty($prog['nom_programme']) ? $prog['nom_programme'] : 'Programme sans nom',
            'exercices' => []
        ];
    }

    if (!empty($prog['nom_exercice'])) {
        $programmeData[$id_objectif]['programmes'][$id_programme]['exercices'][] = [
            'id_exercice' => $prog['id_exercice'],
            'nom_exercice' => htmlspecialchars($prog['nom_exercice']),
            'repetitions' => !empty($prog['repetitions']) ? htmlspecialchars($prog['repetitions']) : '-',
            'temps' => !empty($prog['temps']) ? htmlspecialchars($prog['temps']) : '-'
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Programmes</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 80%; margin: auto; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        .actions a {
            margin: 0 5px;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }
        .edit { background-color: #3498db; color: white; }
        .edit:hover { background: #2980b9; }
        .delete { background-color: #e74c3c; color: white; }
        .delete:hover { background: #c0392b; }
        .program-title { font-size: 22px; margin-top: 20px; }
        .modify-delete-links { margin-top: 10px; }
        .modify-delete-links a {
            margin: 5px;
            display: inline-block;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
        }
        .edit-program { background-color: #3498db; color: white; }
        .edit-program:hover { background: #2980b9; }
        .delete-program { background-color: #e74c3c; color: white; }
        .delete-program:hover { background: #c0392b; }
        .btn-accueil { 
            background-color: rgb(220, 28, 140); 
            padding: 10px; 
            text-decoration: none; 
            color: white;
            border-radius: 5px;
        }
        .btn-accueil:hover { background: rgb(120, 32, 83); }
        .accueil { margin: 30px; }
        .btn-ajout {
            background-color: #2ecc71;
            padding: 10px; 
            text-decoration: none; 
            color: white;
            border-radius: 5px;
        }
        .btn-ajout:hover {
            background-color:rgb(48, 146, 89);
        }
    </style>
</head>
<body>

<h1>📌 Liste des Programmes par Objectif</h1>

<?php foreach ($programmeData as $id_objectif => $objectif) : ?>
    <h2>🎯 Objectif : <?= htmlspecialchars($objectif['nom_objectif']) ?></h2>

    <?php if (empty($objectif['programmes'])) : ?>
        <p>Aucun programme disponible pour cet objectif.</p>
    <?php else : ?>
        <?php foreach ($objectif['programmes'] as $id_programme => $programme) : ?>
            <h3 class="program-title">📌 <?= htmlspecialchars($programme['nom_programme']) ?></h3>
            
            <table>
                <tr>
                    <th>Exercice</th>
                    <th>Répétitions</th>
                    <th>Temps</th>
                    <th>Actions</th>
                </tr>
                <?php if (empty($programme['exercices'])) : ?>
                    <tr>
                        <td colspan="4">Aucun exercice disponible</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($programme['exercices'] as $exercice) : ?>
                        <tr>
                            <td><?= $exercice['nom_exercice'] ?></td>
                            <td><?= $exercice['repetitions'] ?></td>
                            <td><?= $exercice['temps'] ?></td>
                            <td class="actions">
                                <a href="supprimer_exercice.php?id_exercice=<?= $exercice['id_exercice'] ?>" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet exercice ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>

            <div class="modify-delete-links">
                <a href="modifier_programme.php?id_programme=<?= $id_programme ?>" class="edit-program">Modifier le programme</a>
                <a href="supprimer_programme.php?id_programme=<?= $id_programme ?>" class="delete-program" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce programme et tous ses exercices ?')">Supprimer le programme</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endforeach; ?>

<div class="accueil">

    <a href="./ajouter_programme.php" class="btn-ajout">+ Ajouter un programme</a>

    <a href="../administrateur/admin.php" class="btn-accueil">Retour</a>
</div>

</body>
</html>
