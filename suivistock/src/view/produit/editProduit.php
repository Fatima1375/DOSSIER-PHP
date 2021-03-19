<?php
include_once '../../../header.php';
require_once '../../model/produitBD.php';

$produitAModifier=findProduitById($_GET['id']);
    //var_dump $produitAModifier ;
?>

<div class="container mt-5">

    <div class="form-group">
        <div class="card">
            <div class="card-header blue lighten-4 text-center text-uppercase h4 font-weight-bold">
                MODIFICATION PRODUIT
            </div>
            <br>
            <div class="form-horizontal">
                <form action="../../controller/produitController.php" method="post">
                <input type="hidden" name="idProduit" value="<?= $produitAModifier['idProduit']?>">
                    <div class="row mt-4">
                        

                        
                        <div class="col-md-2 text-center">
                            <label for="nom" class="h5">Code Produit</label>
                        </div>
                        <div class="col-md-4">
                        
                            <input type="text" class="form-control" name="codeProduit" value="<?= $produitAModifier['codeProduit']?>" >
                        </div>
                        <br>

                     



                        <div class="col-md-2 text-center">
                            <label for="prenom" class="h5">Libelle</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="libelle" value="<?= $produitAModifier['libelle']?>">
                        </div>

                    </div>

                    <div class="row mt-4">
                        <div class="col-md-2 text-center">
                            <label for="tel" class="h5">Prix</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="prix" value="<?= $produitAModifier['prix']?>">
                        </div>
                        <br>
                        <div class="col-md-2 text-center">
                            <label for="adresse" class="h5">Quantite</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="quantite" value="<?= $produitAModifier['quantite']?>">
                        </div>

                    </div>

                    
                    <div class="row">
                        <div class="col-md-4 offset-5 mt-4">
                            <button type="submit" name="btnModifier" class="btn btn-primary btn-sm" >Valider</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>

    </div>

</div>
<?php
    include_once '../../../footer.php';
?>