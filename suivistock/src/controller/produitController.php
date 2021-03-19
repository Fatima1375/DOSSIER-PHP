<?php

    if(isset($_POST['ajout']))
    {
        extract ($_POST);
        require_once '../model/crud/produit/createProd.php';
        header("location:http://localhost/mescours/liagegda/suivistockORM/src/view/produit/indexProduit.php");
    }


   
