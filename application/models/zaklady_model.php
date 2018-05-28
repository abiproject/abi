<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Zaklady_model extends Ci_Model
{
	
function __construct()
    {
        parent::__construct();
    }	
			 
function spis_zakladow($id_zaklad=0)
	{
		if($id_zaklad > 0)
 			$this->db->where("id",$id_zaklad);
 			$this->db->order_by("nazwa_zakladu");
	
 			return $this->db->get("zaklady");
	}	

function spis_abi($id_zaklad)
	{
			$this->db->from("zaklady, zaklady_abi");
			$this->db->where("zaklady_abi.id_zaklad","zaklady.id",false);
 			$this->db->where("zaklady.id",$id_zaklad);
 			$this->db->order_by("data_powolania");

 			return $this->db->get();
	}	


function pobierz_zaklady($id)
	{
		if($id != 0)
		$this->db->where("id",$id);
		$this->db->order_by("nazwa_zakladu","ASC");

		return $this->db->get("zaklady");	
	}

function dodaj_api($id)
	{
		$this->db->where("id",$id);
		$q=$this->db->get("zaklady");
		if($q->num_rows() > 0)
		{
			$row = $q->result();
			if(isset($row["api_key"]))
				return "error";
			else
			{
				$wpis = array( 'api_key' => md5(@$row["nazwa_zakladu"].@$row["miasto"].@$row["regon"].date("y-m-d H:i:s")));
				$this->db->where("id",$id);
				$this->db->update("zaklady",$wpis);
				$this->db->cache_delete_all();
			}
		}
		else
			return "error";
	}

function suma_zakladow()
	{
			return $this->db->count_all_results('zaklady');
	}

function dodaj_zaklad($nazwa,$miasto,$adres,$nip,$regon)
	{
		$wpis = array( 'id' => NULL,
		 					'nazwa_zakladu' => $nazwa,
							'miasto' => $miasto,
							'adres' => $adres,
							'nip' => $nip,
							'regon' => $regon);
							
	   $this->db->insert("zaklady",$wpis);
		zapisz_log($this->session->userdata("id"),40,"Nazwa: ".$nazwa."",$wpis);
		
		$this->db->cache_delete_all();
	}
	
function dodaj_abi($id,$imie_nazwisko,$pesel=null,$nazwa_dok=null,$seria_dok=null,$kulica=null,
$knr_domu=null,$knr_lokalu=null,$kkod=null,$kmiasto=null,$data,$c1=null,$c2=null,$c3=null,$c4=null)
	{
		$wpis = array( 'id_abi' 				=> NULL,
		 					'id_zaklad' 			=> $id,
							'imie_nazwisko' 		=> $imie_nazwisko,
							'pesel' 					=> $pesel,
							'nazwa_dokumentu' 	=> $nazwa_dok,
							'nr_dokumentu'		 	=> $seria_dok,
							'kor_ulica'				=>	$kulica,
							'kor_nr_domu'			=> $knr_domu,
							'kor_nr_lokalu'		=> $knr_lokalu,
							'kor_kod_pocztowy'	=> $kkod,
							'kor_miasto'			=> $kmiasto,
							'data_powolania'		=>	$data,
							'c1'						=> $c1,
							'c2'						=> $c2,
							'c3'						=> $c3,
							'c4'						=> $c4,
							'data_odwolania'		=> NULL,
							'przyczyna_od'			=> NULL);
						
	   $this->db->insert("zaklady_abi",$wpis);
		$this->db->cache_delete_all();
	}
	
function odwolaj_abi($id_abi,$data_od,$przyczyna=null)
	{
		$wpis = array( 'data_odwolania'		=> $data_od,
							'przyczyna_od'			=> $przyczyna);
							
		$this->db->where("id_abi",$id_abi);			
	   $this->db->update("zaklady_abi",$wpis);
		$this->db->cache_delete_all();
	}
	
function pobierz_abi($id_abi,$id_zaklad)
	{
		$this->db->from("zaklady, zaklady_abi");
		$this->db->where("zaklady_abi.id_zaklad","zaklady.id",false);
		$this->db->where("id_abi",$id_abi);
		if($id_zaklad != 0)
		$this->db->where("zaklady_abi.id_zaklad",$id_zaklad);

		return $this->db->get();
	}	
	
function usun_zaklad($id)
		{
			$this->db->where("id_zakladu",$id);
			$q=$this->db->get("pracownicy");
			if($q->num_rows() == 0)
			{
				$this->db->where("id",$id);
				$this->db->delete("zaklady");
				zapisz_log($this->session->userdata("id"),41,"Id: ".$id."");
			}
			else
				return "error";
		}
		
function usun_abi($id)
		{
				$this->db->where("id_abi",$id);
				$this->db->delete("zaklady_abi");
				$this->db->cache_delete_all();
		}
		
function zapisz_zaklad($id,$nazwa_zakladu,$miasto,$adres,$nip,$regon)
	{
		$wpis = array( 'nazwa_zakladu' => $nazwa_zakladu,
							'miasto'			 => $miasto,
							'adres'			 => $adres,
							'nip'				 => $nip,
							'regon'			 => $regon);
		$this->db->where("id",$id);
		$this->db->update("zaklady",$wpis);
		zapisz_log($this->session->userdata("id"),45,"Id: ".$id."",$wpis);
		
		$this->db->cache_delete_all();
	}
	
function dodaj_plik($data,$zaklad,$nazwa_pliku,$plik,$plik_roz,$plik_rozmiar,$komentarz,$id_uploader)
	{
		$wpis = array(
			"id_plik" 		=>	NULL,
			"id_zaklad" 	=> $zaklad,
			"nazwa_pliku" 	=> $nazwa_pliku,
			"plik"			=> $plik,
			"plik_roz"		=> $plik_roz,
			"plik_rozmiar" => $plik_rozmiar,
			"komentarz"		=> $komentarz,
			"data"			=> $data,
			"id_uploader"	=> $id_uploader);
			
		$this->db->insert("zaklady_pliki",$wpis);
		zapisz_log($this->session->userdata("id"),42,"Nazwa: ".$nazwa_pliku.", rozmiar: ".$plik_rozmiar."",$wpis);
		$this->db->cache_delete("zaklady_pliki","index");
		$this->db->cache_delete("zaklady_pliki","json");
	}

function usun_plik($id,$id_zaklad)
	{
		if($id_zaklad > 0)
			$this->db->where("id_zaklad",$id_zaklad);
		
		$this->db->where("id_plik",$id);
		$this->db->delete("zaklady_pliki");
		zapisz_log($this->session->userdata("id"),43,"Id: ".$id."");
		$this->db->cache_delete("zaklady_pliki","index");
		$this->db->cache_delete("zaklady_pliki","json");
	}

function pobierz_plik($id,$id_zaklad)
{
	$this->db->select("plik, plik_roz");
	if($id_zaklad > 0){
		$this->db->where("id_zaklad",$id_zaklad,false);
	}
	$this->db->where("id_plik",$id);
	$q = $this->db->get("zaklady_pliki");
		
	return $q->row();	
}
	
function spis_plikow_json($id_zaklad)
	{
		$this->db->select("zaklady_pliki.id_plik as pid, users.nazwa as unazwa, nazwa_zakladu, nazwa_pliku, plik, plik_roz, plik_rozmiar, komentarz, data");
		$this->db->from("zaklady, zaklady_pliki, users");
		$this->db->where("zaklady_pliki.id_zaklad","zaklady.id",false);
		$this->db->where("zaklady_pliki.id_uploader","users.id",false);
		if($id_zaklad > 0)
		$this->db->where("zaklady.id",$id_zaklad);
		$this->db->order_by("data");
		$q = $this->db->get();
		
	 	return $this->output
	   				->set_content_type('application/json')
	 	        	->set_output(json_encode(array("data" => $q->result())));
	}
}
?>