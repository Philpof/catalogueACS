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
            $image = $bdd->query('SELECT lien
                                  FROM background
                                  WHERE id_jeu ="' . $donnees['id'] . '"
                                  LIMIT 500
                                  OFFSET 1');
            while ($lien = $image->fetch()) {
              // code...
          ?>
          <img class="apercu" src="<?= $lien['lien'] ?>">
      <?php
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

  <!-- Liens pour retourner au site -->
  <hr>
  <div class="col-sm-12 text-center">
    <a id="retour2" href="index.php" class="align-item-center">Revenir à l'accueil</a>
  </div>
  <hr>


<?php include 'footer.php';?>
