<?php include 'header.php';?>
<section id="productsSection">
  <?php
  $_GET['jeux'] = 1;
  if (isset($_GET['jeux'])) {
    $jeux = htmlentities($_GET['jeux']);

    $produit = $bdd->query('SELECT * FROM jeux WHERE id ="' . $jeux . '"');
    while ($donnees = $produit->fetch()) {
    ?>
    <article class="produit">
      <div class="boutonPanier"><p>Ajouter au panier</p></div>
      <div class="information">
        <h1 class="titreJeux"><?= $donnees['Titre'] ?></h1>
        <div class="subInfo"><p class="categorie"><?= $donnees['Categorie'] ?></p>
        <p class="plateforme"><?= $donnees['Plateforme'] ?></p>
        <p class="prix"><?= $donnees['Prix'] ?></p></div>
        <p class="description"><?= $donnees['Description'] ?></p>
      </div>
      <div class="cadreImage">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <div class="sideImage">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active apercu"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1" class="apercu"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2" class="apercu"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3" class="apercu"></li>
    </div>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active photoProduit">
      <img class="d-block w-100" src="<?= $donnees['LienImage'] ?>" alt="First slide">
    </div>
    <div class="carousel-item photoProduit">
      <img class="d-block w-100" src="..." alt="Second slide">
    </div>
    <div class="carousel-item photoProduit">
      <img class="d-block w-100" src="..." alt="Third slide">
    </div>
    <div class="carousel-item photoProduit">
      <img class="d-block w-100" src="..." alt="Fourth slide">
    </div>
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
