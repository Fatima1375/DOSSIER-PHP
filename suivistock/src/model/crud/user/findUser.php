<?php 
//findUser
require_once '../../bootstrap.php';

//identification de l'utilisateur
$user = $entityManager->find('User', $user);

if ($user === null) {

    echo "LE PRODUIT N'EXISTE PAS !.\n";
    exit(1);

}else{

    return $user;

}