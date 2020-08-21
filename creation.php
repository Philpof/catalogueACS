<?php
  include "header.php";

// Création d'un compte si le formulaire est correctement rempli + vérification de l'existance ou non du login et de l'adresse mail dans le BDD + affichage messages confirmation ou erreur

// Si le compte a bien été créé alors le message de confirmation est créé dans la variable "$instructions"
if(isset($_GET['action']) && $_GET['action'] == "ok"){
  $instructions = "<div class='alert alert-success mt-5 text-center' role='alert'>Félicitations, votre compte a bien été créé !<br>Vous pouvez désormais vous connecter à votre compte en cliquant <a id='ici' href='login.php'>ici</a></div>";
}

// Sinon vérification pour la création du compte
elseif(!isset($_GET['action']) || $_GET['action'] != "ok"){

  // Vérifie si les champs du formulaire sont remplis (1ère partie)
  if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['date']) && !empty($_POST['email']) && !empty($_POST['tel']) && !empty($_POST['adresse']) && !empty($_POST['cp'])) {

    // On force le "nom" en majuscule
    $_POST['nom'] = mb_strtoupper($_POST['nom']);

    // On force le "prénom" en minuscule mais avec la 1ère lettre en majuscule
    $_POST['prenom'] = ucfirst(mb_strtolower($_POST['prenom']));

    // Vérifie si les champs du formulaire sont remplis (2nde partie)
    if (!empty($_POST['ville']) && !empty($_POST['login']) && !empty($_POST['mdp']) && !empty($_POST['mdpBis']) && !empty($_POST['spam'])) {

      // On force le "ville" en majuscule
      $_POST['ville'] = mb_strtoupper($_POST['ville']);

      // Vérifie si les 2 mdp sont exactement identique
      if (isset($_POST['mdp']) && isset($_POST['mdpBis']) && $_POST['mdp'] === $_POST['mdpBis']) {

        // Vérifier si le "login" et le "email" existent
        if (isset($_POST['login']) && isset($_POST['email'])) {

          // Stoque les variable POST dans des variables pour traitement
          $login = $_POST['login'];
          $email = $_POST['email'];
          // Requêtes SQL pour savoir si le "login" ou le "email" existent déjà
          $testLogin = $bdd->query("SELECT id FROM users WHERE login = '$login'");
          $testEmail = $bdd->query("SELECT id FROM users WHERE email = '$email'");
          //Si l'un et/ou l'autre existent le compteur s'incrément de 1
          $countLogin = $testLogin->rowCount();
          $countEmail = $testEmail->rowCount();
          // Si le compteur de "login" est égale à 1 alors le login existe déjà
          if($countLogin == 1) {
            // Message pour avertir que le login est déjà pris
            $instructions = "<div class='alert alert-danger mt-5 text-center' role='alert'>L'identifiant du compte (Login) choisi est déjà attribué, merci d'en choisir un nouveau.</div>";
          }
          // Si le compteur de "email" est égale à 1 alors l'email existe déjà
          elseif($countEmail == 1) {
            // Message pour avertir que l'email est déjà pris + voir si login ou mdp oubliés
            $instructions = "<div class='alert alert-danger mt-5 text-center' role='alert'>L'adresse email choisie est déjà attribuée, merci d'en choisir une nouvelle ou de cliquer <a id='ici' href='mdpoublie.php'>ici</a> si vous avez oublié votre login ou mot de passe.</div>";
          }
          else {
            // les Login et email sont libres donc on valide la création du compte
            try {
              // Prepare la requête
              $creationCompte = $bdd->prepare('INSERT INTO users (nom, prenom, dateNaissance, numTel, email, adresse, cp, ville, login, mdp) VALUES (:nom, :prenom, :dateNaissance, :numTel, :email, :adresse, :cp, :ville, :login, :mdp)');
              // Exécute la requête préparée
              $creationCompte->execute(array(
                ':nom' => htmlspecialchars($_POST['nom']),
                ':prenom' => htmlspecialchars($_POST['prenom']),
                ':dateNaissance' => htmlspecialchars($_POST['date']),
                ':numTel' => htmlspecialchars($_POST['tel']),
                ':email' => htmlspecialchars($_POST['email']),
                ':adresse' => htmlspecialchars($_POST['adresse']),
                ':cp' => htmlspecialchars($_POST['cp']),
                ':ville' => htmlspecialchars($_POST['ville']),
                ':login' => htmlspecialchars($_POST['login']),
                ':mdp' => htmlspecialchars($_POST['mdp'])
              ));

              // Refresh de la page avec "action=ok"
              header("Location: creation.php?action=ok");

              exit();
            } catch (\Exception $e) {
              echo $e->getMessage();
            }
          }
        }
      }
      // Si les deux mdp saisis ne sont pas striictement identique alors le message d'instructions est créé dans la variable "$instructions"
      else {
        $instructions = "<div class='alert alert-danger mt-5 text-center' role='alert'>Le mot de passe saisi et sa confirmation sont différents.</div>";
      }
    }
    // Si les champs ne sont pas remplis alors le message d'instructions est créé dans la variable "$instructions"
    else {
      $instructions = "<div class='alert alert-info mt-5 text-center' role='alert'>Veuillez compléter les différents champs suivants :</div>";
    }
  }
  // Si les champs ne sont pas remplis alors le message d'instructions est créé dans la variable "$instructions"
  else {
    $instructions = "<div class='alert alert-info mt-5 text-center' role='alert'>Veuillez compléter les différents champs suivants :</div>";
  }
}
?>

<!-- Le HTML -->

<main class="container">
  <h1 class="text-center">Création d'un compte</h1>
  <hr>

  <!-- Affiche le message d'instructions défini ci-dessus selon les besoins -->
  <?php
  echo $instructions
  ?>

  <!-- Formulaire pour faire une entrée dans la base donnée avec conservation des champs si erreur à corriger après envoi du formulaire-->
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

    <label for="nom" class="col-sm-6 col-xl-3 text-xl-right">Nom :</label>
    <input type="text" name="nom" value="<?php if (isset($_POST['nom'])) {echo htmlspecialchars($_POST['nom']);} ?>" pattern="[a-zA-ZÀ-ÿ' -]{1,}" placeholder="Entrez votre nom en majuscule ou en minuscule" class="col-sm-12 col-xl-8 border border-info mb-3" required>

    <label for="prenom" class="col-sm-6 col-xl-3 text-xl-right">Prénom :</label>
    <input type="text" name="prenom" value="<?php if (isset($_POST['prenom'])) {echo htmlspecialchars($_POST['prenom']);} ?>" pattern="[a-zA-ZÀ-ÿ' -]{1,}" placeholder="Entrez votre prénom en majuscule ou en minuscule" class="col-sm-12 col-xl-8 border border-info mb-3" required>

    <label for="date" class="col-sm-6 col-xl-3 text-xl-right">Date de naissance :</label>
    <input type="date" name="date" value="<?php if (isset($_POST['date'])) {echo htmlspecialchars($_POST['date']);} ?>" class="col-sm-12 col-xl-8 border border-info mb-3" required>

    <label for="email" class="col-sm-6 col-xl-3 text-xl-right">Adresse mail :</label>
    <input type="email" name="email" value="<?php if (isset($_POST['email'])) {echo htmlspecialchars($_POST['email']);} ?>" pattern=".*@.*[.].*" placeholder="Au format : x@x.x" class="col-sm-12 col-xl-8 border border-info mb-3" required>

    <label for="tel" class="col-sm-6 col-xl-3 text-xl-right">Numéro de téléphone :</label>
    <input type="tel" name="tel" value="<?php if (isset($_POST['tel'])) {echo htmlspecialchars($_POST['tel']);} ?>" pattern="^0[0-9]{9}" placeholder="Ex. : 0698765432" class="col-sm-12 col-xl-8 border border-info mb-3" required>

    <label for="adresse" class="col-sm-6 col-xl-3 text-xl-right">Adresse postale :</label>
    <input type="text" name="adresse" value="<?php if (isset($_POST['adresse'])) {echo htmlspecialchars($_POST['adresse']);} ?>" placeholder="Ex. : 18 allée d'Hyrule" class="col-sm-12 col-xl-8 border border-info mb-3" required>

    <label for="cp" class="col-sm-6 col-xl-3 text-xl-right">Code postal :</label>
    <input type="text" name="cp" value="<?php if (isset($_POST['cp'])) {echo htmlspecialchars($_POST['cp']);} ?>" pattern="[0-9]{5}" placeholder="Ex. : 75001, 13003,..." class="col-sm-12 col-xl-8 border border-info mb-3" required>

    <label for="ville" class="col-sm-6 col-xl-3 text-xl-right">Ville :</label>
    <input type="text" name="ville" value="<?php if (isset($_POST['ville'])) {echo htmlspecialchars($_POST['ville']);} ?>" pattern="[a-zA-ZÀ-ÿ' -]{1,}" placeholder="Entrez le nom de votre ville en majuscule ou en minuscule" class="col-sm-12 col-xl-8 border border-info mb-3" required>

    <label for="login" class="col-sm-6 col-xl-3 text-xl-right">Identifiant du compte (Login) :</label>
    <input type="text" name="login" value="<?php if (isset($_POST['login'])) {echo htmlspecialchars($_POST['login']);} ?>" placeholder="Il doit contenir entre 3 et 12 caractères" minlength="3" maxlength="12" class="col-sm-12 col-xl-8 border border-info mb-3" required>

    <label for="mdp" class="col-sm-6 col-xl-3 text-xl-right">Mot de passe :</label>
    <input type="text" name="mdp" value="<?php if (isset($_POST['mdp'])) {echo htmlspecialchars($_POST['mdp']);} ?>" placeholder="Il doit contenir : une majucule, une minuscule, un chiffre et 8 lettres au minimum" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="col-sm-12 col-xl-8 border border-info mb-3" required>

    <label for="mdpBis" class="col-sm-6 col-xl-3 text-xl-right">Confirmation du mot de passe :</label>
    <input type="text" name="mdpBis" value="<?php if (isset($_POST['mdpBis'])) {echo htmlspecialchars($_POST['mdpBis']);} ?>" placeholder="Recopiez votre mot de passe à l'identique" class="col-sm-12 col-xl-8 border border-info mb-3" required>

    <label for="spam" class="col-sm-6 col-xl-3 text-xl-right">Anti-spam :</label>
    <input type="choose" name="spam" pattern="jeux" placeholder='Tapez le mot "jeux" ici' class="col-sm-12 col-xl-8 col-xl-6 border border-info mb-3" required>

    <input id="boutonEnvoi" type="submit" name="Creer" value="Créer mon compte" class="col-sm-12 offset-xl-3 col-xl-6 mt-3">

  </form>

  <!-- Liens pour retourner au site -->
  <hr>
  <div class="col-sm-12 text-center mt-4">
    <a id="retour" href="index.php" class="align-item-center">Revenir à l'accueil</a>
  </div>
  <hr>

</main>

<?php
  include "footer.php";
?>
