<?php
include_once '../../../header.php';
include_once '../../../bootstrap.php'
?>

<div class="row-mt-4">
    <div class="col-md-4 offset-5">
    <a href="../../../accueil.php" class="btn btn-primary btn-sm">ACCUEIL</a>
        <a href="indexProduit.php" class="btn btn-primary btn-sm">LISTE DES PRODUITS</a>
    </div>
</div>
<!-- Material form login -->
<div class="card mt-4 container col-md-8">

    <h5 class="card-header aqua-gradient white-text text-center py-4">
        <strong>NOUVEAU PRODUIT</strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5 pt-0">

        <!-- Form -->
        <form method="post" action="../../controller/produitController.php">
        <div>
                    <div class="row mt-4">
                
                    <div class="col-md-3">
                        <label for="">Reference du produit</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="ref" class="form-control" required>
                    </div>
                </div>
                <br>
                <br>


                <div class="row mt-4">
                    <div class="col-md-3">
                        <label for="">Libelle du produit</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                </div>
                <br>
                <br>

                <div class="row mt-4">
                    <div class="col-md-3">
                        <label for="">Quantite</label>
                    </div>
                    <div class="col-md-6">
                        <input type="number" min="1" name="qte" class="form-control" required>
                    </div>
                </div>
                <br>
                <br>


                <div class="row mt-4">
                    <div class="col-md-3">
                        <label for="">Identifiant Utlisateur</label>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="user" min="1" class="form-control" required>
                    </div>
                </div>
                <br>
                <br>

                <button class="btn btn-primary btn-sm" type="submit" name="ajout">AJOUTER</button>

            </div>
        </form>
        <!-- Form -->

    </div>

</div>
<!-- Material form login -->
<?php
    if (isset($_GET['erreur'])){
        echo '<div class="h2 text-center red-text container col-md-6">Login ou Mot de Passe incorrect !</div>';
    }
?>
<?php
    include_once '../../../footer.php';
?>