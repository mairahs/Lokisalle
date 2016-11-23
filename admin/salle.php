<?php
include 'incs/header.php' ;
$idSalle = $_GET['id'] ;
$salle = afficherSalle($idSalle) ;
?>

    <div id="wrapper">

        <?php include 'incs/nav.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Salles
                            <small>Lokisalle</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-xs-12 col-md-9"><h2><?php echo $salle['titre']; ?></h2></div>
                    <div class="col-xs-12 col-md-3">
                        <a href="salles.php"><button type="button" name="button" class="btn btn-default">Retour aux salles</button></a>
                        <a href="modifierSalle.php?id=<?php echo $idSalle ?>"><button type="button" name="button" class="btn btn-default">Modifier</button></a>
                        <a href="deleteSalle.php?id=<?php echo $idSalle ?>"><button type="button" name="button" class="btn btn-default">Supprimer</button></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <?php echo '<img src="'. getImageUrl($salle['photo']) .'" class="contenu">' ?>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <p><?php echo $salle['description']; ?></p>
                        <p><?php echo $salle['pays']; ?></p>
                        <p><?php echo $salle['ville']; ?></p>
                        <p><?php echo $salle['adresse']; ?></p>
                        <p><?php echo $salle['cp']; ?></p>
                        <p><?php echo $salle['capacite']; ?></p>
                        <p><?php echo $salle['categorie']; ?></p>
                    </div>
                </div>

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
