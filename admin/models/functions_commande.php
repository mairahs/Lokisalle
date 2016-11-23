<?php

function commande($idProduit, $idMembre) {
    $pdo = getDb() ;
    $insertion = $pdo->prepare('INSERT INTO commande (id_membre, id_produit, date_enregistrement) VALUES (:id_membre, :id_produit, NOW())') ;
    $insertion->bindValue(':id_membre', $idMembre) ;
    $insertion->bindValue(':id_produit', $idProduit) ;
    $insertion->execute() ;

    $update = $pdo->prepare('UPDATE produit SET etat = "réservation" WHERE id_produit = :idProduit') ;
    $update->bindValue(':idProduit', $idProduit) ;
    $update->execute() ;
}

function test ($idProduit) {
    $pdo = getDb() ;
    $requeteSalle = $pdo->prepare("SELECT * FROM commande WHERE id_produit = :id_produit") ;
    $requeteSalle->bindValue (':id_produit', $idProduit) ;
    $requeteSalle->execute() ;
    $salle = $requeteSalle->fetch() ;
    return $salle ;
}
