<?php
include 'incs/header.php' ;
include 'incs/nav.php' ;
require_once 'admin/models/functions_produit.php' ;
require_once 'admin/models/functions_commande.php' ;
require_once 'commons/controles-formulaire.php';
require_once 'admin/models/functions_avis.php';
require_once 'admin/models/functions.php';

if(isset($_GET) && isset( $_GET['id'] )) {
    $idProduit = $_GET['id'];
        if(estConnecte()) {
            $idMembre = $_SESSION['membre']['id_membre'];
        }
    if(ctype_digit($idProduit)) {
        $produitParSonId = afficherProduitParSonId($idProduit);
        $produitsAutres = afficherProduitsAutres($idProduit);
        $etat = $produitParSonId['etat'];
        $idSalle = $produitParSonId['id_salle'];
        $avis = afficherAvisParSalle($idSalle);
    }
}

?>
    <!-- Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <h1 class="page-header"><?php echo $produitParSonId['titre']; ?>
                    <small></small>
                </h1>
            </div>
            <div class="col-xs-12 col-md-3 retour">
                <a href="index.php"><button type="button" name="button" class="btn btn-default">Retour aux salles</button></a>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <img class="img-responsive" src="images/<?php echo $produitParSonId['photo']; ?>" alt="">
            </div>

            <div class="col-md-4">
                <h3>Description</h3>
                <p><?php echo $produitParSonId['description']; ?></p>
                <h3>Informations</h3>
                <?php
                    $date = substr($produitParSonId['date_arrivee'], 0, 10);
                    $dateDepart = substr($produitParSonId['date_depart'], 0, 10);
                ?>
                <p><i class="fa fa-calendar" aria-hidden="true"></i> Arrivée : <?php echo $date ?></p>
                <p><i class="fa fa-calendar" aria-hidden="true"></i> Départ : <?php echo $dateDepart ?></p>
                <p><i class="fa fa-users" aria-hidden="true"></i> Capacité : <?php echo $produitParSonId['capacite']; ?> personnes</p>
                <p><i class="fa fa-bullseye" aria-hidden="true"></i> Catégorie : <?php echo $produitParSonId['categorie']; ?> personnes</p>
                <p><i class="fa fa-location-arrow" aria-hidden="true"></i> Adresse : <?php echo $produitParSonId['adresse']; ?> personnes</p>
                <p><i class="fa fa-eur" aria-hidden="true"></i> Prix : <?php echo $produitParSonId['prix']; ?> €</p>

                <form action="" method="post">
                    <input type="hidden" name="id_membre" value="<?php echo estConnecte() ? $idMembre : '' ?>">
                    <input type="hidden" name="id_produit" value="<?php echo $idProduit ?>">
                    <p><button type="submit" name="commande" value="commande" class="btn btn-primary"
                    <?php
                    if (!estConnecte() || $etat === 'réservation') echo "disabled";
                    ?>>Réserver</button></p>
                </form>
                <?php
                    if (isset($_POST['commande']) ) {
                        commande($_POST['id_produit'], $_POST['id_membre']) ;
                    }
                ?>

            </div>

        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">


            <div class="col-lg-12">
                <h3 class="page-header">Les autres produits</h3>
            </div>

            <?php
                    foreach($produitsAutres as $produitAutre){?>
                        <div class="col-sm-3 col-xs-6">
                            <a href="produit.php?id=<?php echo $produitAutre['id_produit']; ?>">
                                <img class="img-responsive portfolio-item" src="images/<?php echo $produitAutre['photo']; ?>" alt="">
                            </a>

                             <a href="produit.php?id=<?php echo $produitAutre['id_produit']; ?>"><p><?php echo $produitAutre['titre'] ?></p></a>

                            <p>
                                <?php echo substr($produitAutre['description'],0,100); ?>
                            </p>
                        </div>
                <?php
                    }
                ?>
        </div>
        <!-- Fin related project -->

        <hr>

        <!-- Donner avis -->
        <div class="row">
            <div class="col-lg-8">
                <?php if(estConnecte()) { include 'incs/avisProduit.php' ;} else echo '<p><a href="connexion.php">Connectez-vous pour poster un commentaire</a></p>' ?>
            </div>
        </div>
        <!-- Fin donner avis -->

        <hr>
        <!-- Avis -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Les commentaires sur la salle</h3>
            </div>
            <div class="col-lg-8 well">
                <?php
                    foreach ($avis as $unAvis) {
                        echo '<p>' . $unAvis['commentaire'] . '</p>';
                        echo '<p>Note : ' . $unAvis['note'] . '</p>';
                        echo '<hr>' ;
                    }
                ?>
            </div>
        </div>


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
