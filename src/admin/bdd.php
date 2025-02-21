<?php
$host = 'localhost';
$port = '80'; 
$dbname = 'creating_form'; 
$username = 'root'; // Identifiant MAMP
$password = 'root'; // Mot de passe par défaut de MAMP

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
