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
for ($cnt = 0; $cnt < 3; $cnt++) {
  $numero = rand(1, $nbMax);
  $testPoss = $bdd->query("SELECT id_jeu FROM background WHERE id='{$numero}'");
  $idTest = $testPoss->fetch();
  while ($idTest == $numeroPre) {
    $numero = rand(1, $nbMax);
  }
  $imageCarousel = $bdd->query("SELECT * FROM background WHERE id='{$numero}'");
  while($imageFinal = $imageCarousel->fetch()){
    $lienImage = $imageFinal['lien'];
    $idJeu = $imageFinal['id_jeu'];
  }
?>
      <div class="carousel-item <?php if($cnt < 1 ) echo "active";?>">
        <a href="/catalogueACS/produit.php?idSelect=<?= $idJeu ?>"><img src="<?= $lienImage ?>" class="d-block w-100"></a>
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
  <section class="on-sale">

  <div class="container">
    <div class="title-box">
      <h2>Best Seller</h2>
    </div>
<?php

  

?>
    <div class="row">
      <div class="col-md-3">
        <div class="product-top">
          <a href="/catalogueACS/produit.php?idSelect=<?= $donnees['id'] ?>"><img src="img/days.jpeg"></a>
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
                <h3>Days Gone</h3>
                <h5>$50.00</h5>
              </div>
            </div>
        </div>

      </div>

  </section>

<!-- deuxième row -->
<section class="new-product">

</section>
<div class="container">
  <div class="title-box">
    <h2>Action</h2>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="product-top">
        <a href="#"><img src="img/days.jpeg"></a>
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
              <h3>Days Gone</h3>
              <h5>$50.00</h5>
            </div>
          </div>

<div class="col-md-3">
  <div class="product-top">
    <a href="#"><img src="img/zelda1.jpg"></a>
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
        <i class="fa fa-star"></i>
          <h3>Zelda</h3>
          <h5>$100.00</h5>
        </div>
      </div>

<div class="col-md-3">
<div class="product-top">
  <a href="#"><img src="img/assissin.jpg"></a>
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
      <i class="fa fa-star"></i>
        <h3>Assissin</h3>
        <h5>$1000</h5>
      </div>
    </div>


    <div class="col-md-3">
      <div class="product-top">
        <a href="#"><img src="img/link.jpg"></a>
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
            <i class="fa fa-star-half-o"></i>
            <i class="fa fa-star-o"></i>
              <h3>Link to the past</h3>
              <h5>$100</h5>
            </div>
          </div>


          <div class="col-md-3">
            <div class="product-top">
              <a href="#"><img src="img/days.jpeg"></a>
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
                    <h3>Days Gone</h3>
                    <h5>$50.00</h5>
                  </div>
                </div>

      <div class="col-md-3">
        <div class="product-top">
          <a href="#"><img src="img/zelda1.jpg"></a>
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
              <i class="fa fa-star"></i>
                <h3>Zelda</h3>
                <h5>$100.00</h5>
              </div>
            </div>

      <div class="col-md-3">
      <div class="product-top">
        <a href="#"><img src="img/assissin.jpg"></a>
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
            <i class="fa fa-star"></i>
              <h3>Assissin</h3>
              <h5>$1000</h5>
            </div>
          </div>


          <div class="col-md-3">
            <div class="product-top">
              <a href="index.php"><img src="img/link.jpg"></a>
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
                  <i class="fa fa-star-half-o"></i>
                  <i class="fa fa-star-o"></i>
                    <h3>Link to the past</h3>
                    <h5>$100</h5>
                  </div>
                </div>


      </div>

    </div>

  </section>

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

  <!-- <aside class="col-3 border-2 bcolor">
      <div class="w-100 text-center p-4">
          <h5 class="p-2 border-bt text-danger"></h5>

      </div>
  </aside> -->


</main>






























<?php include "footer.php" ?>
