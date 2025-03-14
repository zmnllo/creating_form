<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../administrateur/config.php';

if (!isset($_GET['id_programme']) || !is_numeric($_GET['id_programme'])) {
    $_SESSION['error_message'] = "Erreur : ID de programme invalide.";
    header("Location: programmes.php");
    exit();
}

$id_programme = $_GET['id_programme'];

try {
    // Supprimer les exercices liés à ce programme
    $stmt = $pdo->prepare("DELETE FROM exercice WHERE id_programme = :id_programme");
    $stmt->execute(['id_programme' => $id_programme]);

    // Supprimer le programme lui-même
    $stmt = $pdo->prepare("DELETE FROM programme WHERE id_programme = :id_programme");
    $stmt->execute(['id_programme' => $id_programme]);

    $_SESSION['success_message'] = "Programme supprimé avec succès.";
    header("Location: programmes.php");
    exit();
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Erreur lors de la suppression : " . $e->getMessage();
    header("Location: programmes.php");
    exit();
}
?>
