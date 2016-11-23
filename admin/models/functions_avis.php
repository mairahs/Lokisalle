<?php

function afficherAvis(){
	$pdo = getDb() ;
	$resultat = $pdo->query('SELECT * FROM avis');
	return $resultat;
}

function afficherAvisParSalle($idSalle){
	$pdo = getDb() ;
	$requeteAvis = $pdo->prepare("SELECT * FROM avis WHERE id_salle = :idSalle") ;
	$requeteAvis->bindValue (':idSalle', $idSalle) ;
	$requeteAvis->execute() ;
	$salle = $requeteAvis->fetchAll() ;
	return $salle ;
}

function ajouterAvis(){
	$pdo = getDb() ;
	$newAvis = $pdo->prepare('INSERT INTO avis (id_membre, id_salle, commentaire, note, date_enregistrement) VALUES (:id_membre, :id_salle, :commentaire, :note, NOW())');

	$newAvis->bindValue(':id_membre',$_POST['id_membre']);
	$newAvis->bindValue(':id_salle',$_POST['id_salle']);
	$newAvis->bindValue(':commentaire',$_POST['commentaire']);
	$newAvis->bindValue(':note',$_POST['note']);

	$newAvis->execute();

	return $pdo->lastInsertId();
}

function deleteAvis($idAvis) {
    $pdo = getDb() ;
    $requeteAvisDelete = $pdo->prepare("DELETE FROM avis WHERE id_avis = :idAvis") ;
    $requeteAvisDelete->bindValue (':idAvis', $idAvis) ;
    $requeteAvisDelete->execute() ;
}
