<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Enregistrement de l'utilisateur</h4>
                </div>
                <div class="col-sm-6 comp-grid">
                    <div class="">
                        <div class="text-center">
                            Vous avez déjà un compte?  <a class="btn btn-primary" href="<?php print_link('') ?>"> S'identifier</a>
                        </div>
                    </div>
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
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="users-userregister-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("index/register?csrf_token=$csrf_token") ?>" method="post">
                            <!--[main-form-start]-->
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="identification">Identification <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-identification"  value="<?php  echo $this->set_field_value('identification',""); ?>" type="text" placeholder="Entrer Identification"  required="" name="identification"  data-url="api/json/users_identification_value_exist/" data-loading-msg="Vérifier les disponibilités ..." data-available-msg="Disponible" data-unavailable-msg="Indisponible" class="form-control  ctrl-check-duplicate" />
                                                    <div class="check-status"></div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="login">Login <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-login"  value="<?php  echo $this->set_field_value('login',""); ?>" type="text" placeholder="Entrer Login"  required="" name="login"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="password">Password <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input id="ctrl-password"  value="<?php  echo $this->set_field_value('password',""); ?>" type="password" placeholder="Entrer Password"  required="" name="password"  class="form-control  password password-strength" />
                                                            <div class="input-group-append cursor-pointer btn-toggle-password">
                                                                <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="password-strength-msg">
                                                            <small class="font-weight-bold">Devrait contenir</small>
                                                            <small class="length chip">6 caractères minimum</small>
                                                            <small class="caps chip">Lettre capitale</small>
                                                            <small class="number chip">Nombre</small>
                                                            <small class="special chip">symbole</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input id="ctrl-password-confirm" data-match="#ctrl-password"  class="form-control password-confirm " type="password" name="confirm_password" required placeholder="Confirm Password" />
                                                            <div class="input-group-append cursor-pointer btn-toggle-password">
                                                                <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                Password does not match
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="photo">Photo <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <div class="dropzone required" input="#ctrl-photo" fieldname="photo"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Feuilleter" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                                <input name="photo" id="ctrl-photo" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('photo',""); ?>" type="text"  />
                                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Veuillez choisir un fichier</div>-->
                                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="emailuser">Emailuser <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-emailuser"  value="<?php  echo $this->set_field_value('emailuser',""); ?>" type="email" placeholder="Entrer Emailuser"  required="" name="emailuser"  data-url="api/json/users_emailuser_value_exist/" data-loading-msg="Vérifier les disponibilités ..." data-available-msg="Disponible" data-unavailable-msg="Indisponible" class="form-control  ctrl-check-duplicate" />
                                                                    <div class="check-status"></div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="cellulaire">Cellulaire <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <input id="ctrl-cellulaire"  value="<?php  echo $this->set_field_value('cellulaire',""); ?>" type="text" placeholder="Entrer Cellulaire"  required="" name="cellulaire"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="user_role_id">Profil <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <select required=""  id="ctrl-user_role_id" name="user_role_id"  placeholder="Sélectionnez une valeur"    class="custom-select" >
                                                                            <option value="">Sélectionnez une valeur</option>
                                                                            <?php 
                                                                            $user_role_id_options = $comp_model -> users_user_role_id_option_list();
                                                                            if(!empty($user_role_id_options)){
                                                                            foreach($user_role_id_options as $option){
                                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                            $selected = $this->set_field_selected('user_role_id',$value, "");
                                                                            ?>
                                                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                                <?php echo $label; ?>
                                                                            </option>
                                                                            <?php
                                                                            }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--[main-form-end]-->
                                                    <div class="form-group form-submit-btn-holder text-center mt-3">
                                                        <button class="btn btn-primary" type="submit">
                                                            Valider
                                                            <i class="fa fa-send"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        