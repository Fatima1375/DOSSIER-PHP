<?php
include_once 'header.php';
include "config.php";

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: index.php');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: index.php');
}

?>
  <!-- container section start -->
  <section id="container" class="">
    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="" class="logo">Suivi <span class="lite">Stock</span></a>
      <!--logo end-->
      
      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>
            <form class="navbar-form">
              <input class="form-control" placeholder="Search" type="text">
            </form>
          </li>
        </ul>
        <!--  search form end -->
      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">

          <!-- task notificatoin start -->
        
          <!-- task notificatoin end -->
          
          
          <!-- user login dropdown start-->
          <li>
          <form method='post' action="">
            <input type="submit" class="btn btn-primary btn-sm" value="Logout"  name="but_logout">
        </form>
        </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="accueil.php">
                          <i class="icon_house_alt"></i>
                          <span>MENU</span>
                      </a>
          </li>
          
          <li class="sub-menu">
            <a href="src/view/user/addUser.php" class="">
                          <i class="icon_desktop"></i>
                          <span>UTILISATEURS</span>
                          
                      </a>
          </li>
          <li>
            <a class="" href="src/view/produit/addProduit.php">
                          <i class="icon_desktop"></i>
                          <span>PRODUIT</span>
                      </a>
          </li>
         

          
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> GESTION DE STOCK</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="">ACCUEIL</a></li>
              <li><i class="fa fa-laptop"></i>Dashboard</li>
            </ol>
          </div>
        </div>

        




        <!-- statics end -->

                      <div class="form-group">
                        <!-- Buttons -->
                        <div class="col-lg-offset-2 col-lg-9">
                        <a href="src/view/produit/addProduit.php" >  <button type="submit" class="btn btn-primary">Rubrique Produit</button></a>
                         <a href="src/view/user/addUser.php" > <button type="submit" class="btn btn-danger">Rubrique Utilisateur</button></a>
                          <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                      </div>
                   

        <!-- project team & activity end -->

<?php
    include_once 'footer.php';
?>

