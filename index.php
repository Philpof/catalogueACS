<?php
// On prolonge la session
session_start();

include "header.php";

// On teste si la variable de session existe et contient une valeur
if(!isset($_SESSION['login']))
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  $client = " à vous, visiteur(euse)";
  $connexion = "Se connecter à mon compte";
  $goLog = "login";
}
else {
  $client = ", " . $_SESSION['prenom'] . " " . $_SESSION['nom'];
  $connexion = "Me déconnecter";
  $goLog = "logout";
}
?>

<!-- Le HTML -->
<nav>
  <div class="container-fluid">
    <div class="row justify-content-around">
      <a id="logo" ref="index.php">Logo</a>
      <p id="client">Bonjour<?php echo $client ?> !</p>
      <a id="connexion" href="<?php echo $goLog ?>.php"><?php echo $connexion ?></a>
      <a id="panier" href="panier.php">Panier</a>
    </div>
  </div>
</nav>

<main>

  <article>
  </article>

  <section>
  </section>

  <aside>
  </aside>


</main>

<footer>
</footer>


<?php include "footer.php" ?>
