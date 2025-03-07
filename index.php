<?php 
include './layouts/header.php';
include './components/hero.php';

?>

<section class="section">
    <div>
        <img src="./assets/creatingform.webp" alt="Logo" aria-label="" class="logo">
    </div>
    <p class="intro">Fondée par Manuel Garcia à Audincourt, est née de sa passion pour le sport et de son envie de
        partager cette
        énergie. Aujourd’hui, notre salle est bien plus qu’un lieu d’entraînement : elle incarne un esprit convivial où
        chacun, débutant ou confirmé, peut atteindre ses objectifs dans une ambiance motivante.</p>
</section>


<section class="section">
    <div class="card">
        <div class="card__caption">
            <div>
                <img src="./assets/icon1.webp" alt="Icon musculation" aria-label="" class="intro-icons">
            </div>
            <div>
                <h3 class="intro_title">+ DE 180 ADHÉRENTS</h3>
            </div>
            <p>Des adhérents déterminés à repousser leurs limites et atteindre de nouveaux sommets.</p>
        </div>
    </div>

    <div class="card">
        <div class="card__caption">
            <div>
                <img src="./assets/icon2.webp" alt="Icon musculation" aria-label="" class="intro-icons">
            </div>
            <div>
                <h3 class="intro_title">2 COACHS</h3>
            </div>
            <p>Deux coachs passionnés pour vous accompagner avec un suivi personnalisé et motivant.</p>
        </div>
    </div>


    <div class="card">
        <div class="card__caption">
            <div>
                <img src="./assets/icon3.webp" alt="Icon animateur" aria-label="" class="intro-icons">
            </div>
            <div>
                <h3 class="intro_title">19 ANIMATEURS</h3>
            </div>
            <p>Des animateurs dynamiques, prêts à vous inspirer et à vous soutenir dans l'atteinte de vos objectifs.</p>
        </div>
    </div>
</section>



<section class="section">

    <div class="section__content">
        <h3 class="section__title">Découvrez nos services</h3>
        <p class="section__sous_titre">Profitez de nos deux salles distinctes : l'une dédiée aux poids libres et au
            yoga,
            l'autre aux machines
            guidées et à l’espace cardio.</p>
    </div>

    <div class="card card--services">
        <div class="services">
            <h3 class="services_title">MUSCULATION</h3>
        
        </div>
        <div>
            <img src="./assets/musculation.webp" alt="Kettlebell" aria-label="" class="img-services">
        </div>
    </div>

    <div class="card card--services">
        <div class="services">
            <h3 class="services_title">POIDS DU CORPS</h3>
            
        </div>
        <div>
            <img src="./assets/pdc.webp" alt="Femme sportive" aria-label="" class="img-services">
        </div>
    </div>

    <div class="card card--services">
        <div class="services">
            <h3 class="services_title">CARDIO</h3>
            
        </div>
        <div>
            <img src="./assets/cardio.webp" alt="Homme en train de faire de la corde a sauter" aria-label=""
                class="img-services">
        </div>
    </div>

</section>

<section class="section section--fonctionnalite">

    <div class="fonctionnalite_cards">
        <h3 class="fonctionalite_title">PROFITEZ DE NOTRE NOUVELLE FONCTIONNALITE DE SUIVI PERSONNALISE !</h3>
        <p class="fonctionnalite_sous-titre">C’est simple, inscrivez vous, répondez à notre questionnaire, définissez vos
            objetifs et nous vous offrons un
            premier programme d’entraînement que vous soyez débutant ou expert.</p>

        <div>
            <div>
                <img src="./assets/bord.png" alt="Icon tableau de bord" aria-label="">
            </div>
            <p>Renseignez votre tableau de bord (âge, poids, passé sportif, objectif).</p>
        </div>

        <div>
            <div>
                <img src="./assets/cible.png" alt="Icon cible objectif" aria-label="">
            </div>
            <p>Ciblez vos objectifs (tonification, perte de poids, améliorer son endurance.).</p>
        </div>

        <div>
            <div>
                <img src="./assets/creation.png" alt="Icon création de programme" aria-label="">
            </div>
            <p>Créé votre programmes grâce à notre palette d’entraînement.</p>
        </div>

        <div>
            <div>
                <img src="./assets/apple.png" alt="Icon nutrition pomme" aria-label="">
            </div>
            <p>Découvrez notre tableau nutritionnel accompagné d'idées de plats 100% fit.</p>
        </div>

    </div>

</section>

<section class="section" id="tarif">
    <div class="section__content">
        <h3 class="section__title">Découvrez nos abonnements</h3>
        <p class="section__sous_titre">Il n’y a aucun frais d’inscription ni de badge d’entrée. L’entrée se fait par
            reconnaissance faciale et
            l’inscription est uniquement disponible en présentiel.</p>
    </div>

    <div class="cards">
        <!-- Étudiant -->
        <div class="card card--minheight">
            <div class="card__caption">
                <h3 class="card__title card__title--linear">ETUDIANT</h3>
                <div> <strong class="card__price">130€</strong>/ An</div>
                <p class="card__sous_titre">Vous pouvez changer d’abonnement à tout moment.</p>
                <ul class="card__list">
                    <li>Accès à l’espace personnel</li>
                    <li>Packs débutant et intermédiaire</li>
                </ul>
                <p class="card__suppl">*Copie carte d’identité et étudiante requises avec autorisation parentale pour
                    les
                    moins de 18 ans.
                </p>
            </div>
        </div>
        <!-- Premium -->
        <div class="card">
            <div class="card__caption card__caption--premium">
                <h3 class="card__title">PREMIUM</h3>
                <div> <strong class="card__price">180€</strong> / An</div>
                <p class="card__sous_titre">Vous pouvez passer à un abonnement inférieur à tout moment.</p>
                <ul class="card__list">
                    <li>Accès à l’espace personnel</li>
                    <li>Packs débutant, intermédiaire et avancé</li>
                    <li>Accès à la nutrition</li>
                    <li>Création de programmes personnalisés</li>
                </ul>
                <p class="card__suppl">Possibilité de paiement en 2 fois (chèques ou espèces).</p>
            </div>
        </div>
        <!-- Classique -->
        <div class="card">
            <div class="card__caption">
                <h3 class="card__title card__title--linear">CLASSIQUE</h3>
                <div> <strong class="card__price">150€</strong> / An</div>
                <p class="card__sous_titre">Vous pouvez changer d’abonnement à tout moment.</p>
                <ul class="card__list">
                    <li>Accès à l’espace personnel</li>
                    <li>Packs débutant et intermédiaire</li>
                    <li>Accès à la nutrition</li>
                </ul>
                <p class="card__suppl">Paiement en 2 fois (chèques ou espèces).</p>
            </div>
        </div>
    </div>
    </div>

</section>

<section class="section">

    <div class="section__content">
        <h3 class="section__title">Nos adhérents témoignent !</h3>
        <p class="section__sous_titre"> Veillons au bien-être de nos adhérents et cultivons un esprit de cohésion.</p>
    </div>

    <div class="card">
        <div class="card__caption">
            <div>
                <p class="card__title card__title--linear"> <strong>Mikaïl</strong> </p>
            </div>
            <p>“Très bonne salle de sport, petite mais excellente ambiance !”</p>
        </div>
    </div>

    <div class="card">
        <div class="card__caption">
            <div>
                <p class="card__title card__title--linear"> <strong>Noémie</strong> </p>
            </div>
            <p>“Salle tranquille, personnel gentil et à l’écoute. Je recommande.”</p>
        </div>
    </div>

    <div class="card">
        <div class="card__caption">
            <div>
                <p class="card__title card__title--linear"> <strong>Serena</strong> </p>
            </div>
            <p>“Bonne ambiance, très motivant et convivial. Tarifs très intéressants.”</p>
        </div>
    </div>

</section>

<section class="section_inscription">

    <div class="section__content">
        <h3 class="section__title section__title-left">Pré-Inscription</h3>
        <p class="section__sous_titre_inscription"> Remplissez le formulaire de pré-inscription pour accéder à votre
            espace
            personnel. Une
            fois votre abonnement réglé en salle, votre demande sera validée et un nom d'utilisateur personnalisé vous
            sera attribué. Si vous n'avez pas encore finalisé votre inscription, laissez un message précisant vos
            intentions. Sans nouvelles, la demande expirera au bout d'une semaine.</p>
    </div>

    <form>
        <div class="form">
            <input class="contact_form" type="text" id="name" name="name" placeholder="Nom / Prénom *" required>
        </div>

        <div class="form">
            <input class="contact_form" type="email" id="email" name="email" placeholder="Adresse mail *" required>
        </div>

        <div class="form">
            <input class="contact_form" type="number" id="number" name="number" placeholder="Téléphone *" required>
        </div>

        <div class="form">
            <input class="contact_form contact_form--padding" type="text" id="text" name="text" placeholder="Message *"
                required>
        </div>

        <div class="checkbox_conditions">

            <input type="checkbox" id="Politique de Confidentialité" name="Politique de Confidentialité"
                value="Conditions">
            <label class="checkbox_label" for="Politique de Confidentialité">J'accepte la <a class="lien_politique"
                    href="#">Politique de Confidentialité</a></label><br>
        </div>
        <button class="button_inscription" type="button"> ENVOYER</button>
    </form>
</section>

<?php include './layouts/footer.php'; ?>