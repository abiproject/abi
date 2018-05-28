<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adm_model extends CI_Model
{
function __construct(){
	 parent::__construct();
 }		
	 
function pobierz_zdarzenia_json(){
 		$this->db->from("logi,users,logi_id");
 		$this->db->order_by("data","DESC");
 		$this->db->where("logi.id_user","users.id",false);
 		$this->db->where("logi.id_log","logi_id.id",false);
 		$q = $this->db->get();		
		
 	 	return $this->output
 	   				->set_content_type('application/json')
 	 	        	->set_output(json_encode(array("data" => $q->result())));
 }

function pobierz_zdarzenia($id_user=0,$id_log=0,$od,$ile){
		if($id_log == 0 and $id_user == 0)
		$this->db->from("logi,users,logi_id");
		$this->db->limit($ile,$od);
		$this->db->order_by("data","DESC");
		$this->db->where("logi.id_user","users.id",false);
		$this->db->where("logi.id_log","logi_id.id",false);

		return $this->db->get();		
 }
	 
  	function pobierz_zdarzenia_miesiac($miesiac)
  	 {
    	$this->db->select("DAY(data) as dzien, COUNT(id) as ile");
  		$this->db->where("MONTH(data)",$miesiac);
 		$this->db->group_by("DAY(data)");
 		$q = $this->db->get("logi");
		
  		return $q->result_array();
  	 }
	 	
	function suma_zdarzen()
	 {
		 return $this->db->count_all_results('logi');
	 }
		
 	function pobierz_logowania_json()
 	 {
 		$this->db->order_by("data","DESC");
		$q = $this->db->get("logi_access");		
		
	 	return $this->output
	   				->set_content_type('application/json')
	 	        	->set_output(json_encode(array("data" => $q->result())));
 	 }
	 
	function pobierz_logowania($od,$ile)
	 {
		$this->db->limit($ile,$od);
		$this->db->order_by("data","DESC");

		return $this->db->get("logi_access");		
	 }
	 
 	function pobierz_logowania_miesiac($miesiac)
 	 {
   	$this->db->select("DAY(data) as dzien, COUNT(id) as ile");
 		$this->db->where("MONTH(data)",$miesiac);
		$this->db->group_by("DAY(data)");
		$q = $this->db->get("logi_access");
		
 		return $q->result_array();
 	 }
		
	function suma_logowan()
	 {
		 return $this->db->count_all_results('logi_access');
	 }	
}
?>