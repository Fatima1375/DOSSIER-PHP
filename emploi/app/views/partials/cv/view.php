<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("cv/add");
$can_edit = ACL::is_allowed("cv/edit");
$can_view = ACL::is_allowed("cv/view");
$can_delete = ACL::is_allowed("cv/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Vue Cv</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id">
                                        <th class="title"> Id: </th>
                                        <td class="value"> <?php echo $data['id']; ?></td>
                                    </tr>
                                    <tr  class="td-iduser">
                                        <th class="title"> Iduser: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['iduser']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("cv/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="iduser" 
                                                data-title="Entrer Iduser" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['iduser']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-age">
                                        <th class="title"> Age: </th>
                                        <td class="value">
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
                                                <?php echo $data['age']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <div><?php echo $data['adresse']; ?></div>
                                    <tr  class="td-specialite">
                                        <th class="title"> Specialite: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/cv_specialite_option_list'); ?>' 
                                                data-value="<?php echo $data['specialite']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("cv/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="specialite" 
                                                data-title="Sélectionnez une valeur" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['specialite']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-niveau_etudes">
                                        <th class="title"> Niveau Etudes: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/cv_niveau_etudes_option_list'); ?>' 
                                                data-value="<?php echo $data['niveau_etudes']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("cv/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="niveau_etudes" 
                                                data-title="Sélectionnez une valeur" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['niveau_etudes']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-exprience_professionnelle">
                                        <th class="title"> Exprience Professionnelle: </th>
                                        <td class="value">
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
                                                <?php echo $data['exprience_professionnelle']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-specialite_id">
                                        <th class="title"> Specialite Id: </th>
                                        <td class="value"> <?php echo $data['specialite_id']; ?></td>
                                    </tr>
                                    <tr  class="td-specialite_specialite">
                                        <th class="title"> Specialite Specialite: </th>
                                        <td class="value"> <?php echo $data['specialite_specialite']; ?></td>
                                    </tr>
                                    <tr  class="td-users_id">
                                        <th class="title"> Users Id: </th>
                                        <td class="value"> <?php echo $data['users_id']; ?></td>
                                    </tr>
                                    <tr  class="td-users_identification">
                                        <th class="title"> Users Identification: </th>
                                        <td class="value"> <?php echo $data['users_identification']; ?></td>
                                    </tr>
                                    <tr  class="td-users_login">
                                        <th class="title"> Users Login: </th>
                                        <td class="value"> <?php echo $data['users_login']; ?></td>
                                    </tr>
                                    <tr  class="td-users_password">
                                        <th class="title"> Users Password: </th>
                                        <td class="value"> <?php echo $data['users_password']; ?></td>
                                    </tr>
                                    <tr  class="td-users_photo">
                                        <th class="title"> Users Photo: </th>
                                        <td class="value"><?php Html :: page_img($data['users_photo'],400,400,1); ?></td>
                                    </tr>
                                    <tr  class="td-users_emailuser">
                                        <th class="title"> Users Emailuser: </th>
                                        <td class="value"> <?php echo $data['users_emailuser']; ?></td>
                                    </tr>
                                    <tr  class="td-users_cellulaire">
                                        <th class="title"> Users Cellulaire: </th>
                                        <td class="value"> <?php echo $data['users_cellulaire']; ?></td>
                                    </tr>
                                    <tr  class="td-users_user_role_id">
                                        <th class="title"> Users User Role Id: </th>
                                        <td class="value"> <?php echo $data['users_user_role_id']; ?></td>
                                    </tr>
                                    <tr  class="td-niveau_etudes_id">
                                        <th class="title"> Niveau Etudes Id: </th>
                                        <td class="value"> <?php echo $data['niveau_etudes_id']; ?></td>
                                    </tr>
                                    <tr  class="td-niveau_etudes_niveau_etudes">
                                        <th class="title"> Niveau Etudes Niveau Etudes: </th>
                                        <td class="value"> <?php echo $data['niveau_etudes_niveau_etudes']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Exportation
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                        </a>
                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                            </a>
                                            <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                            <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                </a>
                                                <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                    <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                    </a>
                                                    <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                        <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("cv/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Modifier
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("cv/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Êtes-vous sûr de vouloir supprimer cet enregistrement?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Effacer
                                                </a>
                                                <?php } ?>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="fa fa-ban"></i> Aucun Enregistrement Trouvé
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
