<?php include 'header.php';?>
<section id="productsSection">
  <?php
  if (isset($_GET['idSelect'])) {
    $jeux = htmlentities($_GET['idSelect']);

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
        <div class="sideImage">
          <img class="apercu d-block" src="image/un_contenu.png">
          <img class="apercu d-block" src="image/un_contenu.png">
          <img class="apercu d-block" src="image/un_contenu.png">
          <img class="apercu d-block" src="image/un_contenu.png">
        </div>
        <div class="photoProduit active" >
          <img class="" src="" alt="First slide" id="photo">
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
