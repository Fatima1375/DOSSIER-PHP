<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * users_user_role_id_option_list Model Action
     * @return array
     */
	function users_user_role_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * users_identification_value_exist Model Action
     * @return array
     */
	function users_identification_value_exist($val){
		$db = $this->GetModel();
		$db->where("identification", $val);
		$exist = $db->has("users");
		return $exist;
	}

	/**
     * users_emailuser_value_exist Model Action
     * @return array
     */
	function users_emailuser_value_exist($val){
		$db = $this->GetModel();
		$db->where("emailuser", $val);
		$exist = $db->has("users");
		return $exist;
	}

	/**
     * cv_specialite_option_list Model Action
     * @return array
     */
	function cv_specialite_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,specialite AS label FROM specialite ORDER BY specialite";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * cv_niveau_etudes_option_list Model Action
     * @return array
     */
	function cv_niveau_etudes_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,niveau_etudes AS label FROM niveau_etudes ORDER BY id";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * offre_emploi_specialite_option_list Model Action
     * @return array
     */
	function offre_emploi_specialite_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,specialite AS label FROM specialite ORDER BY specialite";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * cv_cvspecialite_option_list Model Action
     * @return array
     */
	function cv_cvspecialite_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,specialite AS label FROM specialite ORDER BY specialite";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * offre_emploi_offre_emploispecialite_option_list Model Action
     * @return array
     */
	function offre_emploi_offre_emploispecialite_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,specialite AS label FROM specialite ORDER BY specialite";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

}
