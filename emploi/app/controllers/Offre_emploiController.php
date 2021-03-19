<?php 
/**
 * Offre_emploi Page Controller
 * @category  Controller
 */
class Offre_emploiController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "offre_emploi";
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
		$fields = array("offre_emploi.id", 
			"offre_emploi.date_publication", 
			"offre_emploi.date_cloture", 
			"specialite.specialite AS specialite_specialite", 
			"users.identification AS users_identification", 
			"users.photo AS users_photo", 
			"users.emailuser AS users_emailuser");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				offre_emploi.id LIKE ? OR 
				offre_emploi.date_publication LIKE ? OR 
				offre_emploi.date_cloture LIKE ? OR 
				offre_emploi.specialite LIKE ? OR 
				offre_emploi.entreprise LIKE ? OR 
				specialite.id LIKE ? OR 
				specialite.specialite LIKE ? OR 
				users.id LIKE ? OR 
				users.identification LIKE ? OR 
				users.login LIKE ? OR 
				users.password LIKE ? OR 
				users.photo LIKE ? OR 
				users.emailuser LIKE ? OR 
				users.cellulaire LIKE ? OR 
				users.user_role_id LIKE ? OR 
				offre_emploi.description LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "offre_emploi/search.php";
		}
		$db->join("specialite", "offre_emploi.specialite = specialite.id", "LEFT");
		$db->join("users", "offre_emploi.entreprise = users.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("offre_emploi.id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->offre_emploi_specialite)){
			$val = $request->offre_emploi_specialite;
			$db->where("offre_emploi.specialite", $val , "=");
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
		$page_title = $this->view->page_title = "Offre Emploi";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("offre_emploi/list.php", $data); //render the full page
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
		$fields = array("offre_emploi.id", 
			"offre_emploi.date_publication", 
			"offre_emploi.date_cloture", 
			"specialite.specialite AS specialite_specialite", 
			"users.emailuser AS users_emailuser", 
			"offre_emploi.description");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("offre_emploi.id", $rec_id);; //select record based on primary key
		}
		$db->join("specialite", "offre_emploi.specialite = specialite.id", "LEFT ");
		$db->join("users", "offre_emploi.entreprise = users.id", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "Vue Offre Emploi";
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
		return $this->render_view("offre_emploi/view.php", $record);
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
			$fields = $this->fields = array("date_publication","date_cloture","specialite","entreprise","description");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'date_publication' => 'required',
				'date_cloture' => 'required',
				'specialite' => 'required',
				'description' => 'required',
			);
			$this->sanitize_array = array(
				'date_publication' => 'sanitize_string',
				'date_cloture' => 'sanitize_string',
				'specialite' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['entreprise'] = USER_ID;
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Enregistrement ajouté avec succès", "success");
					return	$this->redirect("offre_emploi/creeroffres");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Ajouter un nouveau";
		$this->render_view("offre_emploi/add.php");
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
		$fields = $this->fields = array("id","date_publication","date_cloture","specialite","entreprise","description");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'date_publication' => 'required',
				'date_cloture' => 'required',
				'specialite' => 'required',
				'description' => 'required',
			);
			$this->sanitize_array = array(
				'date_publication' => 'sanitize_string',
				'date_cloture' => 'sanitize_string',
				'specialite' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['entreprise'] = USER_ID;
			if($this->validated()){
				$db->where("offre_emploi.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Enregistrement mis à jour avec succès", "success");
					return $this->redirect("offre_emploi");
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
						return	$this->redirect("offre_emploi");
					}
				}
			}
		}
		$db->where("offre_emploi.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "modifier";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("offre_emploi/edit.php", $data);
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
		$fields = $this->fields = array("id","date_publication","date_cloture","specialite","entreprise","description");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'date_publication' => 'required',
				'date_cloture' => 'required',
				'specialite' => 'required',
				'description' => 'required',
			);
			$this->sanitize_array = array(
				'date_publication' => 'sanitize_string',
				'date_cloture' => 'sanitize_string',
				'specialite' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("offre_emploi.id", $rec_id);;
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
		$db->where("offre_emploi.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Enregistrement supprimé avec succès", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("offre_emploi");
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function creeroffres($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("offre_emploi.id", 
			"offre_emploi.date_publication", 
			"offre_emploi.date_cloture", 
			"offre_emploi.entreprise", 
			"specialite.specialite AS specialite_specialite", 
			"users.identification AS users_identification", 
			"users.photo AS users_photo", 
			"users.emailuser AS users_emailuser");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				offre_emploi.id LIKE ? OR 
				offre_emploi.date_publication LIKE ? OR 
				offre_emploi.date_cloture LIKE ? OR 
				offre_emploi.specialite LIKE ? OR 
				offre_emploi.entreprise LIKE ? OR 
				specialite.id LIKE ? OR 
				specialite.specialite LIKE ? OR 
				users.id LIKE ? OR 
				users.identification LIKE ? OR 
				users.login LIKE ? OR 
				users.password LIKE ? OR 
				users.photo LIKE ? OR 
				users.emailuser LIKE ? OR 
				users.cellulaire LIKE ? OR 
				users.user_role_id LIKE ? OR 
				offre_emploi.description LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "offre_emploi/search.php";
		}
		$db->join("specialite", "offre_emploi.specialite = specialite.id", "LEFT");
		$db->join("users", "offre_emploi.entreprise = users.id", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("offre_emploi.id", ORDER_TYPE);
		}
		$db->where("offre_emploi.entreprise", get_active_user('id') );
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->offre_emploi_specialite)){
			$val = $request->offre_emploi_specialite;
			$db->where("offre_emploi.specialite", $val , "=");
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
		$page_title = $this->view->page_title = "Offre Emploi";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("offre_emploi/creeroffres.php", $data); //render the full page
	}
}
