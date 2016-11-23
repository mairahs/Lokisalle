<?php
include 'incs/header.php' ;
include 'incs/nav.php' ;
require_once 'admin/models/functions_produit.php' ;
$produits = afficherProduits();
?>

    <!-- Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Lokisalle :
                    <small>Les produits</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-3">
                  <p class="lead">Catégorie</p>
                  <div class="list-group">
                      <a href="#" class="list-group-item">Réunion</a>
                      <a href="#" class="list-group-item">Bureau</a>
                      <a href="#" class="list-group-item">Formation</a>
                  </div>
                  <p class="lead">Villes</p>
                  <div class="list-group">
                      <a href="#" class="list-group-item">Paris</a>
                      <a href="#" class="list-group-item">Lyon</a>
                      <a href="#" class="list-group-item">Marseille</a>
                  </div>
              </div>
          <div class="col-md-9">
              <?php

              while ($enregistrement = $produits -> fetch(PDO::FETCH_ASSOC)) {
                 echo '<div class="col-xl-4 ten-column">';
                 echo '<a href="produit.php?id=' .$enregistrement['id_produit']. '"><img src="'. getImageUrl($enregistrement['photo']) .'" class="teaser"></a>' ;
                 echo '<h4>' . $enregistrement['titre'] . '</h4>';
                 echo '<h4>' . $enregistrement['prix'] . ' €</h4>';
                 $date = substr($enregistrement['date_arrivee'], 0, 10);
                 $dateDepart = substr($enregistrement['date_depart'], 0, 10);
                 echo '<h5>' . $date . ' au ' . $dateDepart . '</h4>';
                 echo '<a href="produit.php?id=' .$enregistrement['id_produit']. '"><i class="fa fa-search" aria-hidden="true"></i> Voir</a>' ;
                 echo '</div>' ;
              }

              ?>

          </div>
        </div>

        <hr>

        <!-- Footer -->
        <?php include 'incs/footer.php' ; ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
