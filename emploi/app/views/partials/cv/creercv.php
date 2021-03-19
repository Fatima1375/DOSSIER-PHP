<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("cv/add");
$can_edit = ACL::is_allowed("cv/edit");
$can_view = ACL::is_allowed("cv/view");
$can_delete = ACL::is_allowed("cv/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="grid" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Liste des demandeurs</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("cv/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        Ajouter un nouveau 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('cv'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Chercher" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('cv'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('cv'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Chercher
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="cv-creercv-records">
                                <?php
                                if(!empty($records)){
                                ?>
                                <div id="page-report-body">
                                    <div class="row sm-gutters page-data" id="page-data-<?php echo $page_element_id; ?>">
                                        <!--record-->
                                        <?php
                                        $counter = 0;
                                        foreach($records as $data){
                                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                        $counter++;
                                        ?>
                                        <div class="col-sm-6">
                                            <div class="bg-light p-2 mb-3 animated bounceIn">
                                                <div class="mb-2">  
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['users_identification']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("users/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="identification" 
                                                        data-title="Entrer Identification" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <span class="font-weight-light text-muted ">
                                                            Demandeur:  
                                                        </span>
                                                        <?php echo $data['users_identification']; ?> 
                                                    </span>
                                                </div>
                                                <div class="mb-2">  <?php Html :: page_img($data['users_photo'],50,50,1); ?></div>
                                                <div class="mb-2">  
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['age']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("cv/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="age" 
                                                        data-title="Entrer Age" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="number" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <span class="font-weight-light text-muted ">
                                                            Age:  
                                                        </span>
                                                        <?php echo $data['age']; ?> 
                                                    </span>
                                                </div>
                                                <div class="mb-2">  
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['niveau_etudes_niveau_etudes']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("niveau_etudes/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="niveau_etudes" 
                                                        data-title="Entrer Niveau Etudes" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <span class="font-weight-light text-muted ">
                                                            Niveau Etudes :  
                                                        </span>
                                                        <?php echo $data['niveau_etudes_niveau_etudes']; ?> 
                                                    </span>
                                                </div>
                                                <div class="mb-2">  
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['specialite_specialite']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("specialite/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="specialite" 
                                                        data-title="Entrer Specialite" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <span class="font-weight-light text-muted ">
                                                            Specialite :  
                                                        </span>
                                                        <?php echo $data['specialite_specialite']; ?> 
                                                    </span>
                                                </div>
                                                <div><?php echo $data['adresse']; ?></div>
                                                <div class="mb-2">  
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['exprience_professionnelle']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("cv/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="exprience_professionnelle" 
                                                        data-title="Entrer Exprience Professionnelle" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <span class="font-weight-light text-muted ">
                                                            Exprience Professionnelle:  
                                                        </span>
                                                        <?php echo $data['exprience_professionnelle']; ?> 
                                                    </span>
                                                </div>
                                                <div class="mb-2">  <a href="<?php print_link("mailto:$data[users_emailuser]") ?>">
                                                    <span class="font-weight-light text-muted ">
                                                        Email :  
                                                    </span>
                                                <?php echo $data['users_emailuser']; ?></a></div>
                                                <div class="mb-2">  
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['users_cellulaire']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("users/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="cellulaire" 
                                                        data-title="Entrer Cellulaire" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <span class="font-weight-light text-muted ">
                                                            Cellulaire:  
                                                        </span>
                                                        <?php echo $data['users_cellulaire']; ?> 
                                                    </span>
                                                </div>
                                                <div class="td-btn">
                                                    <?php if($can_view){ ?>
                                                    <a class="btn btn-sm btn-success has-tooltip" title="Voir l'enregistrement" href="<?php print_link("cv/view/$rec_id"); ?>">
                                                        <i class="fa fa-eye"></i> Vue
                                                    </a>
                                                    <?php } ?>
                                                    <?php if($can_edit){ ?>
                                                    <a class="btn btn-sm btn-info has-tooltip" title="Modifier cet enregistrement" href="<?php print_link("cv/edit/$rec_id"); ?>">
                                                        <i class="fa fa-edit"></i> Modifier
                                                    </a>
                                                    <?php } ?>
                                                    <?php if($can_delete){ ?>
                                                    <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Supprimer cet enregistrement" href="<?php print_link("cv/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Êtes-vous sûr de vouloir supprimer cet enregistrement?" data-display-style="modal">
                                                        <i class="fa fa-times"></i>
                                                        Effacer
                                                    </a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                        }
                                        ?>
                                        <!--endrecord-->
                                    </div>
                                    <div class="row sm-gutters search-data" id="search-data-<?php echo $page_element_id; ?>"></div>
                                    <div>
                                    </div>
                                </div>
                                <?php
                                if($show_footer == true){
                                ?>
                                <div class=" border-top mt-2">
                                    <div class="row justify-content-center">    
                                        <div class="col-md-auto">   
                                        </div>
                                        <div class="col">   
                                            <?php
                                            if($show_pagination == true){
                                            $pager = new Pagination($total_records, $record_count);
                                            $pager->route = $this->route;
                                            $pager->show_page_count = true;
                                            $pager->show_record_count = true;
                                            $pager->show_page_limit =true;
                                            $pager->limit_count = $this->limit_count;
                                            $pager->show_page_number_list = true;
                                            $pager->pager_link_range=5;
                                            $pager->render();
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                }
                                else{
                                ?>
                                <div class="text-muted  animated bounce p-3">
                                    <h4><i class="fa fa-ban"></i> Aucun Enregistrement Trouvé</h4>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
