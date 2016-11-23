<?php
include 'incs/header.php';
require_once '../commons/controles-formulaire.php';


if(!empty($_POST)){
	$champs = array('Titre'=>'titre','Description'=>'description','Pays'=>'pays','Ville'=>'ville','Adresse'=>'adresse');
	$erreurs = array();

	foreach($champs as $champBienEcrit=>$champ){

			if(!estPoste($champ)){

				$erreurs[$champ] = '<span class="red">Le champ '.$champBienEcrit.' est obligatoire.</span>';

			}

		}

	}

	$minTitre = 3;
	$maxTitre = 50;
	$minDescription = 10;


	if($_POST){

		if(!longueurEntre('titre',$minTitre,$maxTitre)){
			$erreurs['titre'] = '<span class="red">La longueur du titre doit être comprise entre '.$minTitre.' et '.$maxTitre.' caractères</span>';
		}

		if(strlen($_POST['description'])< $minDescription){
			$erreurs['description'] = "<span class='red'>La description doit contenir au minimum 10 caractères</span>";
		}

		// je vérifie qu' un avatar a ét envoyé
		if(!empty($_FILES['photo']['tmp_name'])){
			if(is_uploaded_file($_FILES['photo']['tmp_name'])){
				$typeMime = mime_content_type($_FILES['photo']['tmp_name']);
				$typesValides = array('image/jpeg','image/png','image/gif');

				if(in_array($typeMime,$typesValides)){
					$maxSize = 1000000; // 1 mo ce qui est largement suffisant pour un avatar

					if($_FILES['photo']['size'] <= $maxSize){
						$nouveauNomFichier = md5(time().uniqid());
						move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$nouveauNomFichier);
					} else{
						$erreurs['photo'] = "<span class='red'>Le fichier doit faire moins de 1Mo</span>";
					}
				}
				else{
					$erreurs['photo'] = "<span class='red'>Le fichier doit être un jpg, un png ou un gif</span>";
				}
			}
			else {
				$erreurs['photo'] = "<span class='red'>la photo ne s'est pas téléchargée correctement</span>";
			}
		} else {
			$erreurs['photo'] = "<span class='red'>le champs photo est obligatoire</span>";
		}

		if(empty($erreurs)){

			// Inclusion BDD
			ajouterSalle($nouveauNomFichier) ;
			header('Location: salles.php');
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
	echo !empty($_POST['categorie']) && $_POST['categorie'] == $valeurAttendue ? 'checked' : '';
}
function afficherCheck2($valeurAttendue){
	echo !empty($_POST['capacite']) && $_POST['capacite'] == $valeurAttendue ? 'checked' : '';
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
                           Ajouter une salle
                            <small>Lokisalle</small>
                        </h1>

                        <form action='ajouterSalle.php' method='POST' enctype = "multipart/form-data" class="inscription">

                        	<p class="form-group">
                        		<label for="titre">Titre</label>
                        		<input class='form-control' type="text" name="titre" id="titre" placeholder="Titre de la salle" value="<?php afficherPosts('titre'); ?>">
                        		<?php afficherErreurs('titre'); ?>
                        	</p>

                        	<p>
                        		<label for="description">Description</label>
                        		<input class='form-control' type="text" name="description" id="description" placeholder="Description de la salle" value="<?php afficherPosts('description'); ?>">
                        		<?php afficherErreurs('description'); ?>
                        	</p>

                        	<p>
                        		<label for="photo">Photo</label>
                        		<input type="file" name="photo" id="photo">
								<?php afficherErreurs('photo'); ?>
                        	</p>

                        	<p>
                        		<label for="capacite">Capacité</label>
                        		<select class='form-control'  name="capacite" id="capacite">
                        			<option value="10-50" <?php afficherCheck2('10-50'); ?>>10-50</option>
                        			<option value="50-100" <?php afficherCheck2('50-100'); ?>>50-100</option>
                        			<option value="100-150" <?php afficherCheck2('100-150'); ?>>100-150</option>
                        		</select>
                        	</p>

                        	<p>
                        		<label for="categorie">Catégorie</label>
                        		<select class='form-control'  name="categorie" id="categorie">
                        			<option value="Réunion" <?php afficherCheck('Réunion'); ?>>Réunion</option>
                        			<option value="Bureau" <?php afficherCheck('Bureau'); ?>>Bureau</option>
                        			<option value="Formation" <?php afficherCheck('Formation'); ?>>Formation</option>
                        		</select>
                        	</p>

                        	<p>
                        		<label for="pays">Pays</label>
                        		<input class='form-control' type="text" name="pays" id="pays" placeholder="Pays" value="<?php afficherPosts('pays'); ?>">
                        		<?php afficherErreurs('pays'); ?>
                        	</p>

                        	<p>
                        		<label for="ville">Ville</label>
                        		<select class='form-control' name="ville" id="ville">
                        			<option value="Paris" <?php afficherCheck('Paris'); ?>>Paris</option>
                        			<option value="Lyon" <?php afficherCheck('Lyon'); ?>>Lyon</option>
                        			<option value="Marseille" <?php afficherCheck('Marseille'); ?>>Marseille</option>
                        		</select>
                        		<?php afficherErreurs('categorie'); ?>
                        	</p>

							<p class="form-group">
                        		<label for="cp">Code postal</label>
                        		<input class='form-control' type="text" name="cp" id="cp" placeholder="Code postal" value="<?php afficherPosts('cp'); ?>">
                        		<?php afficherErreurs('cp'); ?>
                        	</p>

                        	<p>
                        		<label for="adresse">Adresse</label>
                        		<input class='form-control' type="text" name="adresse" id="adresse" placeholder="Adresse de la salle" value="<?php afficherPosts('adresse'); ?>">
                        		<?php afficherErreurs('adresse'); ?>
                        	</p>




                        	<p>
                        		<input class='form-control' type="submit" name="send" value="Ajouter une salle" class="button">
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
