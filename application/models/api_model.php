<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api_model extends Ci_Model
{
function __construct()
    {
        parent::__construct();
    }		
	 
function pobierz_zaklad($api_key){
	$this->db->from("zaklady");
	$this->db->where("zaklady.api_key",$api_key);
	$q = $this->db->get();
	
	return $q->row();
 }
	 
function pobierz_zbiory_z_zakladu($api_key)
 	{
		$this->db->from("zaklady,zbiory_dane,slowniki_zbiory,zbiory_zab");
 		$this->db->where("zaklady.api_key",$api_key);
		$this->db->where("slowniki_zbiory.id_zaklad","zaklady.id",false);
		$this->db->where("slowniki_zbiory.flaga",1);
		$this->db->where("zbiory_dane.id_zbior","slowniki_zbiory.id",false);
		$this->db->where("zbiory_zab.id_zbior","slowniki_zbiory.id",false);
		
		return $this->db->get();	
 	}

function pobierz_rejestr_umow_z_zakladu($api_key){
		$this->db->from("zaklady,rejestr_u");
 		$this->db->where("zaklady.api_key",$api_key);
		$this->db->where("rejestr_u.id_zaklad","zaklady.id",false);
		$this->db->where("rejestr_u.flaga",1,false);
		
		return $this->db->get();	
	}
	
function pobierz_zbiory_details($api_key){
	$this->db->from("zaklady,slowniki_zbiory");
	$this->db->where("zaklady.api_key",$api_key);
	$this->db->where("slowniki_zbiory.id_zaklad","zaklady.id",false);
	$this->db->where("slowniki_zbiory.flaga",1);
	
	return $this->db->get();	
		
}

function pobierz_umowy($api_key){
	$this->db->from("rejestr_u, zaklady, rejestr_u_zbiory, slowniki_zbiory");
	$this->db->where("zaklady.api_key",$api_key);
	$this->db->where("rejestr_u.id_zaklad","zaklady.id",false);
	$this->db->where("rejestr_u.id","rejestr_u_zbiory.id_umowa",false);
	$this->db->where("rejestr_u_zbiory.id_zbior","slowniki_zbiory.id",false);
	$this->db->where("rejestr_u.flaga",1,false);
	
	return $this->db->get();
}
function pobierz_podstawe_prze($api_key){
	$this->db->select("nazwa,podstawa_prze");
	$this->db->from("zaklady,slowniki_zbiory,zbiory_zab");
	$this->db->where("zaklady.api_key",$api_key);
	$this->db->where("slowniki_zbiory.id_zaklad","zaklady.id",false);
	$this->db->where("zbiory_zab.id_zaklad","zaklady.id",false);
	$this->db->where("slowniki_zbiory.id","zbiory_zab.id_zbior",false);
		
	return $this->db->get();	
		
}
function pobierz_zakres_przetwarzania($api_key){
	$this->db->from("zaklady,slowniki_zbiory,rejestr_u_zbiory_zaw");
	$this->db->where("zaklady.api_key",$api_key);
	$this->db->where("rejestr_u_zbiory_zaw.id_zbior","slowniki_zbiory.id",false);
	$this->db->where("slowniki_zbiory.id_zaklad","zaklady.id",false);
	$this->db->where("slowniki_zbiory.flaga",1);
	
		return $this->db->get();
}
function pobierz_rejestr_u_zbiory($api_key)
			{
				$this->db->select("nazwa_zakladu,nazwa,dana");
				$this->db->from("zaklady,zbiory_dane,slowniki_zbiory");
		 		$this->db->where("zaklady.api_key",$api_key);
				$this->db->where("slowniki_zbiory.id_zaklad","zaklady.id",false);
				$this->db->where("zbiory_dane.id_zbior","slowniki_zbiory.id",false);
				$this->db->where("slowniki_zbiory.flaga",1);
						
				return $this->db->get();	
			}	


//function pobierz_rejestr_u_zbiory($api_key)
// 		{
// 			$this->db->select("nazwa_zakladu,rejestr_u.id as uid,nazwa,dana");
// 			$this->db->from("rejestr_u,zaklady,rejestr_u_zbiory,rejestr_u_zbiory_zaw,zbiory_dane,slowniki_zbiory");
// 	 		$this->db->where("zaklady.api_key",$api_key);
// 			$this->db->where("rejestr_u.id_zaklad","zaklady.id",false);
// 			$this->db->where("rejestr_u.id","rejestr_u_zbiory.id_umowa",false);
// 			$this->db->where("rejestr_u_zbiory_zaw.id_umowa","rejestr_u_zbiory.id_umowa",false);
// 			$this->db->where("zbiory_dane.id_zbior","rejestr_u_zbiory_zaw.id_zbior",false);
// 			$this->db->where("zbiory_dane.id_zbior","rejestr_u_zbiory.id_zbior",false);
// 			$this->db->where("zbiory_dane.id_zbior","slowniki_zbiory.id",false);
// 			$this->db->where("rejestr_u_zbiory_zaw.id_pole","zbiory_dane.id",false);
//
// 			return $this->db->get();
// 		}
		
function zapisz_dostep($api,$stan)
{
	$this->load->library('user_agent');
	$wpis = array(
		"id" => NULL,
		"data" => date("Y-m-d H:i:s"),
		"api" => $api,
		"ip" => $this->input->ip_address(),
		"referrer" =>  $this->agent->referrer(),
		"user_agent" => $this->agent->agent_string(),
		"stan" => $stan
	);

	$this->db->insert("logi_api",$wpis);
}
}
?>