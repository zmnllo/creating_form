<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

$id_exercice = filter_input(INPUT_GET, 'id_exercice', FILTER_VALIDATE_INT);
if (!$id_exercice) {
    header("Location: exercices.php?error=suppression");
    exit();
}

$query = "DELETE FROM exercice WHERE id_exercice = :id_exercice";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_exercice', $id_exercice, PDO::PARAM_INT);

if ($stmt->execute()) {
    header("Location: exercices.php?success=suppression");
    exit();
} else {
    header("Location: exercices.php?error=suppression");
    exit();
}
?>
