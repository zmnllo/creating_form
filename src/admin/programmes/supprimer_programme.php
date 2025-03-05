<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

$id_programme = filter_input(INPUT_GET, 'id_programme', FILTER_VALIDATE_INT);

if (!$id_programme) {
    header("Location: programmes.php?error=suppression");
    exit();
}

try {
    // début
    $pdo->beginTransaction();

    // Exos relié au prog
    $deleteExercices = "DELETE FROM exercice WHERE id_programme = :id_programme";
    $stmt = $pdo->prepare($deleteExercices);
    $stmt->bindParam(':id_programme', $id_programme, PDO::PARAM_INT);
    $stmt->execute();

    // Supprimer le programme
    $query = "DELETE FROM programme WHERE id_programme = :id_programme";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_programme', $id_programme, PDO::PARAM_INT);
    $stmt->execute();

    // fin
    $pdo->commit();

    header("Location: programmes.php?success=suppression");
    exit();

} catch (Exception $e) {
    // Annuler en cas d'erreur
    $pdo->rollBack();
    header("Location: programmes.php?error=suppression");
    exit();
}
