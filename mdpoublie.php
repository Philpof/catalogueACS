<?php
include "header.php";

// Envoi d'un email si le formulaire est correctement rempli + affichage messages confirmation ou erreur + envoi du mail à l'utilisateur
  // Affiche le message de confirmation si l'email a déjà été envoyé
if (isset($_GET['envoiMail']) && $_GET['envoiMail'] == "ok") {
  $lostPassword = "<div class='alert alert-success mt-5 text-center' role='alert'>Le courriel vous a bien été envoyé !</div>";
}
// Test champs vide du formulaire : sosMail + "envoiMail" sinon instructions n°1
else if (!isset($_GET['envoiMail']) || $_GET['envoiMail'] != "ok" || empty($_POST['sosMail'])){
  // Test champ plein du formulaire : sosMail pour début de la vérification avec la base de donnée
  if (isset($_POST['sosMail'])) {
    // Requête PHP pour vérifier les informations
    $mailOK = "SELECT email,login,mdp FROM users WHERE email = '{$_POST['sosMail']}'";
    foreach ($bdd->query($mailOK) as $row) {
    }
    // Vérification si le login existe et est lié à un compte sinon instructions n°2
    if (isset($row['email'])) {

      // Les variables
      $dest = $row['email']; // p.perechodov@codeur.online
      $sujet = 'Catalogue ACS - Votre demande d&#8217;identifiant et de mot de passe';
      $headers = 'From: Ne pas répondre';
      $message = 'Identifiant du compte (Login) : ' . $row['login'] . '<br>Mot de passe :' . $row['mdp'];
      // Envoi de l'email


      // mail($dest, $sujet, $message, $headers);
        // Refresh de la page que que le message de confirmation s'affiche
        header("Location: mdpoublie.php?envoiMail=ok");
      // }
      // else {
      //   // Message d'erreur si le mail n'a pas pu être envoyé
      //   $lostPassword = "<div class='alert alert-danger mt-5 text-center' role='alert'>Echec de l'envoie du message, veuillez réessayer ultérieurement.</div>";
      // }



    }
    // Instructions n°2
    else {
      $lostPassword = "<div class='alert alert-danger mt-5 text-center' role='alert'>L'adresse mail saisie est inexistante.<br>Vous voulez créer un compte personnel ? Cliquez <a id='ici' href='creation.php'>ici</a> !</div>";
    }
  }
  // Message d'instructions n°1 qui s'affiche par défaut
  else {
    $lostPassword = "<div class='alert alert-info mt-5 text-center' role='alert'>Indiquez votre adresse email afin de recevoir vos identifiant de connexion et mot de passe par courriel.</div>";;
  }
}
?>

<!-- Le HTML -->

<main class="container pt-5 pb-5">
  <h1 class="text-center">Login ou mot de passe oubliés ?</h1>
  <hr>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <label for="sosMail" class="col-sm-6 col-xl-3 text-xl-right">Adresse mail du compte :</label>
    <input type="text" name="sosMail" value="<?php if (isset($_POST['sosMail'])) {echo htmlspecialchars($_POST['sosMail']);} ?>" placeholder='Indiquez l&#8217;adresse mail que vous avez utilisé pour créer votre compte' class="col-sm-12 col-xl-8 border border-info mb-3" required>

    <label for="spam" class="col-sm-6 col-xl-3 text-xl-right">Etes-vous un robot ? :</label>
    <input type="choose" name="spam" pattern="non" placeholder='Tapez le mot "non" ici (sinon, c&#8217;est que vous êtes un robot...)' class="col-sm-12 col-xl-8 border border-info mb-3" required>

    <input type="submit" name="submit" value="Me renvoyer mes informations de connexion par mail" class="col-sm-12 offset-xl-3 col-xl-6 mt-3">
  </form>


  <?php
    // Rencontre-t-on une erreur ? Affichage des différentes instructions selon le cas
    if(!empty($lostPassword))
    {
      echo $lostPassword;
    }
  ?>

  <hr>
  <div class="col-sm-12 text-center mt-4">
    <a href="index.php" class="align-item-center">Revenir au site</a>
  </div>
  <hr>

</main>

<?php
include "footer.php";
?>
