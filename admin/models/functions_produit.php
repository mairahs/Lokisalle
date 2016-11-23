<?php

function afficherProduits(){
     $pdo = getDb() ;
     $produits = $pdo -> query('SELECT produit.*, salle.photo, salle.titre from produit JOIN salle ON salle.id_salle = produit.id_salle') ;
     return $produits;
}


function ajouterProduit(){
   $pdo = getDb() ;
   $insertionProduit = $pdo->prepare('INSERT INTO produit (id_salle,date_arrivee,date_depart,prix) VALUES(:id_salle, :date_arrivee, :date_depart, :prix)');
   $insertionProduit->bindValue(':id_salle', $_POST['salle']);
   $insertionProduit->bindValue(':date_arrivee', $_POST['dateArrivee']);
   $insertionProduit->bindValue(':date_depart', $_POST['dateDepart']);
   $insertionProduit->bindValue(':prix', $_POST['tarif']);

   $insertionProduit->execute();
   return $pdo->lastInsertId() ;
}


function afficherProduitParSonId($id){
     $pdo = getDb() ;
     $produitParSonId = $pdo->prepare('SELECT * FROM produit JOIN salle ON salle.id_salle = produit.id_salle WHERE id_produit=:id_produit ' );
     $produitParSonId->bindValue(':id_produit',$id);
     $produitParSonId->execute();
     $resultat = $produitParSonId->fetch();

     return $resultat;

}

function modifierProduit($idProduit) {
    $pdo = getDb() ;
    $requeteProduitModif = $pdo->prepare("REPLACE INTO produit (id_produit, id_salle, date_arrivee, date_depart, prix) VALUES(:id, :id_salle, :date_arrivee, :date_depart, :prix)") ;
    $requeteProduitModif->bindValue (':id', $idProduit) ;
    $requeteProduitModif->bindValue (':id_salle', $_POST['salle']) ;
    $requeteProduitModif->bindValue (':date_arrivee', $_POST['dateArrivee']) ;
    $requeteProduitModif->bindValue (':date_depart', $_POST['dateDepart']) ;
    $requeteProduitModif->bindValue (':prix', $_POST['tarif']) ;

    $requeteProduitModif->execute() ;

    return $pdo->lastInsertId() ;
}

function deleteProduit($idProduit) {
    $pdo = getDb() ;
    $requeteProduitDelete = $pdo->prepare("DELETE FROM produit WHERE id_produit = :idProduit") ;
    $requeteProduitDelete->bindValue (':idProduit', $idProduit) ;
    $requeteProduitDelete->execute() ;
}

function afficherProduitsAutres($id){
    $pdo = getDb();
    $produitsAutres = $pdo->prepare('SELECT produit.*, salle.photo, salle.titre,salle.description FROM produit JOIN salle ON salle.id_salle = produit.id_salle WHERE produit.id_produit != :id_produit');
    $produitsAutres->bindValue(':id_produit', $id);
    $produitsAutres->execute();
    $resultat = $produitsAutres->fetchAll();
    return $resultat;
}
