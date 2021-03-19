<?php
include_once '../../../header.php';
require_once '../../model/crud/user/userListe.php';
//require_once '../../model/produitBD.php';
//$produits = getProduits();

?>
<div class="row-mt-4">
    
    <div class="col-md-4 offset-5">
    
        <a href="../../view/user/addUser.php" class="btn btn-primary btn-sm">RETOUR</a>
    </div>
</div>
<div class="card mt-4 container col-md-8">


    <h5 class="card-header aqua-gradient white-text text-center py-4">
        <strong>LISTE DES UTILISATEURS</strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5 pt-0">
        <table class="table table-dark">
            <tr>
                <th class="h4 text-center">#</th>
                <th class="h4 text-center">NOM</th>
                <th class="h4 text-center">PRENOM</th>
                <th class="h4 text-center">EMAIL</th>
                <th class="h4 text-center">PASSWORD</th>
                <th class="h4 text-center">ETAT</th>
                <th>Actions</th>
                
            </tr>
            <?php
            foreach ($users as $u)
            {
                ?>
                <tr>
                    <td><?= $u->getId() ?></td>
                    <td><?= $u->getNom()  ?></td>
                    <td><?= $u->getPrenom()  ?></td>
                    <td><?= $u->getEmail() ?></td>
                    <td><?= $u->getPassword() ?></td>
                    <td><?= $u->getEtat()  ?></td>
                    
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