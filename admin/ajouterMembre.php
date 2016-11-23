<?php
include 'incs/header.php';
require_once '../commons/controles-formulaire.php';

if(!empty($_POST)){
	$champs = array('Pseudo'=>'pseudo','Mot de passe'=>'mdp','Nom'=>'nom','Prénom'=>'prenom','Email'=>'email', 'Civilité'=>'civilite', 'Statut'=>'statut');
	$erreurs = array();

	foreach($champs as $champBienEcrit=>$champ){

		if(!estPoste($champ)){

			$erreurs[$champ] = '<span class="red">Le champ '.$champBienEcrit.' est obligatoire.</span>';

		}
	}

	$minPseudo = 3;
	$maxPseudo = 50;
	if(! longueurEntre('pseudo', $minPseudo, $maxPseudo)){
		$erreurs['pseudo'] = '<span class="red">La longueur du pseudo doit etre comprise entre ' .$minPseudo.' et ' .$maxPseudo.' caractères</span>';
	}

	$minMotDePasse = 3;
	$maxMotDePasse = 50;
	if(! longueurEntre('mdp', $minMotDePasse, $maxMotDePasse)){
		$erreurs['mot_de_passe'] = '<span class="red">La longueur du mot de passe doit etre comprise entre ' .$minMotDePasse.' et ' .$maxMotDePasse.' caractères</span>';
	}

	$minNom = 3;
	$maxNom = 50;
	if(! longueurEntre('nom', $minNom, $maxNom)){
		$erreurs['nom'] = '<span class="red">La longueur du nom doit etre comprise entre ' .$minNom.' et ' .$maxNom.' caractères</span>';
	}

	$minPrenom = 3;
	$maxPrenom = 50;
	if(! longueurEntre('prenom', $minPrenom, $maxPrenom)){
		$erreurs['prenom'] = '<span class="red">La longueur du prénom doit etre comprise entre ' .$minPrenom.' et ' .$maxPrenom.' caractères</span>';
	}

	if( ! emailValide('email')){
		$erreurs['email'] = "<span class='red'>Ce champ n'est pas un email valide</span>";
	}

	if (!empty($_POST['civilite']) && ! in_array($_POST['civilite'], ['Monsieur', 'Madame']) ) {
		$erreurs['civilite'] = "Veuillez renseigner le champ";
		$test = 'test';

	}

	if (!empty($_POST['statut']) && ! in_array($_POST['statut'], ['admin', 'membre']) ) {
		$erreurs['statut'] = "Veuillez renseigner le champ";

	}

	// Traitement du formulaire (insertion de l'utilisateur en base)

	if(empty($erreurs) ) {

			if( ! emailOuPseudoExistent($_POST['email'], $_POST['pseudo'])){

				if(!empty($nouveauNomFichier)){
					$idNouveauMembre = ajouterMembre($_POST, $nouveauNomFichier);

				}else{

					$idNouveauMembre = ajouterMembre($_POST);
				}

			$_SESSION['membre'] = array_merge($_POST, array('id' => $idNouveauMembre));

			redirectPage('membres');

		}else{
			$erreurs['pseudo'] = "L'email ou le pseudo existent";
		}
	}
}

function afficherErreur($champ){

	global $erreurs;

	echo(!empty($erreurs[$champ]) ? $erreurs[$champ] : '');
}

function afficherPost($champ){

	echo (!empty($_POST[$champ]) ? $_POST[$champ] : '');
}

function afficherCheck( $valeurAttendue){

	echo(!empty($_POST['civilite']) && $_POST['civilite'] == $valeurAttendue) ? 'selected' : '';
	echo(!empty($_POST['statut']) && $_POST['statut'] == $valeurAttendue) ? 'selected' : '';
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
						Ajouter un membre
						<small>Lokisalle</small>
					</h1>
					<form action='ajouterMembre.php' method='POST' enctype = "multipart/form-data" class="inscription_membre">

						<p class="form-group">
							<label for="pseudo">Pseudo</label>
							<input class='form-control' type="text" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php afficherPost('pseudo'); ?>">
							<?php afficherErreur('pseudo'); ?>
						</p>

						<p>
							<label for="mdp">Mot de Passe</label>
							<input class='form-control' type="password" name="mdp" id="mdp" placeholder="Mot de Passe" value="<?php afficherPost('mdp'); ?>">
							<?php afficherErreur('mdp'); ?>
						</p>

						<p>
							<label for="nom">Nom</label>
							<input class='form-control' type="text" name="nom" id="nom" placeholder="Votre nom" value="<?php afficherPost('nom'); ?>">
							<?php afficherErreur('nom'); ?>
						</p>

						<p>
							<label for="prenom">Prénom</label>
							<input class='form-control' type="text" name="prenom" id="prenom" placeholder="Votre prénom" value="<?php afficherPost('prenom'); ?>">
							<?php afficherErreur('prenom'); ?>
						</p>

						<p>
							<label for="email">Email :</label>
							<input class='form-control' type="email" name="email" id="email" placeholder="Votre email" value="<?php afficherPost('email'); ?> ">
							<?php afficherErreur('email');?>
						</p>

						<p>
							<label for="civilite">Civilité</label>
							<select class='form-control'  name="civilite" id="civilite">
								<option value="Monsieur" <?php afficherCheck('Monsieur'); ?>>Monsieur</option>
								<option value="Madame" <?php afficherCheck('Madame'); ?>>Madame</option>
							</select>
						</p>

						<p>
							<label for="statut">Statut</label>
							<select class='form-control'  name="statut" id="statut">
								<option value="admin" <?php afficherCheck('admin'); ?>>Admin</option>
								<option value="membre" <?php afficherCheck('membre'); ?>>Membre</option>
							</select>
						</p>

						<p>
							<input class='form-control' type="submit" name="send" value="Ajouter un membre" class="button">
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
