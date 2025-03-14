<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php'; 

$successMessage = "";
$errorMessage = "";

// Ajouter un nouvel admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_admin'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Vérifier si l'admin existe déjà
    $checkQuery = "SELECT COUNT(*) FROM admin WHERE username = :username";
    $stmt = $pdo->prepare($checkQuery);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $errorMessage = "Erreur : Cet admin existe déjà.";
    } else {
        
        // Ajouter l'admin
        $insertQuery = "INSERT INTO admin (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($insertQuery);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $successMessage = "Admin ajouté avec succès !";
        } else {
            $errorMessage = "Erreur lors de l'ajout de l'admin.";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Admins</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        body { font-family: Montserrat; text-align: center; background:#0D0D0D; color: #ebebeb; margin-top: 50px; }
        .container { 
            width: 350px; 
            margin: auto; 
            padding: 30px; 
            border-radius: 10px; 
            background: radial-gradient(circle, #2B3C43, #1E2A2F);  
        }
        input { 
            width: 90%; 
            padding: 15px; 
            margin: 10px 0; 
            border-radius: 5px;
            border: 0px;
            background:rgba(13, 13, 13, 0.4);
            color: #ebebeb;

        }

        .add-button { 
            border-radius: 5px; 
            padding: 10px 50px; 
            color: white; 
            border: none; 
            cursor: pointer; 
            margin-top: 20px;
            background: linear-gradient(180deg, #df3e3f, #e55a1c);
            font-family: Roboto Condensed;
            font-weight: 500;
        }
        .add-button:hover {            
            background: linear-gradient(180deg,rgb(173, 53, 53),rgb(182, 75, 26));
        }
        .error { color: red; font-weight: bold; }
        .success { color: green; font-weight: bold; }
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
    </style>
</head>
<body>

<h2>Gestion des Admins</h2>

<div class="container">
    <?php if (!empty($errorMessage)) echo "<p class='error'>$errorMessage</p>"; ?>
    <?php if (!empty($successMessage)) echo "<p class='success'>$successMessage</p>"; ?>

    <h3>Ajouter un admin</h3>
    <form method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button class="add-button" type="submit" name="add_admin">AJOUTER</button>
    </form>
    
</div>

<br>

<a href="../administrateur/admin.php" class="back-link">Retour</a>

</body>
</html>
