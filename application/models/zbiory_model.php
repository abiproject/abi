<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Zbiory_model extends Ci_Model
{
function __construct()
    {
        parent::__construct();
    }		
	 
function pobierz_zbiory_z_zakladu($id_zaklad)
 	{
		$this->db->select("slowniki_zbiory.id as sid, zbiory_dane.id as zid, id_zbior, slowniki_zbiory.id_zaklad, dana, nazwa");
		$this->db->from("zbiory_dane,slowniki_zbiory");
 		$this->db->where("slowniki_zbiory.id_zaklad",$id_zaklad);
		$this->db->where("zbiory_dane.id_zbior","slowniki_zbiory.id",false);
		
 		return $this->db->get();	
 	}
		
function pobierz_zbiory($id)
	{
		$this->db->where("id_zbior",$id);
		return $this->db->get("zbiory_dane");	
	}
	
function pobierz_slownik_zbiory_id($id)
	{
		$this->db->where("id",$id);	
		$q = $this->db->get("slowniki_zbiory");
		if($q->num_rows() > 0)
			return $q->row_array();
		else
			return false;
	}
			
function zapisz_dane($id_zbior,$id_zaklad,$dane)
	{
		$this->db->where("id_zbior",$id_zbior);
		$this->db->where("id_zaklad",$id_zaklad);
		$this->db->delete("zbiory_dane");
		foreach($dane as $row)
			{
				if($dane != "")
				{
					$wpis = array( 'id' => NULL,
										'id_zbior' => $id_zbior,
										'id_zaklad' => $id_zaklad,
										'dana' => $row);
				$this->db->insert("zbiory_dane",$wpis);
				}
			}
		$this->db->where("id",$id_zbior);
		$q = $this->db->get("slowniki_zbiory");
		$row = $q->row();
		
		zapisz_log($this->session->userdata("id"),10,"Zbiór: ".$row->nazwa."");	
		$this->db->cache_delete("rejestry","struktury_zbiorow");
		$this->db->cache_delete("zbiory","index");
		$this->db->cache_delete("zbiory","edytuj");
		$this->db->cache_delete('api','giodo');
		
	}

function pobierz_zbiory_zab($id){
		$this->db->where("id_zbior",$id);
		return $this->db->get("zbiory_zab");	
	}
	
function pobierz_zbior_id($id){
		$this->db->where("id",$id);
		$q = $this->db->get("slowniki_zbiory");
		
		return $q->row();
	}
	
function zapisz_mod_zbioru($id,$opis_kat_osob,$sposob_zbierania_dan,$kat_odbiorcow,$ew_przekaz_danych){
	$this->db->where("id",$id);
	$wpis = array(
		"opis_kat_osob" => $opis_kat_osob,
		"sposob_zbierania_dan" => $sposob_zbierania_dan,
		"kat_odbiorcow" => $kat_odbiorcow,
		"ew_przekaz_danych" => $ew_przekaz_danych
	);
	
	$this->db->update("slowniki_zbiory",$wpis);
	
}

function zapisz_dane_zab($id_zbior,$id_zaklad,$dane)
	{
		$this->db->where("id_zbior",$id_zbior);
		$this->db->where("id_zaklad",$id_zaklad);
		$this->db->delete("zbiory_zab");
		
		$wpis = array( 'id' 				=> NULL,
							'id_zbior' 		=> $id_zbior,
							'id_zaklad' 	=> $id_zaklad,
							'baza_danych' 	=> $dane["bazadanych"],
							'zab_bazy'		=> $dane["zab_bazy"],
							'program' 		=> $dane["program"],
							'giodo'			=> $dane["giodo"],
							'lokalizacja'	=> $dane["lokalizacja"],
							'pokoj_pietro' => $dane["pokoj_pietro"],
							'f_lokalizacji'=> $dane["f_lokalizacji"],
							'zab_fizyczne' => $dane["zab_fizyczne"],
							'podstawa_prze'=> $dane["podstawa_prze"] 
						);
		$this->db->insert("zbiory_zab",$wpis);
		
		$this->db->where("id",$id_zbior);
		$q = $this->db->get("slowniki_zbiory");
		$row = $q->row();
	
		zapisz_log($this->session->userdata("id"),18,"Zbiór: ".$row->nazwa."");	
		$this->db->cache_delete("zbiory","index_zab");
		$this->db->cache_delete("zbiory","edytuj_zab");
		$this->db->cache_delete("rejestry","struktury_zbiorow_zab");
		$this->db->cache_delete('api','giodo');
	}
	
function publikuj_zbior($id_zbior, $id_zaklad){
	$this->db->where("id",$id_zbior);
	$this->db->where("id_zaklad",$id_zaklad);
	$wpis = array( "flaga" => 1 );
	
	$this->db->update("slowniki_zbiory",$wpis);
	
	$this->db->cache_delete_all();
	}

function niepublikuj_zbior($id_zbior, $id_zaklad){
		$this->db->where("id",$id_zbior);
		$this->db->where("id_zaklad",$id_zaklad);
		$wpis = array( "flaga" => 0 );
	
		$this->db->update("slowniki_zbiory",$wpis);
	
		$this->db->cache_delete_all();
		}


function pobierz_zbiory_zab_z_zakladu($id_zaklad)
 	{
		$this->db->from("zbiory_zab,slowniki_zbiory");
 		$this->db->where("slowniki_zbiory.id_zaklad",$id_zaklad);
		$this->db->where("zbiory_zab.id_zbior","slowniki_zbiory.id",false);
		
 		return $this->db->get();	
 	}
	
function pobierz_liste_zbiorow($id_zaklad)
	 	{
			$this->db->from("slowniki_zbiory");
	 		$this->db->where("slowniki_zbiory.id_zaklad",$id_zaklad);
					
	 		return $this->db->get();	
	 	}

}
?>