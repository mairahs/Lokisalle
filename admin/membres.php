<?php
include 'incs/header.php' ;
$membres = afficherMembres() ;
?>

<div id="wrapper">

    <?php include 'incs/nav.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Les membres
                        <small>Lokisalle</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">

                <?php
                echo '<table class="table table-bordered">' ;
                echo '<tr>' ;

                for($i =0; $i < $membres -> columnCount(); $i ++){ 
                    $meta = $membres -> getColumnMeta($i); 
                    echo '<th>' . $meta['name'] . '</th>' ;
                }
                echo '<th>actions</th>' ;
                echo '<tr>';

                while($enregistrement = $membres -> fetch(PDO::FETCH_ASSOC)){
                echo '<tr>';
                    foreach($enregistrement as $valeur){
                        echo '<td>' . $valeur . '</td>';
                    }
                    echo '<td><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <i class="fa fa-search-plus" aria-hidden="true">
                    <i class="fa fa-trash" aria-hidden="true"></i></td>';
                    echo '</tr>';
                }

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

