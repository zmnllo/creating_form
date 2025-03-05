<?php
session_start(); 
include 'config.php'; 

// Redirection si admin déjà co
if (isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

$error = ""; // Message d'erreur

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim($_POST['password']);

    // Vérifier l'utilisateur dans la base de données
    $query = "SELECT * FROM admin WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le mot de passe correspond
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin'] = $user['username']; 
        $_SESSION['admin_id'] = $user['id_admin'];
        header("Location: admin.php");
        exit();
    } else {
        $error = "Identifiants incorrects.";
    }

    // var_dump($_SESSION); die();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <style>
        body { 
            font-family: Montserrat, sans-serif; 
            text-align: center; 
            margin-top: 100px; 
        }

        .form-container { 
            width: 300px; 
            margin: auto; 
            padding: 20px; border: 1px solid #ccc; 
            border-radius: 10px; 
            background: #f9f9f9; 

        }

        input { 
            width: 93%; 
            padding: 10px; 
            margin: 10px 0; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
        }

        button { 
            width: 100%; 
            padding: 10px; 
            background: #28a745; 
            color: white; 
            border: none; 
            cursor: pointer; 
            border-radius: 5px; 
        }
        
        button:hover { 
            background: #218838; 
        }
        .error { 
            color: red; 
            font-weight: bold; 
            margin-bottom: 10px; 
        }
    </style>
</head>
<body>

<h2>Connexion Admin</h2>

<div class="form-container">
    <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>

    <form method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
</div>

</body>
</html>
