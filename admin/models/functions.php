<?php
// Fonction pour les salles
function afficherSalles() {
    $pdo = getDb() ;
    $salles = $pdo -> query('SELECT * from salle') ;
    return $salles ;
}

function afficherSalle($idSalle) {
    $pdo = getDb() ;
    $requeteSalle = $pdo->prepare("SELECT * FROM salle WHERE id_salle = :idSalle") ;
    $requeteSalle->bindValue (':idSalle', $idSalle) ;
    $requeteSalle->execute() ;
    $salle = $requeteSalle->fetch() ;
    return $salle ;
}

function modifierSalle($idSalle, $photo) {
    $pdo = getDb() ;
    $requeteSalleModif = $pdo->prepare("REPLACE INTO salle (id_salle, titre, description, photo, pays, ville, adresse, cp, capacite, categorie) VALUES(:id, :titre, :description, :photo, :pays, :ville, :adresse, :cp, :capacite, :categorie)") ;
    $requeteSalleModif->bindValue (':id', $idSalle) ;
    $requeteSalleModif->bindValue (':titre', $_POST['titre']) ;
    $requeteSalleModif->bindValue (':description', $_POST['description']) ;
    $requeteSalleModif->bindValue (':photo', $photo) ;
    $requeteSalleModif->bindValue (':pays', $_POST['pays']) ;
    $requeteSalleModif->bindValue (':ville', $_POST['ville']) ;
    $requeteSalleModif->bindValue (':adresse', $_POST['adresse']) ;
    $requeteSalleModif->bindValue (':cp', $_POST['cp']) ;
    $requeteSalleModif->bindValue (':capacite', $_POST['capacite']) ;
    $requeteSalleModif->bindValue (':categorie', $_POST['categorie']) ;

    $requeteSalleModif->execute() ;

    return $pdo->lastInsertId() ;
}

function deleteSalle($idSalle) {
    $pdo = getDb() ;
    $requeteSalleDelete = $pdo->prepare("DELETE FROM salle WHERE id_salle = :idSalle") ;
    $requeteSalleDelete->bindValue (':idSalle', $idSalle) ;
    $requeteSalleDelete->execute() ;
}

function ajouterSalle($photo) {
    $pdo = getDb() ;
    $insertion = $pdo->prepare('INSERT INTO salle (titre, description, photo, pays, ville, adresse, cp, capacite, categorie) VALUES (:titre, :description, :photo, :pays, :ville, :adresse, :cp, :capacite, :categorie)') ;

    $insertion->bindValue(':titre', $_POST['titre']) ;
    $insertion->bindValue(':description', $_POST['description']) ;
    $insertion->bindValue(':photo', $photo) ;
    $insertion->bindValue(':pays', $_POST['pays']) ;
    $insertion->bindValue(':ville', $_POST['ville']) ;
    $insertion->bindValue(':adresse', $_POST['adresse']) ;
    $insertion->bindValue(':cp', $_POST['cp']) ;
    $insertion->bindValue(':capacite', $_POST['capacite']) ;
    $insertion->bindValue(':categorie', $_POST['categorie']) ;

    $insertion->execute() ;

    return $pdo->lastInsertId() ;
}
