<?php
require_once '../commons/init.php' ;
require_once 'models/functions.php' ;

$idSalle = $_GET['id'] ;

deleteSalle($idSalle);

header('Location: salles.php');
