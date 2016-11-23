<?php

function getPage() {
    // je récupère l'uri courante à partir de $_SERVER
    // (variable superglobale)
    $uri = $_SERVER['REQUEST_URI'];

    // $uri contient  "/tchat/index.php"

    // j'extrais des informations sur l'uri dans un tableau associatif
    $infos = pathinfo($uri);

    // je récupère uniquement ce dont j'ai besoin dans ce tableau,
    // à savoir 'filename' qui va me donner le nom de la page
    $page = $infos['filename'];

    // je retourne enfin le nom de la page obtenue
    return $page;
}
/**
 * Cette fonction redirige l'utilisateur vers la page demandée
 * @param string $page le nom de la page
 */
function redirectPage($page) {
    header('location: '.$page.'.php');
}
