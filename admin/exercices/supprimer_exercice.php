<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

// Vérifier si un ID d'exercice est bien reçu
$id_exercice_type = filter_input(INPUT_GET, 'id_exercice_type', FILTER_VALIDATE_INT);

if (!$id_exercice_type) {
    die("❌ Erreur : Aucun ID d'exercice valide reçu.");
}

try {
    // Vérifier si l'exercice est utilisé dans la table exercice
    $checkQuery = "SELECT COUNT(*) FROM exercice WHERE id_exercice_type = :id_exercice_type";
    $stmtCheck = $pdo->prepare($checkQuery);
    $stmtCheck->bindParam(':id_exercice_type', $id_exercice_type, PDO::PARAM_INT);
    $stmtCheck->execute();
    $count = $stmtCheck->fetchColumn();

    if ($count > 0) {
        die("❌ Erreur : Cet exercice est utilisé dans un programme. Supprimez d'abord l'association.");
    }

    // Suppression de l'exercice dans exercice_type
    $deleteQuery = "DELETE FROM exercice_type WHERE id_exercice_type = :id_exercice_type";
    $stmtDelete = $pdo->prepare($deleteQuery);
    $stmtDelete->bindParam(':id_exercice_type', $id_exercice_type, PDO::PARAM_INT);
    
    if ($stmtDelete->execute()) {
        header("Location: exercices.php?success=suppression");
        exit();
    } else {
        echo "❌ Erreur lors de la suppression.";
    }
} catch (PDOException $e) {
    echo "❌ Erreur SQL : " . $e->getMessage();
}
?>
