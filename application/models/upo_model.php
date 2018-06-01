<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upo_model extends Ci_Model
{
	
function __construct()
   {
          parent::__construct();
			 $this->load->model("Pracownicy_model");
   }
	
function upo_by_zaklad_asi($id_zaklad)
	{		
			$this->db->select("upowaznienia.id as uid, data_od, data_do, nazwiskoimie, plec, nazwa_zakladu,nr,
				slowniki_miejsca.nazwa AS miejsce,miasto, upowaznienia_systemy.id_system as ASI,
		upowaznienia_systemy.zakres as ASI_zakres",false);
			$this->db->from("upowaznienia");
			$this->db->join("pracownicy","pracownicy.id = upowaznienia.id_prac");
			$this->db->join("slowniki_miejsca","slowniki_miejsca.id = upowaznienia.id_miejsce","left outer");
			$this->db->join("zaklady","zaklady.id = upowaznienia.id_zaklad","left outer");
			$this->db->join("upowaznienia_systemy","upowaznienia_systemy.id_upo = upowaznienia.id","left outer");
			$this->db->where("zaklady.id",$id_zaklad);

			return $this->db->get();
	}
	
function upo_by_zaklad_abi($id_zaklad)
	{		
			$this->db->select("upowaznienia.id as uid, data_od, data_do, nazwiskoimie, plec, nazwa_zakladu,nr,
				slowniki_miejsca.nazwa AS miejsce,miasto, upowaznienia_zbiory.id_zbior as ABI,
		upowaznienia_zbiory.zakres as ABI_zakres",false);
			$this->db->from("upowaznienia");
			$this->db->join("pracownicy","pracownicy.id = upowaznienia.id_prac");
			$this->db->join("slowniki_miejsca","slowniki_miejsca.id = upowaznienia.id_miejsce","left outer");
			$this->db->join("zaklady","zaklady.id = upowaznienia.id_zaklad","left outer");
			$this->db->join("upowaznienia_zbiory","upowaznienia_zbiory.id_upo = upowaznienia.id","left outer");
			$this->db->where("zaklady.id",$id_zaklad);

			return $this->db->get();
	}
	
function upo_by_id($uid,$zaklad)
		{
			$this->db->select("upowaznienia.id as uid, data_od, data_do, nazwiskoimie, plec, nazwa_zakladu,nr,
				slowniki_miejsca.nazwa AS miejsce,miasto, IFNULL(COUNT(upowaznienia_systemy.id_system),0) as ASI, IFNULL(COUNT(upowaznienia_zbiory.id_zbior),0) as ABI",false);
			$this->db->from("upowaznienia");
			$this->db->join("pracownicy","pracownicy.id = upowaznienia.id_prac");
			$this->db->join("slowniki_miejsca","slowniki_miejsca.id = upowaznienia.id_miejsce","left outer");
			$this->db->join("zaklady","zaklady.id = upowaznienia.id_zaklad","left outer");
			$this->db->join("upowaznienia_systemy","upowaznienia_systemy.id_upo = upowaznienia.id","left outer");
			$this->db->join("upowaznienia_zbiory","upowaznienia_zbiory.id_upo = upowaznienia.id","left outer");
			$this->db->where("upowaznienia.id",$uid);
			if($zaklad > 0)
				$this->db->where("upowaznienia.id_zaklad",$zaklad);
	
			
			return $this->db->get();
		}



function upo_puste($zaklad, $od,$ile)
{

		$this->db->cache_off();
		$this->db->select("upowaznienia.id as uid,nazwa_zakladu,nr");
		$this->db->from("upowaznienia");
		$this->db->join("zaklady","zaklady.id = upowaznienia.id_zaklad","left outer");
			$this->db->where('id_prac',0);
		if($zaklad > 0)
			$this->db->where("upowaznienia.id_zaklad",$zaklad);
		$this->db->group_by("uid");
		$this->db->limit($ile,$od);	
		return $this->db->get();

}	

function suma_puste($zaklad)
{

		$this->db->cache_off();
		$this->db->select("upowaznienia.id as uid,nazwa_zakladu,nr");
		$this->db->from("upowaznienia");
		$this->db->join("zaklady","zaklady.id = upowaznienia.id_zaklad","left outer");
		$this->db->where('id_prac',0);
		if($zaklad > 0)
			$this->db->where("upowaznienia.id_zaklad",$zaklad);
		return $this->db->count_all_results();

}


		
function upo_nazwisko($nazwisko,$zaklad,$typ,$od,$ile,$wygasajace=NULL)
	{
		$this->db->cache_off();
		$this->db->select("upowaznienia.id as uid, data_od, data_do, nazwiskoimie,nazwa_zakladu,nr,
			slowniki_miejsca.nazwa AS miejsce, IFNULL(COUNT(upowaznienia_systemy.id_system),0) as ASI, IFNULL(COUNT(upowaznienia_zbiory.id_zbior),0) as ABI",false);
		$this->db->from("upowaznienia");
		$this->db->join("pracownicy","pracownicy.id = upowaznienia.id_prac");
		$this->db->join("slowniki_miejsca","slowniki_miejsca.id = upowaznienia.id_miejsce","left outer");
		$this->db->join("zaklady","zaklady.id = upowaznienia.id_zaklad","left outer");
		$this->db->join("upowaznienia_systemy","upowaznienia_systemy.id_upo = upowaznienia.id","left outer");
		$this->db->join("upowaznienia_zbiory","upowaznienia_zbiory.id_upo = upowaznienia.id","left outer");
		$this->db->like("nazwiskoimie",$nazwisko);
		if($zaklad > 0)
			$this->db->where("upowaznienia.id_zaklad",$zaklad);
		if(@$typ["aktualne"] == 1)
			$this->db->where("data_do >","NOW()",false);
		if($wygasajace !== NULL)
			{
				$this->db->where("data_do >","DATE_SUB(NOW(), INTERVAL 1 DAY)",false);
				$this->db->where("data_do <","DATE_ADD(NOW(), INTERVAL 14 DAY)",false);
			}
		if(@$typ["uid"] == 1)
			$this->db->order_by("nr","DESC");
		if(@$typ["data"] == 1)
			$this->db->order_by("data_do","ASC");
		
		$this->db->group_by("uid");
		$this->db->limit($ile,$od);
		
		return $this->db->get();
	}

function suma_upo_nazwisko($nazwisko,$zaklad,$typ,$stat=NULL)
	{
		$this->db->cache_off();
		$this->db->select("upowaznienia.id as uid, data_od, data_do, nazwiskoimie,nazwa_zakladu,nr,
			slowniki_miejsca.nazwa AS miejsce",false);
		$this->db->from("upowaznienia");
		$this->db->join("pracownicy","pracownicy.id = upowaznienia.id_prac");
		$this->db->join("slowniki_miejsca","slowniki_miejsca.id = upowaznienia.id_miejsce","left outer");
		$this->db->join("zaklady","zaklady.id = upowaznienia.id_zaklad","left outer");
		$this->db->like("nazwiskoimie",$nazwisko);
		if($zaklad > 0)
			$this->db->where("upowaznienia.id_zaklad",$zaklad);
		if(@$typ["aktualne"] == 1)
			$this->db->where("data_do >","NOW()",false);
		if($stat !== NULL)
		{
			$this->db->where("data_do >","DATE_SUB(NOW(), INTERVAL 1 DAY)",false);
			$this->db->where("data_do <","DATE_ADD(NOW(), INTERVAL 14 DAY)",false);
		}
		
		return $this->db->count_all_results();
	}

	
	
function upo_edytuj_spr($uid,$zaklad)

	{
		$this->db->select("upowaznienia.id as uid, id_prac");
		$this->db->from("upowaznienia");
		$this->db->where("upowaznienia.id",$uid);
		if($zaklad > 0)
			$this->db->where("upowaznienia.id_zaklad",$this->session->userdata("zaklad"));
		return $this->db->get();
	}

	
	
	
function upo_edytuj_puste($uid,$zaklad)

	{
		$this->db->select("upowaznienia.id as uid, nr, id_zaklad");
		$this->db->from("upowaznienia");
		$this->db->where("upowaznienia.id",$uid);
		if($zaklad > 0)
			$this->db->where("upowaznienia.id_zaklad",$this->session->userdata("zaklad"));
		return $this->db->get();
	}	
	
	
	
	
function upo_edytuj($uid,$zaklad)

	{
		$this->db->select("upowaznienia.id as uid, data_od, data_do, id_prac,nr,slowniki_miejsca.nazwa as miejsce");
		$this->db->from("upowaznienia,slowniki_miejsca");
		$this->db->where("upowaznienia.id",$uid);
		$this->db->where("slowniki_miejsca.id","upowaznienia.id_miejsce",false);
		if($zaklad > 0)
			$this->db->where("upowaznienia.id_zaklad",$this->session->userdata("zaklad"));
		return $this->db->get();
	}
function upo_pobierz_upowaznienia($baza,$id_upo,$sort="ASC")
	{
		$this->db->where("id_upo",$id_upo);
		
		if($baza == "system")
		$this->db->order_by("id_system","ASC");
		if($baza == "zbiory")
		$this->db->order_by("id_zbior","ASC");	
		
		return $this->db->get("upowaznienia_".$baza);
	}
function upo_pobierz_upowaznienia_slownik($baza,$id_upo,$sort="ASC")
		{
			$this->db->where("id_upo",$id_upo);
			
			if($baza == "systemy")
			{
				$baza2 = "slowniki_systemy";
				$this->db->order_by("id_system","ASC");
				$this->db->from("upowaznienia_".$baza.", ".$baza2."");
				$this->db->where("".$baza2.".id","upowaznienia_".$baza.".id_system",false);
			}
			if($baza == "zbiory")
			{
				$baza2 = "slowniki_zbiory";
				$this->db->order_by("id_zbior","ASC");
				$this->db->from("upowaznienia_".$baza.", ".$baza2."");
				$this->db->where("".$baza2.".id","upowaznienia_".$baza.".id_zbior",false);
			}
			
			return $this->db->get();
		}
function upo_zapisz_upowaznienia($baza,$id_upo,$id_system,$login,$zakres)
	{
		
		if($baza == "systemy")
		{
			$wpis_baza = array( 	'login' 	=> $login,
										'zakres' => $zakres);
			$this->db->where("id_system",(int)$id_system);
			$this->db->where("id_upo",(int)$id_upo);
			$this->db->update("upowaznienia_".$baza,$wpis_baza);
			zapisz_log($this->session->userdata("id"),4,"Upo: ".$id_upo." ".$baza."/".$id_system.", ".$login."/".$zakres."",$wpis_baza);
			
		}
		if($baza == "zbiory")
		{
			$wpis_baza = array('zakres' => $zakres);
			$this->db->where("id_zbior",(int)$id_system);
			$this->db->where("id_upo",(int)$id_upo);
			$this->db->update("upowaznienia_".$baza,$wpis_baza);
			zapisz_log($this->session->userdata("id"),4,"Upo: ".$id_upo." ".$baza."/".$id_system.", ".$zakres."",$wpis_baza);
		
		}
		$this->db->cache_delete("admin","upo");
		$this->db->cache_delete("admin","upo_edytuj");
		$this->db->cache_delete('rejestry','upowaznienia');
		$this->db->cache_delete('export','pdf');
		$this->db->cache_delete("admin","index");		
		
	}
function upo_dodaj_upowaznienia($baza,$id_upo,$id_system,$login,$zakres)
	{
		if($baza == "systemy")
		{
			$wpis_baza = array(  'id' 			=> NULL,
										'id_upo' 	=> $id_upo,
										'id_system' => $id_system,
										'login' 		=> $login,
										'zakres' 	=> $zakres);
			$this->db->insert("upowaznienia_".$baza,$wpis_baza);
			
			zapisz_log($this->session->userdata("id"),9,"Upo: ".$id_upo." ".$baza." / ".$id_system.", ".$login." / ".$zakres."",$wpis_baza);
		}
		if($baza == "zbiory")
		{
			$wpis_baza = array(  'id' 			=> NULL,
										'id_upo' 	=> $id_upo,
										'id_zbior' 	=> $id_system,
										'zakres' 	=> $zakres);
			$this->db->insert("upowaznienia_".$baza,$wpis_baza);
			zapisz_log($this->session->userdata("id"),9,"Upo: ".$id_upo." ".$baza." / ".$id_system.", ".$zakres."",$wpis_baza);
		}
		$this->db->cache_delete("admin","upo");
		$this->db->cache_delete("admin","upo_edytuj");
		$this->db->cache_delete('rejestry','upowaznienia');
		$this->db->cache_delete("admin","index");
	}

function upo_pobierz($id_upo)
	{
		$this->db->where("id",$id_upo);
		
		return $this->db->get("upowaznienia");
	}
	
function upo_zapisz($id_upo,$id_prac,$od,$do,$id_miejsce)
{
	$wpis_baza = array(
		'data_od' => $od,
		'data_do' => $do,
		'id_miejsce' => $id_miejsce,
		'id_prac' => $id_prac);
	$this->db->where("id",$id_upo);							
	$this->db->update("upowaznienia",$wpis_baza);
	
	$tab = $this->Pracownicy_model->pobierz_tab_pracownika($id_prac);
	
	zapisz_log($this->session->userdata("id"),8,"Id: ".$id_upo." / ".$tab["nazwa"]." / daty: ".$od."-".$do."", $wpis_baza);
	$this->db->cache_delete("admin","upo");
	$this->db->cache_delete('rejestry','upowaznienia');
	$this->db->cache_delete('admin','upo_edytuj');
	$this->db->cache_delete('export','pdf');
	$this->db->cache_delete("admin","index");		
}

function przedluz_upo($id_upo)
{
	$upo = $this->Upo_model->upo_by_id($id_upo,0);
	$upo_row = $upo->row();
		
	$data_do = new DateTime($upo_row->data_do);
	$interval = new DateInterval('P5Y');
	$data_do->add($interval);
	$wpis_baza = array('data_do' => $data_do->format('Y-m-d'));
	$this->db->where("id",$id_upo);
	$this->db->update("upowaznienia",$wpis_baza);
	
	zapisz_log($this->session->userdata("id"),39,"Id: ".$id_upo." / ".$upo_row->nazwiskoimie." / data do: ".$data_do->format('Y-m-d')."", $wpis_baza);
	$this->db->cache_delete("admin","upo");
	$this->db->cache_delete('rejestry','upowaznienia');
	$this->db->cache_delete('admin','upo_edytuj');
	$this->db->cache_delete('export','pdf');
	$this->db->cache_delete("admin","index");		
}

function cofnij_upo($id,$data)
{
	$id_q = $this->upo_pobierz($id);
	$row  = $id_q->row();
	$tab  = $this->Pracownicy_model->pobierz_tab_pracownika($id);
	
	$data_do = $data;
	$wpis_baza = array(	'data_do' => $data_do);
	$this->db->where('id', $id);
	$this->db->update('upowaznienia', $wpis_baza);
	zapisz_log($this->session->userdata("id"),7,"Id: ".$id." / ".$tab["nazwa"]." / ".$tab["zaklad"]."");
	
	$this->db->cache_delete("admin","upo");
	$this->db->cache_delete('admin','upo_edytuj');
	$this->db->cache_delete('export','pdf');
	$this->db->cache_delete('rejestry','upowaznienia');
	$this->db->cache_delete("admin","index");
}
function nowe_upo($id_zaklad,$od,$do,$id_prac,$miejsce)
{
		$this->db->cache_delete("admin","upo");
		$this->db->cache_delete('admin','upo_nowe');	
		$this->db->cache_delete('rejestry','upowaznienia');
		$this->db->cache_delete("admin","index");
		
		
		//numeracja
		$this->db->where("id_zaklad",$id_zaklad);
		$q=$this->db->get("upowaznienia");
		$row = $q->last_row();
		$nr = @intval($row->nr) + 1;
		
		$this->db->where("nazwa",$miejsce);
		$this->db->where("id_zaklad",$id_zaklad);
		$q=$this->db->get("slowniki_miejsca");
		$row=$q->row();

		if($q->num_rows() > 0)
		{
			$id_miejsce = $row->id;
		}
		else
		{
			$wpis_baza = array( 'id' => NULL,
								'nazwa' => $miejsce,
								'id_zaklad' => $id_zaklad);
			$this->db->insert("slowniki_miejsca",$wpis_baza);
			$id_miejsce = $this->db->insert_id();
			zapisz_log($this->session->userdata("id"),1,"Słownik: slowniki_miejsca, ".$miejsce."",$wpis_baza);
			$this->db->cache_delete("slowniki","index");
		}
		
		$wpis_baza = array( 'id' => NULL,
							'id_prac' => $id_prac,
							'id_zaklad' => $id_zaklad,
							'data_od' => $od,
							'data_do' => $do,
							'id_miejsce' => $id_miejsce,
							'nr' => $nr);
	
		$this->db->insert("upowaznienia",$wpis_baza);
		$nr = $this->db->insert_id();
		if ($nr > 0)
		 zapisz_log($this->session->userdata("id"),9,"Nr: ".$nr.", Prac: ".$id_prac.", id zaklad: ".$id_zaklad."",$wpis_baza);
		else
		 zapisz_log($this->session->userdata("id"),9,"Błąd podczas dodawania upoważnienia!",$wpis_baza);

		$this->db->where("id_zaklad",$id_zaklad);
		$q=$this->db->get("slowniki_systemy");
		foreach($q->result() as $row)
		{
			if(is_array($this->input->post("si".$row->id."")))
			{
				$zakres = implode(",", $this->input->post("si".$row->id.""));
				$this->upo_dodaj_upowaznienia("systemy",$nr,$row->id,$this->input->post("login".$row->id.""),$zakres);
			}
		}
		
		$this->db->where("id_zaklad",$id_zaklad);
		$q=$this->db->get("slowniki_zbiory");
		foreach($q->result() as $row)
		{
			if(is_array($this->input->post("zb".$row->id."")))
			{
				$zakres = implode(",", $this->input->post("zb".$row->id.""));
				$this->upo_dodaj_upowaznienia("zbiory",$nr,$row->id,0,$zakres);
			}
		}
}

}
?>
