<?php
require_once '../commons/init.php' ;
require_once 'models/functions_produit.php' ;

$idProduit = $_GET['id'] ;

deleteProduit($idProduit);

header('Location: produits.php');
