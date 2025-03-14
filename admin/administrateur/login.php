<?php
session_start(); 
include 'config.php'; 

// Redirection si admin déjà co
if (isset($_SESSION['admin'])) {
    header("Location: login_user.php");
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
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        body { 
            font-family: Montserrat;
            background:#0D0D0D;            
            text-align: center; 
            margin-top: 100px; 
            color: #ebebeb;
        }

        .form-container { 
            width: 300px; 
            margin: auto; 
            padding: 20px;  
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

        button { 
            padding: 12px 50px;
            background: linear-gradient(180deg, #df3e3f, #e55a1c);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            margin: 20px;
            font-family: Roboto Condensed;
            font-weight: 500;
        }
        
        button:hover { 
            background: linear-gradient(180deg,rgb(173, 53, 53),rgb(182, 75, 26));
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
        <button type="submit">SE CONNECTER</button>
    </form>
</div>

</body>
</html>
