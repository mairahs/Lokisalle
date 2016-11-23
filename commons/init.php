<?php
// Connection à la base de données

function getDb() {

	global $db ;

	if($db === NULL) {
		$host = 'localhost';
		$base = 'lokisalle';
		$utilisateurBdd = 'root';
		$mdpBdd = '';
		$dsn = 'mysql:dbname='.$base.';host='.$host.';charset=utf8';

		try{
			$db = new PDO($dsn, $utilisateurBdd, $mdpBdd);

		} catch (Exception $ex) {
			die('Erreur de communication avec la base de données : '.$ex->getMessage());
		}

	}

	return $db;
}

// Function de session
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

// Function url absolue images
function getImageUrl($image) {
	$rootUrl = $_SERVER['SERVER_NAME'];
	$chemin = 'http://' . $rootUrl . '/lokisalle/images/' . $image ;
	return $chemin;
}
