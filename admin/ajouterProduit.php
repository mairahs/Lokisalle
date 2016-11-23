<?php
include 'incs/header.php';
require_once '../commons/controles-formulaire.php';
require_once 'models/functions.php';

$salles = afficherSalles();

//var_dump($salles);



if(!empty($_POST)){
	$champs = array('Date d\'arrivée'=>'dateArrivee','Date de départ'=>'dateDepart','Salle'=>'salle','Tarif'=>'tarif');
	$erreurs = array();

	foreach($champs as $champBienEcrit=>$champ){

			if(!estPoste($champ)){

				$erreurs[$champ] = '<span class="red">Le champ '.$champBienEcrit.' est obligatoire.</span>';

			}

		}

        if(empty($erreurs)){

            // Inclusion BDD
            ajouterProduit();
            header('Location: produits.php');

        }


}




function afficherErreurs($champ){
	global $erreurs;
	echo !empty($erreurs[$champ]) ? $erreurs[$champ] : '';
}

function afficherPosts($champ){
	// je vérifie qu une valeur a bien été postée pour ce nom de champ et si c'est le cas, j affiche cette valeur
	echo !empty($_POST[$champ]) ? $_POST[$champ] : '';
}

function afficherCheck($valeurAttendue){
	echo !empty($_POST['salle']) && $_POST['salle'] == $valeurAttendue ? 'checked' : '';
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
                           Ajouter un produit
                            <small>Lokisalle</small>
                        </h1>

                        <form action='ajouterProduit.php' method='POST'>

                        	<p class="form-group">
                        		<label for="dateArrivee">Date d'arrivée</label>
                        		<input class='form-control' type="date" name="dateArrivee" id="dateArrivee" placeholder="Date d'arrivée" value="<?php afficherPosts('dateArrivee'); ?>">
                        		<?php afficherErreurs('dateArrivee'); ?>
                        	</p>

                        	<p class="form-group">
                                <label for="dateDepart">Date de départ</label>
                                <input class='form-control' type="date" name="dateDepart" id="dateDepart" placeholder="Date de  départ" value="<?php afficherPosts('dateDepart'); ?>">
                                <?php afficherErreurs('dateDepart'); ?>
                            </p>

                            <p>
                                <label for="salle">Salle</label>
                                <select class='form-control'  name="salle" id="salle">

                                   <?php
                                   while ($enregistrement = $salles -> fetch(PDO::FETCH_ASSOC)){

                                         echo '<option value="' . $enregistrement['id_salle'] .  '">' . $enregistrement['id_salle'] . ' - ' . $enregistrement['titre'] .' - '.$enregistrement['adresse'].' - '.$enregistrement['cp']. '</option>';

                                    }
                                    ?>
                                </select>
                            </p>


                            <p class="input-group">
                                <label for="salle">Tarif</label>
                                <span class="input-group-addon">€</span>
                                <input type="text" class="form-control" type="text" name="tarif" id="tarif" placeholder="Prix en euros" value="<?php afficherPosts('tarif'); ?>">
                                <?php afficherErreurs('tarif'); ?>
                              </p>


                        	<p>
                        		<input class='form-control' type="submit" name="send" value="Ajouter un produit" class="button">
                        	</p>

                        </form>

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
