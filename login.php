<?php

try {
  $bdd = new PDO('mysql:host=localhost;dbname=catalogueacs;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
  catch(PDOException $e)
{
  die('Ereur : '.$e->getMessage());
}
// Test champs vide du formulaire : login sinon instructions n°1
if (!empty($_POST['nom_du_compte']))
{
  // Test champs plein du formulaire : login pour début des vérifications avec la base de donnée
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
          // Test si le mdp est incorrect si oui alors instructions n°4
          if($_POST['mot_de_passe'] !== PASSWORD)
          {
            // Instructions n°4
            $password_KO = "<div class='alert alert-danger mt-5 text-center' role='alert'>Le mot de passe saisi est incorrect.<br>Mot de passe oublié ? Cliquez <a id='ici' href='mdpoublie.php'>ici</a> !</div>";
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

          // On redirige vers le fichier index.php
          header('Location: index.php');
          exit();
        }
      }
        // Instructions n°3
        else
      {
        $password_KO = "<div class='alert alert-danger mt-5 text-center' role='alert'>Vous devez saisir votre mot de passe pour accéder à votre espace privé.<br>Mot de passe oublié ? Cliquez <a id='ici' href='mdpoublie.php'>ici</a> !</div>";;
      }
    }

    // Instructions n°2
    else {
      $password_KO = "<div class='alert alert-danger mt-5 text-center' role='alert'>L'identifiant du compte saisi est inexistant.<br>Login oublié ? Cliquez <a id='ici' href='mdpoublie.php'>ici</a> !</div>";
    }
  }
}
// Message d'instructions n°1 qui s'affiche par défaut
else
{
  $password_KO = "<div class='alert alert-info mt-5 text-center' role='alert'>Indiquez le nom du compte et le mot de passe pour accéder à votre espace privé ou cliquez sur \"créer mon compte privé\" pour créer un nouveau compte.</div>";;
}
include "header.php";
?>

<!-- Le HTML -->

<main class="container">
  <h1 class="text-center">Connection à mon espace privé</h1>
  <hr>

    <?php
      // Rencontre-t-on une erreur ? Affichage des différentes instructions selon le cas
      if(!empty($password_KO))
      {
        echo $password_KO;
      }
    ?>

  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <label for="nom_du_compte" class="col-sm-6 col-xl-3 text-xl-right">Identifiant du compte (Login) :</label>
    <input type="text" name="nom_du_compte" id="nom_du_compte" class="col-sm-12 col-xl-8 border border-info mb-3">


    <label for="mot_de_passe" class="col-sm-6 col-xl-3 text-xl-right">Mot de passe :</label>
    <input type="password" name="mot_de_passe" id="mot_de_passe" class="col-sm-12 col-xl-8 border border-info mb-3">

    <input id="boutonEnvoi" type="submit" name="submit" value="Se connecter à mon compte" class="col-sm-12 offset-xl-3 col-xl-6 mt-3">

  </form>

  <div class="col-sm-12 text-center mt-4">
    <p>ou</p>
    <a id="comptePrive" href="creation.php">>>> créer mon compte privé <<<</a>
  </div>

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
