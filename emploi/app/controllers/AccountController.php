<?php 
/**
 * Account Page Controller
 * @category  Controller
 */
class AccountController extends SecureController{
	function __construct(){
		parent::__construct(); 
		$this->tablename = "users";
	}
	/**
		* Index Action
		* @return null
		*/
	function index(){
		$db = $this->GetModel();
		$rec_id = $this->rec_id = USER_ID; //get current user id from session
		$db->where ("id", $rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"identification", 
			"login", 
			"emailuser", 
			"cellulaire", 
			"user_role_id");
		$user = $db->getOne($tablename , $fields);
		if(!empty($user)){
			$page_title = $this->view->page_title = "Mon compte";
			$this->render_view("account/view.php", $user);
		}
		else{
			$this->set_page_error();
			$this->render_view("account/view.php");
		}
	}
	/**
     * Update user account record with formdata
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = USER_ID;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","identification","login","photo","cellulaire","user_role_id");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'identification' => 'required',
				'login' => 'required',
				'photo' => 'required',
				'cellulaire' => 'required',
				'user_role_id' => 'required',
			);
			$this->sanitize_array = array(
				'identification' => 'sanitize_string',
				'login' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'cellulaire' => 'sanitize_string',
				'user_role_id' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['identification'])){
				$db->where("identification", $modeldata['identification'])->where("id", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['identification']." Existe déjà!";
				}
			} 
			if($this->validated()){
				$db->where("users.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Enregistrement mis à jour avec succès", "success");
					$db->where ("id", $rec_id);
					$user = $db->getOne($tablename , "*");
					set_session("user_data", $user);// update session with new user data
					return $this->redirect("account");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$this->set_flash_msg("Aucun enregistrement mis à jour", "warning");
						return	$this->redirect("account");
					}
				}
			}
		}
		$db->where("users.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Mon compte";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("account/edit.php", $data);
	}
	/**
     * Change account email
     * @return BaseView
     */
	function change_email($formdata = null){
		if($formdata){
			$email = trim($formdata['emailuser']);
			$db = $this->GetModel();
			$rec_id = $this->rec_id = USER_ID; //get current user id from session
			$tablename = $this->tablename;
			$db->where ("id", $rec_id);
			$result = $db->update($tablename, array('emailuser' => $email ));
			if($result){
				$this->set_flash_msg("Adresse e-mail modifiée avec succès", "success");
				$this->redirect("account");
			}
			else{
				$this->set_page_error("Email non modifié");
			}
		}
		return $this->render_view("account/change_email.php");
	}
}
