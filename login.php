<?php
  include "header.php";

  // Requête PHP pour vérifier les informations
  $sql = "SELECT * FROM users WHERE id = '1'";
  foreach  ($bdd->query($sql) as $row) {
  }
  // Création des constantes
  define('LOGIN', $row['login']);
  define('PASSWORD', $row['mdp']);

  // Test champs vide du formulaire : login
  if (!empty($_POST['nom_du_compte']))
  {
    // est champs vide du formulaire : mdp
    if(!empty($_POST['mot_de_passe']))
    {
      // Sont-ils les mêmes que les constantes ?
      if($_POST['nom_du_compte'] !== LOGIN)
      {
        $password_KO = "<div class='alert alert-danger mt-5' role='alert'>Compte inexistant !</div>";
      }
      else if($_POST['mot_de_passe'] !== PASSWORD)
      {
        $password_KO = "<div class='alert alert-danger mt-5' role='alert'>Mot de passe incorrect !</div>";
      }
        else
      {
        // On ouvre la session
        session_start();

        // On enregistre le login en session
        $_SESSION['login'] = LOGIN;

        // On redirige vers le fichier admin.php
        header('Location: adminSQL.php');
        exit();
      }
    }
      else
    {
      echo "<div class='alert alert-info mt-5' role='alert'>Indiquez le nom du compte et le mot de passe pour accéder à votre espace privé</div>";;
    }
  }
?>


  <section class="container bg-light pt-5 pb-5">
    <h1 class="text-center">Connection à mon espace privé</h1>

    <hr>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <label for="nom_du_compte" class="col-sm-12 col-lg-3 align-top">Nom du compte (Login) :</label>
      <input type="text" name="nom_du_compte" id="nom_du_compte" class="col-sm-12 col-lg-8 align-top border border-info">

      <label for="mot_de_passe" class="col-sm-12 col-lg-3 align-top">Mot de passe :</label>
      <input type="password" name="mot_de_passe" id="mot_de_passe" class="col-sm-12 col-lg-8 align-top border border-info">

      <input type="submit" name="submit" value="Se connecter à mon compte" class="col-sm-12 offset-lg-4 col-lg-4">
    </form>

    <?php
      // Rencontre-t-on une erreur ?
      if(!empty($password_KO))
      {
        echo $password_KO;
      }
    ?>

    <hr>

    <a href="index.php" class="align-item-center">Revenir au site</a>
    <hr>


</section>

<?php
include "footer.php";
?>
