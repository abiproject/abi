<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pracownicy_model extends Ci_Model
{
function __construct()
 {
	 parent::__construct();
 }	

function spis_pracownikow($id_zaklad=0)
 {
	$this->db->select("pracownicy.id as pid, nazwiskoimie, plec, nazwa_zakladu, aktualny");
	$this->db->from("pracownicy,zaklady");
	$this->db->where("pracownicy.id_zakladu","zaklady.id",false);
	if($id_zaklad != 0)
		$this->db->where("pracownicy.id_zakladu",$id_zaklad);
	$this->db->order_by("nazwiskoimie","ASC");
	
	return $this->db->get();	
 }
 
 
 function spis_pracownikow_bez_upo($id_zaklad=0){
 	$this->db->from("pracownicy,zaklady");
 	$this->db->where("pracownicy.id_zakladu","zaklady.id",false);
	$this->db->join('upowaznienia', 'upowaznienia.id_prac = pracownicy.id', 'left');
	$this->db->where("nr", NULL);
 	if($id_zaklad != 0)
  		$this->db->where("pracownicy.id_zakladu",$id_zaklad);
	
  	$q=$this->db->get();

	return $q->result_array();
 }
 
 function spis_pracownikow_json($id_zaklad=0){
 	$this->db->select("pracownicy.id as pid, nazwiskoimie, plec, nazwa_zakladu, aktualny");
	$this->db->from("pracownicy,zaklady");
	$this->db->where("pracownicy.id_zakladu","zaklady.id",false);
	if($id_zaklad != 0)
 		$this->db->where("pracownicy.id_zakladu",$id_zaklad);
	$this->db->order_by("nazwiskoimie","ASC");
	
 	$q=$this->db->get();
	
 	return $this->output
   				->set_content_type('application/json')
 	        	->set_output(json_encode(array("data" => $q->result())));
 }	
 

function suma_pracownikow($id_zaklad=0,$szukaj=NULL)
 {
	if($id_zaklad > 0)
		$this->db->where("id_zakladu",$id_zaklad);
	if($szukaj !== NULL)
		$this->db->like("nazwiskoimie",$szukaj);
	
	return $this->db->count_all_results('pracownicy');
 }
  
function pobierz_pracownik_id($id)
 {
	$this->db->where("id",$id);			
	
	return $this->db->get("pracownicy");	
 }
function pobierz_pracownikow($id_zaklad=0,$aktywni=0)
 {
	if($id_zaklad > 0)
		$this->db->where("id_zakladu",$id_zaklad);
	if($aktywni == 1)
		$this->db->where("aktualny",1);
	$this->db->order_by("nazwiskoimie","asc");			

	return $this->db->get("pracownicy");	
 }
 
function pobierz_tab_pracownika($id_prac)
 {
   $this->db->from("pracownicy, zaklady");
 	$this->db->where("pracownicy.id",$id_prac);
	$this->db->where("pracownicy.id_zakladu = zaklady.id");
	$q = $this->db->get();
	$row = $q->row();
	
	@$tab["nazwa"]  = $row->nazwiskoimie;
	@$tab["zaklad"] = $row->nazwa_zakladu;
	return $tab;
 }
 
function dodaj_pracownika($nazwisko,$plec,$id_zaklad)
 {
	$wpis = array( 
		'id' 				=> NULL,
	 	'id_zakladu' 	=> $id_zaklad,
		'nazwiskoimie' => $nazwisko,
		'plec' 			=> $plec
	);
	$this->db->insert("pracownicy",$wpis);
	$id = $this->db->insert_id();
	
	$tab = $this->Pracownicy_model->pobierz_tab_pracownika($id);
	zapisz_log($this->session->userdata("id"),26,"".$nazwisko." / ".$tab["zaklad"]."",$wpis);
	
	$this->db->cache_delete('pracownicy','edytuj');
	$this->db->cache_delete('pracownicy','json');
	$this->db->cache_delete('pracownicy','index');
	$this->db->cache_delete('admin','upo_nowe');
	$this->db->cache_delete('admin','upo');
	$this->db->cache_delete('admin','upo_edytuj');
	$this->db->cache_delete('export','pdf');
	$this->db->cache_delete('rejestry','upowaznienia');
 }

function usun_pracownika($id)
	{
		$this->db->where("id_prac",$id);
		$q=$this->db->get("upowaznienia");
		if($q->num_rows() == 0)
		{
			$tab = $this->pobierz_tab_pracownika($id);
			$this->db->where("id",$id);
			$this->db->delete("pracownicy");
			$this->db->cache_delete('pracownicy','index');
			zapisz_log($this->session->userdata("id"),27,"".$tab["nazwa"]." / ".$tab["zaklad"]."");
			$this->db->cache_delete('pracownicy','edytuj');
			$this->db->cache_delete('pracownicy','json');
			$this->db->cache_delete('pracownicy','index');
			$this->db->cache_delete('admin','upo_nowe');
			$this->db->cache_delete('admin','upo');
			$this->db->cache_delete('admin','upo_edytuj');
			$this->db->cache_delete('export','pdf');
			$this->db->cache_delete('rejestry','upowaznienia');
		}
		else
			return "error";
	}
function zapisz_pracownika($id_prac,$nazwisko,$plec,$id_zaklad)
	{
		$wpis = array( 'id_zakladu' => $id_zaklad,
							'nazwiskoimie' => $nazwisko,
							'plec' => $plec);
		$this->db->where("id",$id_prac);
		$this->db->update("pracownicy",$wpis);
			
		$tab = $this->pobierz_tab_pracownika($id_prac);
		
		$this->db->cache_delete('pracownicy','json');
		$this->db->cache_delete('pracownicy','edytuj');
		$this->db->cache_delete('pracownicy','index');
		$this->db->cache_delete('admin','upo_nowe');
		$this->db->cache_delete('admin','upo');
		$this->db->cache_delete('admin','upo_edytuj');
		$this->db->cache_delete('export','pdf');
		$this->db->cache_delete('rejestry','upowaznienia');
		
		zapisz_log($this->session->userdata("id"),28,"".$tab["nazwa"]." / ".$tab["zaklad"]."",$wpis);
		
	}
function dez_prac($id)
	{
		$wpis = array( 'aktualny' => 0);
		$this->db->where('id', $id);
		$this->db->update("pracownicy",$wpis);
		$tab = $this->pobierz_tab_pracownika($id);
		
		$this->db->cache_delete('pracownicy','index');
		$this->db->cache_delete('pracownicy','json');
		$this->db->cache_delete('admin','upo_nowe');
		$this->db->cache_delete('admin','upo_edytuj');
		
		zapisz_log($this->session->userdata("id"),29,"".$tab["nazwa"]."");
	}
function akt_prac($id)
	{
		$wpis = array( 'aktualny' => 1);
		$this->db->where('id', $id);
		$this->db->update("pracownicy",$wpis);
		$tab = $this->pobierz_tab_pracownika($id);
		
		$this->db->cache_delete('pracownicy','index');
		$this->db->cache_delete('pracownicy','json');
		$this->db->cache_delete('admin','upo_nowe');
		$this->db->cache_delete('admin','upo_edytuj');
		
		zapisz_log($this->session->userdata("id"),30,"".$tab["nazwa"]."");
	}
}
?>