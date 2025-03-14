<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'db5017374434.hosting-data.io';
$dbname = 'dbs13934223';
$username = 'dbu4522100'; 
$password = 'Leninivin21'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    echo "❌ Erreur de connexion : " . $e->getMessage();
}

define('BASE_URL', 'https://creatingform.com');
