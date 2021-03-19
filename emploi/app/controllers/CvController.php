<?php 
/**
 * Cv Page Controller
 * @category  Controller
 */
class CvController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "cv";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("cv.id", 
			"users.identification AS users_identification", 
			"users.photo AS users_photo", 
			"cv.age", 
			"niveau_etudes.niveau_etudes AS niveau_etudes_niveau_etudes", 
			"specialite.specialite AS specialite_specialite", 
			"cv.adresse", 
			"cv.exprience_professionnelle", 
			"users.emailuser AS users_emailuser", 
			"users.cellulaire AS users_cellulaire");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				cv.id LIKE ? OR 
				users.identification LIKE ? OR 
				cv.iduser LIKE ? OR 
				users.photo LIKE ? OR 
				cv.age LIKE ? OR 
				niveau_etudes.niveau_etudes LIKE ? OR 
				specialite.specialite LIKE ? OR 
				cv.adresse LIKE ? OR 
				cv.specialite LIKE ? OR 
				cv.niveau_etudes LIKE ? OR 
				cv.exprience_professionnelle LIKE ? OR 
				specialite.id LIKE ? OR 
				users.id LIKE ? OR 
				users.login LIKE ? OR 
				users.password LIKE ? OR 
				users.emailuser LIKE ? OR 
				users.cellulaire LIKE ? OR 
				users.user_role_id LIKE ? OR 
				niveau_etudes.id LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "cv/search.php";
		}
		$db->join("specialite", "cv.specialite = specialite.id", "LEFT");
		$db->join("users", "cv.iduser = users.id", "INNER");
		$db->join("niveau_etudes", "cv.niveau_etudes = niveau_etudes.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("cv.id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->cv_specialite)){
			$val = $request->cv_specialite;
			$db->where("cv.specialite", $val , "=");
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Cv";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("cv/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("cv.id", 
			"cv.iduser", 
			"cv.age", 
			"cv.adresse", 
			"cv.specialite", 
			"cv.niveau_etudes", 
			"cv.exprience_professionnelle", 
			"specialite.id AS specialite_id", 
			"specialite.specialite AS specialite_specialite", 
			"users.id AS users_id", 
			"users.identification AS users_identification", 
			"users.login AS users_login", 
			"users.password AS users_password", 
			"users.photo AS users_photo", 
			"users.emailuser AS users_emailuser", 
			"users.cellulaire AS users_cellulaire", 
			"users.user_role_id AS users_user_role_id", 
			"niveau_etudes.id AS niveau_etudes_id", 
			"niveau_etudes.niveau_etudes AS niveau_etudes_niveau_etudes");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("cv.id", $rec_id);; //select record based on primary key
		}
		$db->join("specialite", "cv.specialite = specialite.id", "LEFT ");
		$db->join("users", "cv.iduser = users.id", "INNER ");
		$db->join("niveau_etudes", "cv.niveau_etudes = niveau_etudes.id", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "Vue Cv";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("Enregistrement non trouvé");
			}
		}
		return $this->render_view("cv/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("iduser","age","adresse","specialite","niveau_etudes","exprience_professionnelle");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'age' => 'required|numeric',
				'adresse' => 'required',
				'specialite' => 'required',
				'niveau_etudes' => 'required',
				'exprience_professionnelle' => 'required',
			);
			$this->sanitize_array = array(
				'age' => 'sanitize_string',
				'specialite' => 'sanitize_string',
				'niveau_etudes' => 'sanitize_string',
				'exprience_professionnelle' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['iduser'] = USER_ID;
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Enregistrement ajouté avec succès", "success");
					return	$this->redirect("cv/creercv");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Ajouter un nouveau";
		$this->render_view("cv/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","iduser","age","adresse","specialite","niveau_etudes","exprience_professionnelle");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'age' => 'required|numeric',
				'adresse' => 'required',
				'specialite' => 'required',
				'niveau_etudes' => 'required',
				'exprience_professionnelle' => 'required',
			);
			$this->sanitize_array = array(
				'age' => 'sanitize_string',
				'specialite' => 'sanitize_string',
				'niveau_etudes' => 'sanitize_string',
				'exprience_professionnelle' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['iduser'] = USER_ID;
			if($this->validated()){
				$db->where("cv.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Enregistrement mis à jour avec succès", "success");
					return $this->redirect("cv");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "Aucun enregistrement mis à jour";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("cv");
					}
				}
			}
		}
		$db->where("cv.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "modifier";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("cv/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id","iduser","age","adresse","specialite","niveau_etudes","exprience_professionnelle");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'age' => 'required|numeric',
				'adresse' => 'required',
				'specialite' => 'required',
				'niveau_etudes' => 'required',
				'exprience_professionnelle' => 'required',
			);
			$this->sanitize_array = array(
				'age' => 'sanitize_string',
				'specialite' => 'sanitize_string',
				'niveau_etudes' => 'sanitize_string',
				'exprience_professionnelle' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("cv.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "Aucun enregistrement mis à jour";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("cv.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Enregistrement supprimé avec succès", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("cv");
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function creercv($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("cv.id", 
			"users.identification AS users_identification", 
			"cv.iduser", 
			"users.photo AS users_photo", 
			"cv.age", 
			"niveau_etudes.niveau_etudes AS niveau_etudes_niveau_etudes", 
			"specialite.specialite AS specialite_specialite", 
			"cv.adresse", 
			"cv.exprience_professionnelle", 
			"users.emailuser AS users_emailuser", 
			"users.cellulaire AS users_cellulaire");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				cv.id LIKE ? OR 
				users.identification LIKE ? OR 
				cv.iduser LIKE ? OR 
				users.photo LIKE ? OR 
				cv.age LIKE ? OR 
				niveau_etudes.niveau_etudes LIKE ? OR 
				specialite.specialite LIKE ? OR 
				cv.adresse LIKE ? OR 
				cv.specialite LIKE ? OR 
				cv.niveau_etudes LIKE ? OR 
				cv.exprience_professionnelle LIKE ? OR 
				specialite.id LIKE ? OR 
				users.id LIKE ? OR 
				users.login LIKE ? OR 
				users.password LIKE ? OR 
				users.emailuser LIKE ? OR 
				users.cellulaire LIKE ? OR 
				users.user_role_id LIKE ? OR 
				niveau_etudes.id LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "cv/search.php";
		}
		$db->join("specialite", "cv.specialite = specialite.id", "LEFT");
		$db->join("users", "cv.iduser = users.id", "INNER");
		$db->join("niveau_etudes", "cv.niveau_etudes = niveau_etudes.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("cv.id", ORDER_TYPE);
		}
		$db->where("cv.iduser", get_active_user('id') );
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Cv";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("cv/creercv.php", $data); //render the full page
	}
}
