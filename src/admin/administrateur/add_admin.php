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

// Modifier le mot de passe d'un admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $username = trim($_POST['username']);
    $newPassword = trim($_POST['new_password']);

    // Vérifier si l'admin existe
    $checkQuery = "SELECT password FROM admin WHERE username = :username";
    $stmt = $pdo->prepare($checkQuery);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$admin) {
        $errorMessage = "Erreur : Cet admin n'existe pas.";
    } elseif (password_verify($newPassword, $admin['password'])) {
        $errorMessage = "Le nouveau mot de passe ne peut pas être identique à l'ancien.";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateQuery = "UPDATE admin SET password = :password WHERE username = :username";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $successMessage = "Mot de passe mis à jour avec succès !";
        } else {
            $errorMessage = "Erreur lors de la mise à jour du mot de passe.";
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
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .container { width: 350px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background: #f9f9f9; }
        input { 
            width: 93%; 
            padding: 10px; 
            margin: 10px 0; 
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button { border-radius: 5px; width: 100%; padding: 10px; background: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background: #218838; }
        .error { color: red; font-weight: bold; }
        .success { color: green; font-weight: bold; }
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
        <button type="submit" name="add_admin">Ajouter</button>
    </form>
    
</div>

    <br>

<div class="container">

    <h3>Modifier le mot de passe</h3>
    <form method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
        <button type="submit" name="change_password">Modifier</button>
    </form>

</div>

</body>
</html>
