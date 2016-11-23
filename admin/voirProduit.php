<?php
include 'incs/header.php';
require_once 'models/functions.php';

if(isset($_GET) && isset( $_GET['id'] )) {

    $idProduit = $_GET['id'];

    if(ctype_digit($idProduit)) {
        $produitParSonId = afficherProduitParSonId($idProduit);
    }
}

?>


<?php include 'incs/nav.php'; ?>
    <div id="wrapper">

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Voir le produit
                            <small>Lokisalle</small>
                        </h1>


                            <div class="row">
                                <div class="col-xs-12 col-md-9"><h2>Produit : <?php echo $produitParSonId['titre']; ?></h2></div>
                                <div class="col-xs-12 col-md-3">
                                    <a href="produits.php"><button type="button" name="button" class="btn btn-default">Retour aux produits</button></a>
                                    <a href="modifierProduit.php?id=<?php echo $idProduit ?>"><button type="button" name="button" class="btn btn-default">Modifier</button></a>
                                    <a href="#"><button type="button" name="button" class="btn btn-default">Supprimer</button></a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <?php echo '<img src="'. getImageUrl($produitParSonId['photo']) .'" class="contenu">' ?>
                                </div>
                                <div class="col-xs-12 col-md-8">
                                    <p>Date d'arrivée: <?php echo $produitParSonId['date_arrivee']; ?></p>
                                     <p>Date de départ: <?php echo $produitParSonId['date_depart']; ?></p>
                                     <p>Prix: <?php echo $produitParSonId['prix']; ?> euros</p>

                                </div>
                            </div>

                        </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
