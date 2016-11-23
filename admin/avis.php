<?php
include 'incs/header.php' ;
require_once 'models/functions_avis.php';
$avis = afficherAvis();


?>

    <div id="wrapper">

        <?php include 'incs/nav.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Les avis
                            <small>Lokisalle</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">

                    <?php
                    echo '<table class="table table-bordered">' ;
                    echo '<tr>' ;
                    for ($i = 0; $i < $avis -> columnCount(); $i++) {

                         $meta = $avis -> getColumnMeta($i);
                         echo '<th>' . $meta['name'] . '</th>' ;

                    }
                    echo '<th>actions</th>' ;
                    echo '</tr>' ;

                    while ($enregistrement = $avis -> fetch(PDO::FETCH_ASSOC)) {



                         echo '<tr>';

                            foreach ($enregistrement as $key => $value) {

                                 echo '<td>' . $enregistrement[$key] .  '</td>' ;
                             }

                             echo'<td><a href ="voirAvis.php?id='.$enregistrement['id_avis'].'"><i class="fa fa-search-plus" aria-hidden="true"></i></a> <a href="modifierAvis.php?id='.$enregistrement['id_avis'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>  <a href="deleteAvis.php?id='.$enregistrement['id_avis'].'"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';


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
