<?php
// Fonction pour Membres
function afficherMembres() {
    $pdo = getDb() ;
    $membres = $pdo -> query('SELECT * from membre') ;
    return $membres ;
} ;


function ajouterMembre($infos) {
    $pdo = getDb() ;
    $requetePreparee = $pdo->prepare('INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :statt, now())') ;

    $requetePreparee->bindValue(':pseudo', $infos['pseudo']) ;
    $requetePreparee->bindValue(':mdp', $infos['mdp']) ;
    // $requetePrepare->bindValue('mdp', password_hash($infos['mdp'], PASSWORD_DEFAULT));
    $requetePreparee->bindValue(':nom', $infos['nom']) ;
    $requetePreparee->bindValue(':prenom', $infos['prenom']) ;
    $requetePreparee->bindValue(':email', $infos['email']) ;
    $requetePreparee->bindValue(':civilite', $infos['civilite']) ;
    $requetePreparee->bindValue(':statut', $infos['statut']) ;

    $requetePreparee->execute() ;

    return $pdo->lastInsertId() ;
}

function emailOuPseudoExistent ($email, $pseudo){
    $pdo = getDb();

    $requeteEmailPseudo = $pdo->prepare('SELECT pseudo, email FROM membre WHERE email = :email OR pseudo = :pseudo');

    $requeteEmailPseudo->bindValue(':email', $email);
    $requeteEmailPseudo->bindValue(':pseudo', $pseudo);

    $requeteEmailPseudo->execute();

    return $requeteEmailPseudo->fetch() !== FALSE;
}

function getMembreParSonPseudo($pseudo){
    $pdo = getDb();

    $requeteMembre = $pdo->prepare("SELECT * FROM `membre` WHERE pseudo = :pseudo");

    $requeteMembre->bindValue(':pseudo', $pseudo);

    $requeteMembre->execute();

    $infos = $requeteMembre->fetch();

    return $infos;
}
