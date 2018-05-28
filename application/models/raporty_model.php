<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Raporty_model extends Ci_Model
{
function __construct()
    {
        parent::__construct();
    }		
	 
function dodaj_rap_pok($dane)
	{
		$this->db->where("id_zaklad",$dane["zaklad"]);
		$q=$this->db->get("raporty_pok");
		$row = $q->last_row();
		$nr = @intval($row->nr) + 1;
		
		$wpis = array(
		   'id' => NULL,
		   'id_zaklad' 					=> $dane["zaklad"],
		   'nr'								=> $nr,
		   'miejsce' 						=> $dane["miejsce"],
		   'termin'							=> $dane["termin"],
		   'godz_start'					=> $dane["godz_start"],
		   'godz_meta' 					=> $dane["godz_stop"],
		   'kier_kontrolowanego_ob'	=> $dane["kier_kontrolowanego_ob"],
		   'osoby_kontrolowane'			=> $dane["osoby_kontrolowane"],
		   'obszar_kontrolowany' 		=> $dane["obszar_kontrolowany"], 
		   'kontrolerzy' 					=> $dane["kontrolerzy"],
		   'podstawa' 						=> $dane["podstawa"], 
		   'uchybienie_1' 				=> $dane["uchybienie_1"],
		   'uchybienie_2' 				=> $dane["uchybienie_2"],
		   'uchybienie_3' 				=> $dane["uchybienie_3"],
		   'uchybienie_4' 				=> $dane["uchybienie_4"],
		   'uchybienie_5' 				=> $dane["uchybienie_5"],
		   'uchybienie_6' 				=> $dane["uchybienie_6"],
		   'uchybienie_7' 				=> $dane["uchybienie_7"],
		   'uchybienie_8' 				=> $dane["uchybienie_8"],
		   'uchybienie_9' 				=> $dane["uchybienie_9"],
		   'uchybienie_10'				=> $dane["uchybienie_10"],
		   'uchybienie_11'				=> $dane["uchybienie_11"],
		   'uchybienie_12'				=> $dane["uchybienie_12"],
		   'uchybienie_13'				=> $dane["uchybienie_13"],
		   'uchybienie_14'				=> $dane["uchybienie_14"]
		);
		
		$this->db->insert("raporty_pok",$wpis);
		
		zapisz_log($this->session->userdata("id"),14,"Nr: ".$nr.", termin: ".$dane['termin']."");
		$this->db->cache_delete("raporty","index");
	}
	
function pobierz_raporty_pok($id_zaklad=0)
	{
		$this->db->select("raporty_pok.id as rid, nr,nazwa_zakladu,osoby_kontrolowane,kier_kontrolowanego_ob,termin,miejsce");
		if($id_zaklad > 0)
		$this->db->where("id_zaklad",$id_zaklad);
		$this->db->from("raporty_pok,zaklady");
		$this->db->where("raporty_pok.id_zaklad","zaklady.id",false);
		
		return $this->db->get();
	}
	
function	pobierz_pok($id)
	{
		$this->db->where("raporty_pok.id",$id);
		$this->db->from("raporty_pok,zaklady");
		$this->db->where("raporty_pok.id_zaklad","zaklady.id",false);
		
		return $this->db->get();
	}
function usun_pok($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("raporty_pok");	
		zapisz_log($this->session->userdata("id"),16,"Id: ".$id."");
		
		$this->db->cache_delete("raporty","index");
	}

function dodaj_rap_roczny($dane)
	{
		$this->db->where("id_zaklad",$dane["zaklad"]);
		$q=$this->db->get("raporty_roczne");
		$row = $q->last_row();
		$nr = @intval($row->nr) + 1;

		$wpis = array(
		   'id' => NULL,
		   'id_zaklad' 		=> $dane["zaklad"],
		   'nr'					=> $nr,
		   'uczestnicy' 		=> $dane["uczestnicy"],
		   'termin'				=> $dane["termin"],
		   'zagadnienia'		=> $dane["zagadnienia"],
		   'uwagi' 				=> $dane["uwagi"],
		   'podsumowanie'		=> $dane["podsumowanie"],
		   'omowienie'			=> $dane["omowienie"],
		   'omowienie_2' 		=> $dane["omowienie_2"], 
		   'propozycje' 		=> $dane["propozycje"]
		);

		$this->db->insert("raporty_roczne",$wpis);

		zapisz_log($this->session->userdata("id"),15,"Nr: ".$nr.", termin: ".$dane['termin']."");
		
		$this->db->cache_delete("raporty","index");
	}
	
function pobierz_raporty_roczne($id_zaklad=0)
	{
		$this->db->select("raporty_roczne.id as rid, nr,uczestnicy,termin,zagadnienia,uwagi,podsumowanie,omowienie_2,omowienie,propozycje, nazwa_zakladu");
		if($id_zaklad > 0)
		$this->db->where("id_zaklad",$id_zaklad);
		$this->db->from("raporty_roczne,zaklady");
		$this->db->where("raporty_roczne.id_zaklad","zaklady.id",false);
		
		return $this->db->get();
	}
	
function	pobierz_roczny($id)
	{
		$this->db->select("raporty_roczne.id as rid, nr,uczestnicy,termin,zagadnienia,uwagi,podsumowanie,omowienie_2,omowienie,propozycje");
		$this->db->from("raporty_roczne,zaklady");
		$this->db->where("raporty_roczne.id",$id);
		$this->db->where("raporty_roczne.id_zaklad","zaklady.id",false);
		
		return $this->db->get();
	}
	
function usun_roczny($id)
	{
			$this->db->where("id",$id);
			$this->db->delete("raporty_roczne");
			
			zapisz_log($this->session->userdata("id"),17,"Id: ".$id."");
			
			$this->db->cache_delete("raporty","index");
	}
	
}
?>