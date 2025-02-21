<?php
$host = 'localhost';
$port = '3306'; 
$dbname = 'creating_form'; 
$username = 'root'; 
$password = 'root'; 

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Retourner la connexion pour l'utiliser dans d'autres fichiers
return $pdo;

//je definie le role administrateur a ROLE_ADMIN pour l'utiliser dans la condition
define('ROLE_ADMIN','administrateur');
define('ROLE_MODO', 'modérateur');
?>
