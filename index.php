<?php
include "header.php";
?>

<!-- Le HTML -->


<main class="container">
  <div class="slider">
    <div id="slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">

        <?php
$nbrIdBG = $bdd->query("SELECT COUNT(id) AS nbrId FROM background");
$resultat = $nbrIdBG->fetch();
$nbMax = $resultat['nbrId'];

// Le random avec, en nombre max, le nombre d'entrée déterminée
$numeroPre = 0;
$idTest = 0;
$idTest2 = 0;
for ($cnt = 0; $cnt < 3; $cnt++) {
  while ($idTest == $numeroPre || $idTest2 == $numeroPre) {
    $numero = rand(1, $nbMax);
    $testPoss = $bdd->query("SELECT id_jeu FROM background WHERE id='{$numero}'");
    $testRecup = $testPoss->fetch();
    $idTest2 = $idTest;
    $idTest = $testRecup['id_jeu'];
  }

  $imageCarousel = $bdd->query("SELECT * FROM background WHERE id='{$numero}'");

  while($imageFinal = $imageCarousel->fetch()){
    $lienImage = $imageFinal['lien'];
    $idJeu = $imageFinal['id_jeu'];
  }
?>
      <div class="carousel-item <?php if($cnt < 1 ) echo "active";?>">
        <a href="/catalogueACS/produit.php?idSelect=<?= $idJeu ?>">
          <img src="<?= $lienImage ?>" class="d-block w-100">
        </a>
      </div>
<?php
 $numeroPre = $idJeu;
}

 ?>
        <ol class="carousel-indicators">
          <li data-target="#slider" data-slide-to="0" class="active"></li>
          <li data-target="#slider" data-slide-to="1"></li>
          <li data-target="#slider" data-slide-to="2"></li>
        </ol>

      </div>
    </div>
  </div>
  <?php

?>
  <div class="container main-content">
    <div class="row">



    <div class="col-8 games">
      <section class="on-sale">

        <div class="container">
          <div class="title-box">
            <h2>Best Seller</h2>
          </div>
          <div class="row">
            <?php

  $bestSeller = $bdd->query('SELECT id, Titre, Prix, LienCover FROM jeux WHERE BestSeller = 1');
  while ($donnees = $bestSeller->fetch()) {
?>

            <div class="col-md-3">
              <div class="product-top">
                <a href="/catalogueACS/produit.php?idSelect=<?= $donnees['id'] ?>"><img src="<?= $donnees['LienCover'] ?>"></a>
                <div class="overlay-right">
                  <button type="button" class="btn btn-secondary" title="game shop">
                    <i class="fa fa-eye"></i>
                  </button>
                  <button type="button" class="btn btn-secondary" title="Ad to wishlist">
                    <i class="fa fa-heart-o"></i>
                  </button>
                  <button type="button" class="btn btn-secondary" title="game shop">
                    <i class="fa fa-shopping-cart"></i>
                  </button>
                </div>
              </div>
              <div class="product-bottom text-center">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
                <h3><?= $donnees['Titre'] ?></h3>
                <h5><?= $donnees['Prix'] ?> €</h5>
              </div>
            </div>
            <?php
  }
 ?>
          </div>
        </div>
      </section>

      <!-- deuxième row -->
      <section class="new-product">

        <div class="container">
          <div class="title-box">
            <h2>Action</h2>
          </div>
          <div class="row">

            <?php


$query = $bdd->query("SELECT * FROM jeux WHERE Categorie LIKE '%Action%'");
while ($donnees = $query->fetch()) {

?>
            <div class="col-md-3">
              <div class="product-top">
                <a href="/catalogueACS/produit.php?idSelect=<?= $donnees['id'] ?>"><img src="<?= $donnees['LienCover'] ?>"></a>
                <div class="overlay-right">
                  <button type="button" class="btn btn-secondary" title="game shop">
                    <i class="fa fa-eye"></i>
                  </button>
                  <button type="button" class="btn btn-secondary" title="Add to wishlist">
                    <i class="fa fa-heart-o"></i>
                  </button>
                  <button type="button" class="btn btn-secondary" title="game shop">
                    <i class="fa fa-shopping-cart"></i>
                  </button>
                </div>
              </div>
              <div class="product-bottom text-center">
                <h3><?= $donnees['Titre'] ?></h3>
                <h5><?= $donnees['Prix'] ?> €</h5>
              </div>
            </div>
            <?php
    }
     ?>
          </div>
        </div>

      </section>
      <section class="new-product">


        <div class="container">
          <div class="title-box">
            <h2>PS4</h2>
          </div>
          <div class="row">

            <?php


$query = $bdd->query("SELECT * FROM jeux WHERE Plateforme LIKE '%PS4%'");
while ($donnees = $query->fetch()) {

?>
            <div class="col-md-3">
              <div class="product-top">
                <a href="/catalogueACS/produit.php?idSelect=<?= $donnees['id'] ?>"><img src="<?= $donnees['LienCover'] ?>"></a>
                <div class="overlay-right">
                  <button type="button" class="btn btn-secondary" title="game shop">
                    <i class="fa fa-eye"></i>
                  </button>
                  <button type="button" class="btn btn-secondary" title="Add to wishlist">
                    <i class="fa fa-heart-o"></i>
                  </button>
                  <button type="button" class="btn btn-secondary" title="game shop">
                    <i class="fa fa-shopping-cart"></i>
                  </button>
                </div>
              </div>
              <div class="product-bottom text-center">
                <h3><?= $donnees['Titre'] ?></h3>
                <h5><?= $donnees['Prix'] ?> €</h5>
              </div>
            </div>
            <?php
    }
     ?>
          </div>
        </div>
      </section>
    </div>

    <!-- <div class="col-4 border-2 bcolor sidebar">
  <div class="w-100 text-center p-4">
    <h5 class="p-2 border-bt text-danger"></h5> -->

    <div class="col-4 border-2 bcolor sidebar">
      <div class="w-100 text-center p-4">
        <a href="#"></a>
        <li  class="bg-secondary" data-toggle="collapse" data-target="#products" class="collapsed active">
                  <a href="#"><strong>Plateforme</strong> <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                    <li class="active"><a href="#">Switch</a></li>
                    <li><a class="text-secondary" href="#">Wii U</a></li>
                    <li><a href="#">PS4</a></li>
                    <li><a href="#">PC</a></li>
                    <li><a href="#">Xbox one</a></li>
                    <li><a href="#">NES</a></li>
                    <li><a href="#">SNES</a></li>
                    <li><a href="#">Xbox series X</a></li>

                </ul>
                <hr>

        <li  class="bg-secondary" data-toggle="collapse" data-target="#products" class="collapsed active">
                  <a href="#"><strong>Categorie</strong> <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                    <li class="active"><a href="#">Action</a></li>
                    <li><a class="" href="#">Aventure</a></li>
                    <li><a href="#">Plateforme</a></li>
                    <li><a href="#">RPG</a></li>
                    <li><a href="#">Survie</a></li>
                    <li><a href="#">Combat</a></li>
                </ul>
                <hr>

        <li  class="bg-secondary" data-toggle="collapse" data-target="#products" class="collapsed active">
                  <a href="#"><strong>Special</strong> <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                    <li class="active"><a href="#">Exclu</a></li>
                    <li><a class="" href="#">Retro</a></li>
                    <li><a href="#">Nouveauté</a></li>
                    <li><a href="#">à venir</a></li>
                </ul>
                <hr>
        <!-- <h5 class="p-2 border-bt text-danger">Social</h5>
        <div class="p-2">
            <i></i>
        </div> -->

      </div>
    </div>

    </div>

  </div>



  <!-- website features -->

  <!-- website features -->
  <section class="website-features">
    <div class="container">
      <div class="row">
        <div class="col-md-3 feature-box">
          <img src="img/garant.jfif">
          <div class="feature-text">
            <p><b>100% Original items </b>are available at company</p>
          </div>
        </div>
        <div class="col-md-3 feature-box">
          <img src="img/return1.jpg">
          <div class="feature-text">
            <p><b>Return within 30 days </b>of receiving your order.</p>
          </div>
        </div>
        <div class="col-md-3 feature-box">
          <img src="img/free.webp">
          <div class="feature-text">
            <p><b>Get free delivery for every </b>order on more than price.</p>
          </div>
        </div>
        <div class="col-md-3 feature-box">
          <img src="img/pay.png">
          <div class="feature-text">
            <p><b>Pay Online through multiple</b>options (card/Net banking)</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include "footer.php" ?>
