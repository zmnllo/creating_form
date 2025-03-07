<?php 
include '../layouts/header.php';

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['adherent_id'])) {
    header("Location: login_user.php"); // Rediriger vers la connexion si non connecté
    exit();
}
?>
<!-- HERO de mon tableau de bord -->
<div>
    <div class="img__hero-tbd">
        <div class="img_container-tbd">
            <h2 class="img__tbd-slogan">Bienvenue dans votre Tableau de bord Noah,</h2>
            <i class="bi bi-card-list img__tbd"></i>
        </div>
    </div>
</div>


<section>

    <div>
        <h3 class="section__tbd_title">Mes informations</h3>
    </div>

    <div class="tbd__container">
        <div>
            <div class="tbd__border">
                <div class="tbd__border-in">
                    <p class="tbd__titre">POIDS ACTUEL</p>
                    <p class="tbd__infos">75 KG</p>
                </div>
                <img src="../assets/pen.png" alt="Stylo modifier" class="tbd__pen">
            </div>

            <div class="tbd__border">
                <div class="tbd__border-in">
                    <p class="tbd__titre">TAILLE</p>
                    <p class="tbd__infos">178</p>
                </div>
                <img src="../assets/pen.png" alt="Stylo modifier" class="tbd__pen">
            </div>

            <div class="tbd__border">
                <div class="tbd__border-in">
                    <p class="tbd__titre">AGE</p>
                    <p class="tbd__infos">21 ANS</p>
                </div>

                <img src="../assets/pen.png" alt="Stylo modifier" class="tbd__pen">
            </div>

            <div class="tbd__border">
                <div class="tbd__border-in">
                    <p class="tbd__titre">DATE D'INSCRIPTION</p>
                    <p class="tbd__infos">22/07/24</p>
                </div>
                <img src="../assets/pen.png" alt="Stylo modifier" class="tbd__pen">
            </div>

            <div class="tbd__border">
                <div class="tbd__border-in">
                    <p class="tbd__titre">OBJECTIF</p>
                    <p class="tbd__infos">PRISE DE MASSE</p>
                </div>
                <img src="../assets/pen.png" alt="Stylo modifier" class="tbd__pen">
            </div>

            <div class="tbd__border">
                <div class="tbd__border-in">
                    <p class="tbd__titre">POIDS IDEAL</p>
                    <p class="tbd__infos">85 KG</p>
                </div>
                <img src="../assets/pen.png" alt="Stylo modifier" class="tbd__pen">
            </div>
        </div>
    </div>
    <h3>Votre IMC</h3>

    <div>
        <p>24.2</p>
        <p>NORMAL</p>
        <img src="../assets/pen.png" alt="Stylo modifier">
    </div>

</section>

<section>

    <h3>Entraînement en cours</h3>

    <img src="../assets/cordeasauter.webp" alt="Homme en train de faire de la corde a sauter">
    <p>FULL BODY 1 - DEBUTANT(E)</p>
    <p>12 semaines - 3x/semaine</p>
    <p>13%</p>

</section>

<section>

    <h3>Découvrez nos packs</h3>

    <div>
        <h3>débutant</h3>
        <p>Pour démarrer en douceur</p>
        <img src="../assets/trainers.png" alt="Icon chaussure">
        <button>DÉCOUVRIR</button>
        <button>CHOISIR CE PROGRAMME</button>
    </div>

    <div>
        <h3>INTERMÉDIAIRE</h3>
        <p>Repousser vos limites et améliorer vos performances</p>
        <img src="../assets/stopwatch.png" alt="Icon chronomètre">
        <button>DÉCOUVRIR</button>
        <button>CHOISIR CE PROGRAMME</button>
    </div>

    <div>
        <h3>AVANCÉ</h3>
        <p>Pour des résultats exceptionnels, repoussez vos frontières</p>
        <img src="../assets/torso.png" alt="Icon torse">
        <button>DÉCOUVRIR</button>
        <button>CHOISIR CE PROGRAMME</button>
    </div>

</section>

<section>

    <h3>Votre transformation en image</h3>
    <p>Importez vos photos et suivez votre progression !</p>
    <img src="../assets/avant.JPG" alt="Photo de Noah avant sa transformation">
    <img src="../assets/apres.JPG" alt="Photo de Noah après sa transformation">
    <form>
        <label for="photo-upload">Importez mes photos</label>
        <input type="text" id="photo-upload" name="photo" accept="image/*">
    </form>

</section>

<section>
    <a href="entrainements">MES ENTRAINEMENTS</a>
    <a href="nutrition">NUTRITION</a>
</section>




<?php include '../layouts/footer.php'; ?>