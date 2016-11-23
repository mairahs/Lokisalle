<?php
include 'incs/header.php';
require_once '../commons/controles-formulaire.php';
$idSalle = $_GET['id'] ;
$salle = afficherSalle($idSalle) ;

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
			$erreurs['titre'] = 'La longueur du titre doit être comprise entre '.$minTitre.' et '.$maxTitre.' caractères';
		}

		if(strlen($_POST['description'])< $minDescription){
			$erreurs['description'] = "La description doit contenir au minimum 10 caractères";
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
						$erreurs['photo'] = "Le fichier doit faire moins de 1Mo";
					}
				}
				else{
					$erreurs['photo'] = "Le fichier doit être un jpg, un png ou un gif";
				}
			}
			else {
				$erreurs['photo'] = "la photo ne s'est pas téléchargée correctement";
			}
		} else {
			$nouveauNomFichier = $salle['photo'] ;
		}

		if(empty($erreurs)){

			// Inclusion BDD
			modifierSalle($idSalle, $nouveauNomFichier) ;
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

function afficherCheckCategorie($valeurAttendue){
	$idSalle = $_GET['id'] ;
	$salle = afficherSalle($idSalle) ;
	echo !empty($salle['categorie']) && $salle['categorie'] == $valeurAttendue ? ' selected' : '';
}
function afficherCheckCapacite($valeurAttendue){
	$idSalle = $_GET['id'] ;
	$salle = afficherSalle($idSalle) ;
	echo !empty($salle['capacite']) && $salle['capacite'] == $valeurAttendue ? ' selected' : '';
}
function afficherCheckVille($valeurAttendue){
	$idSalle = $_GET['id'] ;
	$salle = afficherSalle($idSalle) ;
	echo !empty($salle['ville']) && $salle['ville'] == $valeurAttendue ? ' selected' : '';
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
                           Modifier la salle :
                            <small><?php echo $salle['titre']; ?></small>
                        </h1>

                        <form action='modifierSalle.php?id=<?php echo $idSalle ?>' method='POST' enctype = "multipart/form-data" class="inscription">

                        	<p class="form-group">
                        		<label for="titre">Titre</label>
                        		<input class='form-control' type="text" name="titre" id="titre" placeholder="Titre de la salle" value='<?php echo $salle['titre']; ?>'>
                        		<?php afficherErreurs('titre'); ?>
                        	</p>

                        	<p>
                        		<label for="description">Description</label>
                        		<input class='form-control' type="text" name="description" id="description" placeholder="Description de la salle" value="<?php echo $salle['description']; ?>">
                        		<?php afficherErreurs('description'); ?>
                        	</p>

							<p>
								<?php echo '<img src="'. getImageUrl($salle['photo']) .'" class="teaser">' ?>
							</p>
                        	<p>
                        		<label for="photo">Modifier la photo</label>
                        		<input type="file" name="photo" id="photo">
								<?php afficherErreurs('photo'); ?>
                        	</p>

                        	<p>
                        		<label for="capacite">Capacité</label>
                        		<select class='form-control'  name="capacite" id="capacite">
                        			<option value="10-50" <?php afficherCheckCapacite('10-50'); ?>>10-50</option>
                        			<option value="50-100" <?php afficherCheckCapacite('50-100'); ?>>50-100</option>
                        			<option value="100-150" <?php afficherCheckCapacite('100-150'); ?>>100-150</option>
                        		</select>
                        	</p>

                        	<p>
                        		<label for="categorie">Catégorie</label>
                        		<select class='form-control'  name="categorie" id="categorie">
                        			<option value="Réunion" <?php afficherCheckCategorie('Réunion'); ?>>Réunion</option>
                        			<option value="Bureau" <?php afficherCheckCategorie('Bureau'); ?>>Bureau</option>
                        			<option value="Formation" <?php afficherCheckCategorie('Formation'); ?>>Formation</option>
                        		</select>
                        	</p>

                        	<p>
                        		<label for="pays">Pays</label>
                        		<input class='form-control' type="text" name="pays" id="pays" placeholder="Pays" value="<?php echo $salle['pays']; ?>">
                        		<?php afficherErreurs('pays'); ?>
                        	</p>

                        	<p>
                        		<label for="ville">Ville</label>
                        		<select class='form-control' name="ville" id="ville">
                        			<option value="Paris" <?php afficherCheckVille('Paris'); ?>>Paris</option>
                        			<option value="Lyon" <?php afficherCheckVille('Lyon'); ?>>Lyon</option>
                        			<option value="Marseille" <?php afficherCheckVille('Marseille'); ?>>Marseille</option>
                        		</select>
                        		<?php afficherErreurs('categorie'); ?>
                        	</p>

							<p class="form-group">
                        		<label for="cp">Code postal</label>
                        		<input class='form-control' type="text" name="cp" id="cp" placeholder="Code postal" value="<?php echo $salle['cp']; ?>">
                        		<?php afficherErreurs('cp'); ?>
                        	</p>

                        	<p>
                        		<label for="adresse">Adresse</label>
                        		<input class='form-control' type="text" name="adresse" id="adresse" placeholder="Adresse de la salle" value="<?php echo $salle['adresse']; ?>">
                        		<?php afficherErreurs('adresse'); ?>
                        	</p>


                        	<p>
                        		<input class='form-control' type="submit" name="send" value="Modifier la salle" class="button">
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
