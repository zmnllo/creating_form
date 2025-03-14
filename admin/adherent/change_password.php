<?php
ob_start(); // Active le buffer de sortie pour éviter l'erreur de header
session_start();
require_once '../db.php';

if (!isset($_SESSION['adherent_id'])) {
    header("Location: login_user.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nouveau_mdp = trim($_POST['nouveau_mdp']);
    $confirmation = trim($_POST['confirmation']);

    if (!empty($nouveau_mdp) && $nouveau_mdp === $confirmation) {
        try {
            $stmt = $pdo->prepare("UPDATE adherent SET mot_de_passe = ?, mdp_temporaire = 0 WHERE id_adherent = ?");
            $stmt->execute([$nouveau_mdp, $_SESSION['adherent_id']]);

            session_destroy(); 
            header("Location: login_user.php?success=mdp_modifie");
            exit();
        } catch (PDOException $e) {
            $error = "Erreur : " . $e->getMessage();
        }
    } else {
        $error = "Les mots de passe ne correspondent pas.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mon mot de passe</title>
    <link rel="stylesheet" href="../../styles/style.css"> 

    <style>
        .mdp-container {
            max-width: 400px;
            margin: 50px auto;
            text-align: center;
            background: #0d0d0d;
            padding: 20px;
            border-radius: 8px;
        }

        .mdp-form input {
            width: 93%;
            padding: 15px;
            margin: 10px 0px;
            border: none;
            border-radius: 5px;
            background: #1e1e1e;
            color: white;
            font-size: small;
        }

        .password-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-container input {
            width: 100%;
            padding-right: 40px;
        }

        .password-container i {
            position: absolute;
            right: 10px;
            cursor: pointer;
            color: gray;
        }

        .btn-modifier {
            background: linear-gradient(45deg, #df3e3f, #e55a1c);
            color: white;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 0px;
        }

        .btn-modifier:hover {
            background: linear-gradient(45deg,rgb(165, 50, 50),rgb(172, 78, 34));
        }
    </style>
</head>
<body>

<div class="mdp-container">
    <h2>Modifier votre mot de passe</h2>
    <p>Vous utilisez actuellement un mot de passe temporaire. Veuillez le changer.</p>

    <?php if (isset($error)) : ?>
        <p class="error-message"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="change_password.php" method="post" class="mdp-form">
        <div class="password-container">
            <input type="password" id="nouveau_mdp" name="nouveau_mdp" placeholder="Nouveau mot de passe :" required>
            <i class="bi bi-eye-slash" id="togglePassword"></i>
        </div>
        <div class="password-container">
            <input type="password" id="confirmation" name="confirmation" placeholder="Confirmation du mot de passe" required>
            <i class="bi bi-eye-slash" id="toggleConfirm"></i>
        </div>
        <button type="submit" class="btn-modifier">Modifier</button>
    </form>
</div>

<script>
document.getElementById("togglePassword").addEventListener("click", function() {
    let passwordInput = document.getElementById("nouveau_mdp");
    let icon = this;

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    }
});

document.getElementById("toggleConfirm").addEventListener("click", function() {
    let confirmInput = document.getElementById("confirmation");
    let icon = this;

    if (confirmInput.type === "password") {
        confirmInput.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    } else {
        confirmInput.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    }
});


window.onload = function() {
    alert("⚠️ Votre mot de passe est temporaire. Veuillez le modifier immédiatement.");
};

</script>

</body>
</html>
