<?php
function estPoste($champ){
	return isset($_POST[$champ]) && trim($_POST[$champ]) !=='';
}

/**
 * Cette fonction vérifie l'existence d'un champ et que la longueur du *champ est comprise entre min et max retourne un booleen
 *@param string $champ le nom du champ à vérifier
 *@param int $min longueur minimale du champ
 *@param int $max longueur maximale du champ
 *@param boolean vrai si la longueur est bien comprise entre min et max,
 *faux sinon
 */
function longueurEntre($champ,$min,$max){

	//on vérifie que le champ est passée en $_POST

	if(estPoste($champ)){

		// on récupère la longueur du champ

		$longueurChamp = strlen($_POST[$champ]);

		// on retourne un booleen vrai si cette longueur est bien comprise entre $min et $ max et faux sinon

		return $longueurChamp >= $min && $longueurChamp <= $max;
		/*
			if($longueurChamp < $min || $longueurChamp > $max){
			return false;
		} else {
			return true;
		}  pour les newbies !!!
		*/
	} else {
		return false;
	}

}


function emailValide($champ){
	return !empty($_POST[$champ])
	&& filter_var($_POST[$champ], FILTER_VALIDATE_EMAIL) !== FALSE;
}
