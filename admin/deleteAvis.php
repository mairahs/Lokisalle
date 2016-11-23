<?php
require_once '../commons/init.php' ;
require_once 'models/functions_avis.php' ;

$idAvis = $_GET['id'] ;

deleteAvis($idAvis);

header('Location: avis.php');
