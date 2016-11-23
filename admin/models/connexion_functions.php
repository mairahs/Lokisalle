<?php
require_once 'start_session.php';
require_once 'url_functions.php';

function estConnecte() {
    return isset($_SESSION['membre']);
}

function connectAdmin() {
    if (!estConnecte()) {
        header('location: ../index.php');
    } elseif ($_SESSION['membre']['statut'] !== 'admin') {
        header('location: ../index.php');
    }
}

function verifierConnexion() {
    $page = getPage();
    if($page != 'connexion') {
        if( ! estConnecte()) {
            redirectPage('connexion');
        }
    } else {
        if( estConnecte()) {
            redirectPage('index');
        }
    }
}

function getMembre() {
    if(estConnecte()) {
        return $_SESSION['membre'];
    } else {
        return NULL;
    }
}

function deconnecterMembre(){
    if( estConnecte() ) {
        unset($_SESSION['membre']);
    }
}

function verifierMotDePasse($motDePasseEnClair, $motDePasseBase){
    return password_verify($motDePasseEnClair, $motDePasseBase);
}
