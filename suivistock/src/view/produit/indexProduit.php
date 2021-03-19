<?php
include_once '../../../header.php';
require_once '../../model/crud/produit/produitListe.php';


?>
<div class="row-mt-4">
    
    <div class="col-md-4 offset-5">
    
        <a href="../../view/produit/addProduit.php" class="btn btn-primary btn-sm">RETOUR</a>
    </div>
</div>
<div class="card mt-4 container col-md-8">


    <h5 class="card-header aqua-gradient white-text text-center py-4">
        <strong>LISTE DES PRODUITS</strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5 pt-0">
        <table class="table table-dark">
            <tr>
                <th class="h4 text-center">REFERENCE</th>
                <th class="h4 text-center">NOM COMPLET UTILISATEUR</th>
                <th class="h4 text-center">NOM</th>
                <th class="h4 text-center">STOCK</th>
                <th>Actions</th>
                
            </tr>
            <?php
            foreach ($produits as $produit)
            {
                ?>
                <tr>
                    <td><?= $produit->getRef() ?></td>
                    <td><?= $produit->getId()->getPrenom()." ".$produit->getId()->getNom() ?></td>
                    <td><?= $produit->getNom() ?></td>
                    <td><?= $produit->getQtStock()?></td>
                    <td>
                    <a href="" class="btn btn-orange btn-sm">Modifier</a>
                    <a href=""  class="btn red btn-sm">Supprimer</a>
                    </td>
                    
                </tr>
         <?php }
            ?>
        </table>
    </div>
</div>
<?php
    include_once '../../../footer.php';
?>