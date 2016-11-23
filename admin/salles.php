<?php
include 'incs/header.php' ;
$salles = afficherSalles() ;
?>

    <div id="wrapper">

        <?php include 'incs/nav.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Les salles
                            <small>Lokisalle</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">

                    <?php
                    echo '<table class="table table-bordered">' ;
                    echo '<tr>' ;
                    for ($i = 0; $i < $salles -> columnCount(); $i++) {

                         $meta = $salles -> getColumnMeta($i);
                         echo '<th>' . $meta['name'] . '</th>' ;

                    }
                    echo '<th>actions</th>' ;
                    echo '</tr>' ;

                    while ($enregistrement = $salles -> fetch(PDO::FETCH_ASSOC)) {
                        //  var_dump($enregistrement['photo']);
                         echo '<tr>';
                            foreach ($enregistrement as $key => $value) {
                                if($enregistrement[$key] != $enregistrement['photo']) {
                                    echo '<td>' . $enregistrement[$key] .  '</td>' ;
                                } elseif ($enregistrement[$key] == $enregistrement['photo']) {
                                    echo '<td><img src="'. getImageUrl($enregistrement[$key]) .'" class="teaser"> </td>' ;
                                }
                            }

                         echo '<td><a href="salle.php?id=' .$enregistrement['id_salle']. '"><i class="fa fa-search-plus" aria-hidden="true"></i></a> <a href="modifierSalle.php?id='.$enregistrement['id_salle'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <a href="deleteSalle.php?id=' .$enregistrement['id_salle']. '"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                         echo '</tr>';

                    }
                    echo '</table>' ;
                    ?>

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
