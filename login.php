<?php
include "header.php";

// Test champs vide du formulaire : login sinon instructions n°1
if (!empty($_POST['nom_du_compte']))
{
  // Test champs c=plein du formulaire : login pour début des vérification avec la base de donnée
  if (isset($_POST['nom_du_compte']))
  {
    // Requête PHP pour vérifier les informations
    $sql = "SELECT * FROM users WHERE login = '{$_POST['nom_du_compte']}'";
    foreach ($bdd->query($sql) as $row) {
    }
      // Vérification si le login existe et est lié à un compte sinon instructions n°2
      if (isset($row['login']))
      {
        // Création des constantes car le compte existe
        define('LOGIN', $row['login']);
        define('PASSWORD', $row['mdp']);
        define('NOM', $row['nom']);
        define('PRENOM', $row['prenom']);
        define('ADMIN', $row['admin']);

        // Test champs vide du formulaire : mdp sinon instructions n°3
        if(!empty($_POST['mot_de_passe']))
        {
          //Test si le mdp est incorrect si oui alors instructions n°4
          if($_POST['mot_de_passe'] !== PASSWORD)
          {
            // Instructions n°4
            $password_KO = "<div class='alert alert-danger mt-5 text-center' role='alert'>Le mot de passe saisi est incorrect.<br>Mot de passe oublié ? Cliquez <a href='mdpoublie.php'>ici</a> !</div>";
          }
            // sinon, on ouvre la session
            else
          {
          // On ouvre la session
          session_start();

          // On enregistre le login en session
          $_SESSION['login'] = LOGIN;
          $_SESSION['nom'] = NOM;
          $_SESSION['prenom'] = PRENOM;
          $_SESSION['admin'] = ADMIN;

          // On redirige vers le fichier admin.php
          header('Location: index.php');
          exit();
        }
      }
        // Instructions n°3
        else
      {
        $password_KO = "<div class='alert alert-danger mt-5 text-center' role='alert'>Vous devez saisir votre mot de passe pour accéder à votre espace privé.<br>Mot de passe oublié ? Cliquez <a href='mdpoublie.php'>ici</a> !</div>";;
      }
    }

    // Instructions n°2
    else {
      $password_KO = "<div class='alert alert-danger mt-5 text-center' role='alert'>L'identifiant du compte saisi est inexistant.<br>Login oublié ? Cliquez <a href='mdpoublie.php'>ici</a> !</div>";
    }
  }
}
// Message d'instructions n°1 qui s'affiche par défaut
else
{
  $password_KO = "<div class='alert alert-info mt-5 text-center' role='alert'>Indiquez le nom du compte et le mot de passe pour accéder à votre espace privé ou cliquez sur \"créer mon compte privé\" pour créer un nouveau compte.</div>";;
}
?>

<!-- Le HTML -->
<section class="container bg-light pt-5 pb-5">
  <h1 class="text-center">Connection à mon espace privé</h1>
  <hr>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <label for="nom_du_compte" class="col-sm-12 col-lg-3 align-top mt-5 text-right">Identifiant du compte (Login) :</label>
    <input type="text" name="nom_du_compte" id="nom_du_compte" class="col-sm-12 col-lg-8 align-top border border-info mt-5">

    <label for="mot_de_passe" class="col-sm-12 col-lg-3 align-top mt-2 text-right">Mot de passe :</label>
    <input type="password" name="mot_de_passe" id="mot_de_passe" class="col-sm-12 col-lg-8 align-top border border-info mt-2">

    <input type="submit" name="submit" value="Se connecter à mon compte" class="col-sm-12 offset-lg-4 col-lg-4 mt-3">
  </form>

  <div class="col-sm-12 text-center mt-4">
    <p>ou</p>
    <a href="creation.php">créer mon compte privé</a>
  </div>

  <?php
    // Rencontre-t-on une erreur ? Affichage des différentes instructions selon le cas
    if(!empty($password_KO))
    {
      echo $password_KO;
    }
  ?>

  <hr>
  <div class="col-sm-12 text-center mt-4">
    <a href="index.php" class="align-item-center">Revenir au site</a>
  </div>
  <hr>

</section>

<?php
include "footer.php";
?>
