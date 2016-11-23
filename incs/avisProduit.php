<?php
$salles = afficherSalles();

if(!empty($_POST)){
	$champs = array('Commentaire'=>'commentaire','Note sur 5'=>'note');
	$erreurs = array();

	foreach($champs as $champBienEcrit=>$champ){

			if(!estPoste($champ)){
				$erreurs[$champ] = '<span class="red">Le champ '.$champBienEcrit.' est obligatoire.</span>';
			}

		}

        if(empty($erreurs)){
            ajouterAvis();
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


<form action='' method='POST'>

    <p class="form-group">
        <input type="hidden" name="id_membre" id="id_membre" value="<?php echo $idMembre ?>">
    </p>

    <p>
        <input type="hidden" name="id_salle" id="id_salle" value="<?php echo $idSalle ?>">
    </p>

    <p>
        <label for="commentaire">Commentaire</label>
        <input class='form-control' type="text" name="commentaire" id="commentaire" placeholder="Votre commentaire" value="<?php afficherPosts('commentaire'); ?>">
        <?php afficherErreurs('commentaire'); ?>
    </p>


    <p>
        <label for="note">Votre note de 1 à 5</label>
        <select class='form-control'  name="note" id="note">
            <option value="1" <?php afficherCheck('1'); ?>>1</option>
            <option value="2" <?php afficherCheck('2'); ?>>2</option>
            <option value="3" <?php afficherCheck('3'); ?>>3</option>
            <option value="4" <?php afficherCheck('4'); ?>>4</option>
            <option value="5" <?php afficherCheck('5'); ?>>5</option>
        </select>
    </p>


    <p>
        <input class='form-control' type="submit" name="send" value="Ajouter un avis" class="button">
    </p>

</form>
