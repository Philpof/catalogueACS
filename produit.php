<?php include 'header.php';?>

<section id="productsSection">
  <?php
  if (isset($_GET['idSelect'])) {
    $jeux = htmlentities($_GET['idSelect']);

    $produit = $bdd->query('SELECT * FROM jeux WHERE id ="' . $jeux . '"');
    while ($donnees = $produit->fetch()) {
    ?>
    <article class="produit">
      <div class="boutonPanier">
        <i class="fas fa-cart-arrow-down"></i>
      </div>
      <div class="information">
        <h1 class="titreJeux"><?= $donnees['Titre'] ?></h1>
        <div class="subInfo"><p class="categorie"><?= $donnees['Categorie'] ?></p>
        <p class="plateforme"><?= $donnees['Plateforme'] ?></p>
        <p class="prix"><?= $donnees['Prix'] ?> €</p></div>
        <p class="description p-3"><?= nl2br($donnees['Description']) ?></p>
      </div>
      <div class="cadreImage">
        <div class="sideImage">
          <?php
            $a = 1;
            $files = glob("img/" . $donnees['id'] . "/*.*");/* $files pour "lister" les fichiers - Mise en place de *.* pour dire que ce dossier contient une extension (par exemple .jpg, .php, etc... */
            $compteur = count($files);/* Variable $compteur pour compter (count) les fichiers lister ($files) dans le dossier */
            while ($a <= $compteur) {
              // code...
          ?>
          <img class="apercu" src="img/<?= $donnees['id'] ?>/apercu<?= $a ?>.jpg">
      <?php
      $a++;
        }
      ?>
        </div>
        <div class="photoProduit active" >
          <img class="photoActive" src="" alt="First slide" id="photo">
        </div>
      </div>
    </article>
    <?php
      }
    }
    else {
      header("Location: 404.php");
      exit;
    }
    ?>
  </section>


<?php include 'footer.php';?>
