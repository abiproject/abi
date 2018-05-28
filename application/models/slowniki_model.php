<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Slowniki_model extends CI_Model
{
function __construct(){
	        parent::__construct();
	    }		

function wybierz_slownik($id_slownik){
		$this->db->from("slowniki");
		$this->db->where("id",$id_slownik);
		$q=$this->db->get();
		
		return $q->row();
	}
	
function pobierz_slownik($slownik,$id_zaklad,$sort="ASC"){
		if($id_zaklad != 0)
		$this->db->where("id_zaklad",$id_zaklad);
		$this->db->order_by("id",$sort);
		
		return $this->db->get($slownik);
	}
function pobierz_pozycje($slownik,$id_zaklad=0,$suma=0,$ile=0,$od=0){
	$this->db->select("".$slownik.".id as pid,nazwa,nazwa_zakladu");
	$this->db->from("".$slownik.",zaklady");
	$this->db->where("".$slownik.".id_zaklad = zaklady.id");
	if($id_zaklad > 0)
	{	
		$this->db->where("".$slownik.".id_zaklad",$id_zaklad);		
	}
	if($suma == 1)
		return $this->db->count_all_results();
	else
		{
			return $this->db->get();	
		}
}

function pobierz_pozycje_json($slownik,$id_zaklad=0){
	$this->db->select("".$slownik.".id as pid,nazwa,nazwa_zakladu, flaga");
	$this->db->from("".$slownik.",zaklady");
	$this->db->where("".$slownik.".id_zaklad = zaklady.id");
	if($id_zaklad > 0)
	{	
		$this->db->where("".$slownik.".id_zaklad",$id_zaklad);		
	}
	$q = $this->db->get();	
		
	return $this->output
					->set_content_type('application/json')
		        	->set_output(json_encode(array("data" => $q->result())));
}

function spis_zbiory_bez_zakresu(){
	$this->db->select("nazwa");
	$this->db->from("slowniki_zbiory");
	$this->db->join('zbiory_dane', 'slowniki_zbiory.id = zbiory_dane.id_zbior', 'left');
	$this->db->where("dana", NULL);
	
	$q = $this->db->get();
	
	return $q->result_array();
}

function spis_zbiory_bez_zab(){
	$this->db->select("nazwa");
	$this->db->from("slowniki_zbiory");
	$this->db->join('zbiory_zab', 'slowniki_zbiory.id = zbiory_zab.id_zbior', 'left');
	$this->db->where("zbiory_zab.id", NULL);
	
	$q = $this->db->get();
	
	return $q->result_array();
}

function pobierz_slownik_id_sort($slownik,$id_zaklad,$sort="ASC")
		{
			$this->db->where("id_zaklad",$id_zaklad);
			$this->db->order_by("id",$sort);
		
			return $this->db->get($slownik);
		}
		
function element($id_slownik,$element)
	{
		$row = $this->wybierz_slownik($id_slownik);
		$this->db->from($row->nazwa_slownik);
		$this->db->where("id",$element);
	
		return $this->db->get();
	}

function element_tab($id_slownik,$element)
	{
		$row = $this->wybierz_slownik($id_slownik);
		$this->db->from($row->nazwa_slownik.",zaklady");
		$this->db->where($row->nazwa_slownik.".id",$element);
		$this->db->where($row->nazwa_slownik.".id_zaklad = zaklady.id");
		$q = $this->db->get();
		$row = $q->row();
		$tab["element"] = $row->nazwa;
		$tab["zaklad"]  = $row->nazwa_zakladu; 
		
		return $tab;
	}

function nazwa_slownik_id($slownik)
	{
		$this->db->from("slowniki");
		$this->db->where("nazwa_slownik",$slownik);
		$q=$this->db->get();
		$row = $q->row();
		
		return $row->id;
	}
	
function spis_slownikow()
	{
		return $this->db->get("slowniki");	
	}
	
function sprawdz_pozycje($id_slownik,$pozycja,$id_zaklad)
	{
		$row = $this->wybierz_slownik($id_slownik);
		$this->db->where("nazwa",$pozycja);
		$this->db->where("id_zaklad",$id_zaklad);
		
		return $this->db->get($row->nazwa_slownik);	
	}
	
function dodaj_pozycje($pozycja,$id_zaklad,$id_slownik)
	{
		$row = $this->wybierz_slownik($id_slownik);				
		$wpis_baza = array(	'id' => NULL,
									'nazwa' => $pozycja,
									'id_zaklad' => $id_zaklad);

		zapisz_log($this->session->userdata("id"),1,"Sł: ".$row->nazwa_slownik." / Poz: ".$pozycja."");
		
		$this->db->insert($row->nazwa_slownik,$wpis_baza);
		$this->db->cache_delete('slowniki','index');
		$this->db->cache_delete('slowniki','json');
		$this->db->cache_delete('zbiory','edytuj_zab');
		$this->db->cache_delete('zbiory','edytuj');
		$this->db->cache_delete('admin','upo_nowe');
		$this->db->cache_delete('admin','upo_edytuj');
		$this->db->cache_delete('api','giodo');
	}

function usun_pozycje($id_slownik,$id_pozycja)
	{
		$tab = $this->element_tab($id_slownik,$id_pozycja);
		$row = $this->wybierz_slownik($id_slownik);
		$this->db->where("id",$id_pozycja);
		$this->db->delete($row->nazwa_slownik);
		
		zapisz_log($this->session->userdata("id"),2,"Sł: ".$row->nazwa_slownik." / Poz: ".$tab["element"]."");
		
		$this->db->cache_delete('slowniki','index');
		$this->db->cache_delete('slowniki','json');
		$this->db->cache_delete('zbiory','edytuj_zab');
		$this->db->cache_delete('zbiory','edytuj');
		$this->db->cache_delete('zbiory','index');
		$this->db->cache_delete('zbiory','index_zab');
		$this->db->cache_delete('rejestry','struktury_zbiorow');
		$this->db->cache_delete('rejestry','struktury_zbiorow_zab');
		$this->db->cache_delete('rejestry','upowaznienia');
		$this->db->cache_delete('admin','upo_nowe');
		$this->db->cache_delete('admin','upo_edytuj');
		$this->db->cache_delete('export','pdf');
		$this->db->cache_delete('api','giodo');		
	}
function aktualizuj_pozycje($id_slownik,$id_pozycja,$nazwa)
	{
		$tab = $this->element_tab($id_slownik,$id_pozycja);
		
		$row = $this->wybierz_slownik($id_slownik);				
		$wpis_baza = array('nazwa' => $nazwa);
		$this->db->where('id', $id_pozycja);
		$this->db->update($row->nazwa_slownik, $wpis_baza);
		zapisz_log($this->session->userdata("id"),3,"Sł: ".$row->nazwa_slownik." / Poz: <del>".$tab["element"]."</del> - ".$nazwa."");
		
		$this->db->cache_delete('slowniki','json');
		$this->db->cache_delete('slowniki','index');
		$this->db->cache_delete('zbiory','edytuj_zab');
		$this->db->cache_delete('zbiory','edytuj');
		$this->db->cache_delete('zbiory','index');
		$this->db->cache_delete('zbiory','index_zab');
		$this->db->cache_delete('rejestry','struktury_zbiorow');
		$this->db->cache_delete('rejestry','struktury_zbiorow_zab');
		$this->db->cache_delete('rejestry','upowaznienia');
		$this->db->cache_delete('admin','upo_nowe');
		$this->db->cache_delete('admin','upo_edytuj');
		$this->db->cache_delete('export','pdf');
		$this->db->cache_delete('api','giodo');	
		
	}
}
?>