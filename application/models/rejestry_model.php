<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rejestry_model extends Ci_Model
{
	
function __construct()
    {
        parent::__construct();
    }		
	 
function pobierz_rej_umow($id_zaklad=0)
	{
		$this->db->from("zaklady,rejestr_u");
		$this->db->where("rejestr_u.id_zaklad","zaklady.id",false);
		if($id_zaklad != 0)
			$this->db->where("id_zaklad",$id_zaklad);
		
#		$this->db->order_by("id");
		
		return $this->db->get();
	}
	
function dodaj_rpz($nazwa,$id_zaklad,$zakres,$nr_umowy,$uwagi)
	{
		$this->db->where("id_zaklad",$id_zaklad);
		$q=$this->db->get("rejestr_pz");
		$row = $q->last_row();
		$nr = @intval($row->nr) + 1;
		
		$wpis = array( 'id' => NULL,
		 					'id_zaklad' 	=> $id_zaklad,
							'nazwa_firmy' 	=> $nazwa,
							'zakres' 		=> $zakres,
							'nr_umowy' 		=> $nr_umowy,
							'uwagi' 			=> $uwagi,
							'nr'				=> $nr);
		$this->db->insert("rejestr_pz",$wpis);
		
		$this->db->cache_delete('rejestry_pz','index');
		$this->db->cache_delete('rejestry_pz_pdf','index');
		
	}	
	
function usun_rpz($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("rejestr_pz");
		
		$this->db->cache_delete('rejestry_pz','index');
		$this->db->cache_delete('rejestry_pz_pdf','index');
		
	}		
		
function dodaj_unk($data,$id_zaklad,$komorka)
	{
		$this->db->where("id_zaklad",$id_zaklad);
		$q=$this->db->get("rejestr_unk");
		$row = $q->last_row();
		$nr = @intval($row->nr) + 1;
		
		$wpis = array( 'id' => NULL,
							'data' => $data,
							'id_zaklad' => $id_zaklad,
							'komorka' => $komorka,
							'nr' => $nr);
		$this->db->insert("rejestr_unk",$wpis);
		
		zapisz_log($this->session->userdata("id"),11,"Data: ".$data.", komórka: ".$komorka."");
		
		$this->db->cache_delete('rejestry_unk','index');
		$this->db->cache_delete('rejestry_unk_pdf','index');	
	}

function pobierz_rej_unk($id_zaklad=0)
	{
	$this->db->from("zaklady,rejestr_unk");
	$this->db->where("rejestr_unk.id_zaklad","zaklady.id",false);
	if($id_zaklad != 0)
		$this->db->where("zaklady.id",$id_zaklad);
	return $this->db->get();
	}

function usun_runk($id,$id_zaklad=0)
	{
	if($id_zaklad > 0)
		$this->db->where("id_zaklad",$id_zaklad);
		$this->db->where("id",$id);
		$this->db->delete("rejestr_unk");
		
	zapisz_log($this->session->userdata("id"),12,"ID: ".$id."");	
	
	$this->db->cache_delete('rejestry_unk','index');
	$this->db->cache_delete('rejestry_unk_pdf','index');
	}
	
function pobierz_protokol_unk($id,$id_zaklad){
		$this->db->from("zaklady,rejestr_unk");
		$this->db->where("rejestr_unk.id",$id);
		$this->db->where("rejestr_unk.id_zaklad","zaklady.id",false);

	if($id_zaklad > 0){
		$this->db->where("zaklady.id",$id_zaklad);
	}
		return $this->db->get();
}
	
function zalacznik_ud($id,$id_zaklad){
	$this->db->select("zalacznik, zalacznik_typ");
	$this->db->where("id",$id);
	if($id_zaklad > 0){
			$this->db->where("id_zaklad",$id_zaklad);
		}
	$q = $this->db->get("rejestr_ud");
		
	return $q->row();	
}

function pobierz_rej_ud($id_zaklad=0,$start=0,$ile=0){
		$this->db->select('rejestr_ud.id, nr, dane_osobowe, data, nazwa_zakladu, podmiot, podstawa_prawna, zakres, zalacznik, zalacznik_roz, zalacznik_typ, nr_hd, flaga');
		$this->db->from("zaklady,rejestr_ud");
		$this->db->where("rejestr_ud.id_zaklad","zaklady.id",false);
		if($id_zaklad != 0)
	            $this->db->where("id_zaklad",$id_zaklad);
		
		if($ile != 0)
		    $this->db->limit($ile,$start);
		#$this->db->order_by("id");
		
		
		return $this->db->get();
}

function pobierz_rej_ud_by_id($id=0){
		$this->db->from("zaklady,rejestr_ud");
		$this->db->where("rejestr_ud.id_zaklad","zaklady.id",false);
		$this->db->where("rejestr_ud.id",$id);
		
		$q=$this->db->get();
		
		return $q->row();
}


function pobierz_rej_ud_json($id_zaklad=0,$ile,$start,$szukaj,$order){
    $this->db->select('rejestr_ud.id');
    $this->db->from("zaklady,rejestr_ud");
    $this->db->where("rejestr_ud.id_zaklad","zaklady.id",false);
    if(strlen($szukaj['value']) > 0){
        $search = $this->db->escape_like_str($szukaj['value']);
        $this->db->where("(`dane_osobowe` LIKE '%$search%' OR `podmiot` LIKE '%$search%' OR `zakres` LIKE '%$search%' OR `podstawa_prawna` LIKE '%$search%')");
        }

    if($id_zaklad != 0)
    	$this->db->where("id_zaklad",$id_zaklad);
	$all=$this->db->count_all_results();

	$this->db->select('rejestr_ud.id, nr, dane_osobowe, data, nazwa_zakladu, podmiot, podstawa_prawna, zakres, zalacznik, zalacznik_roz, zalacznik_typ, nr_hd, flaga');
	$this->db->from("zaklady,rejestr_ud");
	$this->db->where("rejestr_ud.id_zaklad","zaklady.id",false);
    if(strlen($szukaj['value']) > 0){
		$search = $this->db->escape_like_str($szukaj['value']);
		$this->db->where("(`dane_osobowe` LIKE '%$search%' OR `podmiot` LIKE '%$search%' OR `zakres` LIKE '%$search%' OR `podstawa_prawna` LIKE '%$search%')");
    }

	if($id_zaklad != 0)
		$this->db->where("id_zaklad",$id_zaklad);
 	$order_type = $order[0]["dir"];
	$order_col = $order["columns"][$order[0]["column"]]["data"];
	if($order_col != "0")
		$this->db->order_by($order_col, $order_type);	

	$this->db->limit($ile,$start);
	$q=$this->db->get();

	 if(strlen($szukaj['value']) > 0){
		$filter = $all;
	 }
	 else {
		$filter = $all;
	 } 

	return $this->output
  			->set_content_type('application/json')
	        	->set_output(json_encode(array( "order_type" => $order_type, "order_col" => $order_col, "szukaj" => $szukaj,   "recordsTotal"=> $all,    "recordsFiltered"=> $filter, "data" => $q->result())));
}	
	
function dodaj_ud($data,$id_zaklad,$podmiot,$podstawa,$zakres,$dane,$plik=NULL,$rozmiar=NULL,$typ=NULL,$id_hd=NULL){
		$this->db->where("id_zaklad",$id_zaklad);
		$q=$this->db->get("rejestr_ud");
		$row = $q->last_row();
		$nr = @intval($row->nr) + 1;
	
		$wpis = array( 'id' => NULL,
			'id_zaklad' => $id_zaklad,
			'nr' => $nr,
			'data' => $data,
			'podmiot' => $podmiot,
			'podstawa_prawna' => $podstawa,
			'zakres' => $zakres,
			'dane_osobowe' => $dane,
			'zalacznik' => $plik,
			'zalacznik_roz' => $rozmiar,
			'zalacznik_typ' => $typ,
			'nr_hd' => $id_hd,
			'flaga' => 1
			);
		$this->db->insert("rejestr_ud",$wpis);
	
		zapisz_log($this->session->userdata("id"),13,"Data: ".$data.", podmiot: ".$podmiot."");	
		
		if($id_hd > 0)
			zapisz_log($this->session->userdata("id"),36,"Id zgłoszenia: ".$id_hd."");	
		
		$this->db->cache_delete('rejestry_ud','json');
		$this->db->cache_delete('rejestry_ud','index');
		$this->db->cache_delete('transfer','index');
		$this->db->cache_delete('rejestry_ud_pdf','index');
}

function dodaj_zalacznik($id,$plik=NULL,$rozmiar=NULL,$typ=NULL){
	$wpis = array( 'zalacznik' => $plik,
						'zalacznik_roz' => $rozmiar,
						'zalacznik_typ' => $typ
						);
	$this->db->where("id",$id);
	$this->db->update("rejestr_ud",$wpis);
	
	zapisz_log($this->session->userdata("id"),35,"Id: ".$id.", plik: ".$plik." (".$rozmiar.")");	
	
	$this->db->cache_delete('rejestry_ud','index');
	$this->db->cache_delete('rejestry_ud','json');
	$this->db->cache_delete('transfer','index');
	$this->db->cache_delete('rejestry_ud_pdf','index');
}
function rud_odmowa($id){
	$wpis = array( 'flaga' => 0 );
	$this->db->where("id",$id);
	$this->db->update("rejestr_ud",$wpis);
	
	zapisz_log($this->session->userdata("id"),38,"Id: ".$id.", flaga: NIE");	
	
	$this->db->cache_delete('rejestry_ud','index');
	$this->db->cache_delete('rejestry_ud','json');
	$this->db->cache_delete('transfer','index');
	$this->db->cache_delete('rejestry_ud_pdf','index');
}
function rud_akceptacja($id){
	$wpis = array( 'flaga' => 1 );
	$this->db->where("id",$id);
	$this->db->update("rejestr_ud",$wpis);
	
	zapisz_log($this->session->userdata("id"),38,"Id: ".$id.", flaga: TAK");	
	
	$this->db->cache_delete('rejestry_ud','index');
	$this->db->cache_delete('rejestry_ud','json');
	$this->db->cache_delete('transfer','index');
	$this->db->cache_delete('rejestry_ud_pdf','index');
}
	
function usun_rud($id,$id_zaklad=0){
		if($id_zaklad > 0)
			$this->db->where("id_zaklad",$id_zaklad);
			$this->db->where("id",$id);
			$this->db->delete("rejestr_ud");
		
		zapisz_log($this->session->userdata("id"),37,"Id: ".$id."");
		$this->db->cache_delete('rejestry_ud','index');
		$this->db->cache_delete('rejestry_ud','json');
		$this->db->cache_delete('transfer','index');
		$this->db->cache_delete('rejestry_ud_pdf','index');
	}

function pobierz_rej_inc($id_zaklad=0){
			$this->db->from("zaklady,rejestr_inc");
			$this->db->where("rejestr_inc.id_zaklad","zaklady.id",false);
			if($id_zaklad != 0)
				$this->db->where("id_zaklad",$id_zaklad);
			
			return $this->db->get();
}

function dodaj_inc($id_zaklad,$data_wykrycia,$opis,$data_zgloszenia,$opis_pr_napr){
		$this->db->where("id_zaklad",$id_zaklad);
		$q=$this->db->get("rejestr_inc");
		$row = $q->last_row();
		$nr = @intval($row->nr) + 1;
	
		$wpis = array( 'id' => NULL,
							'id_zaklad' => $id_zaklad,
							'nr' => $nr,
							'data_wykrycia' => $data_wykrycia,
							'opis' => $opis,
							'data_zgloszenia' => $data_zgloszenia,
							'opis_pr_napr' => $opis_pr_napr
						);
		$this->db->insert("rejestr_inc",$wpis);
	
		zapisz_log($this->session->userdata("id"),31,"Data: ".$data_wykrycia.", podmiot: ".$opis."");	
		
		$this->db->cache_delete('rejestr_inc','index');
		$this->db->cache_delete('rejestr_inc_pdf','index');
}

function usun_inc($id,$id_zaklad=0){
		if($id_zaklad > 0)
			$this->db->where("id_zaklad",$id_zaklad);
			$this->db->where("id",$id);
			$this->db->delete("rejestr_inc");
		
		zapisz_log($this->session->userdata("id"),32,"ID: ".$id."");
		$this->db->cache_delete('rejestr_inc','index');
		$this->db->cache_delete('rejestr_inc_pdf','index');
	}
	
function pobierz_rej_u($id_zaklad=0){
			$this->db->from("zaklady,rejestr_u");
			$this->db->where("rejestr_u.id_zaklad","zaklady.id",false);
			if($id_zaklad != 0)
				$this->db->where("id_zaklad",$id_zaklad);
		
			return $this->db->get();
}

function pobierz_rej_u_by_id($id=0){
			$this->db->from("zaklady,rejestr_u");
			$this->db->where("rejestr_u.id_zaklad","zaklady.id",false);
			$this->db->where("rejestr_u.id",$id);
		
			$q = $this->db->get();
			
			return $q->row();
}

function pobierz_rej_u_zbiory($id=0){
			$this->db->from("slowniki_zbiory,rejestr_u_zbiory");
			$this->db->where("rejestr_u_zbiory.id_zbior","slowniki_zbiory.id",false);
			$this->db->where("rejestr_u_zbiory.id_umowa",$id);
			$q = $this->db->get();
			
			return $q->result();
}

function pobierz_rej_u_zbiory_zaznaczone($id){
	$this->db->from("rejestr_u_zbiory_zaw");
	$this->db->where("id_umowa",$id);
	$q = $this->db->get();
	
	return $q->result();
}


function pobierz_rej_u_json($id_zaklad=0,$ile,$start,$szukaj,$order){
	$this->db->select("rejestr_u.id, nazwa_zakladu, kategoria_danych, data_zawarcia, data_wygas, nazwa_firmy, nr, umowa_posiada");
	$this->db->from("zaklady,rejestr_u");
	$this->db->where("rejestr_u.id_zaklad","zaklady.id",false);
  	if(strlen($szukaj['value']) > 0){
        $search = $this->db->escape_like_str($szukaj['value']);
        $this->db->where("(`nazwa_zakladu` LIKE '%$search%' OR `kategoria_danych` LIKE '%$search%' OR `nazwa_firmy` LIKE '%$search%')");
        }

    if($id_zaklad != 0)
    	$this->db->where("id_zaklad",$id_zaklad);
	$all=$this->db->count_all_results();

	$this->db->select("rejestr_u.id, nazwa_zakladu, kategoria_danych, data_zawarcia, data_wygas, nazwa_firmy, nr, umowa_posiada");
	$this->db->from("zaklady,rejestr_u");
	$this->db->where("rejestr_u.id_zaklad","zaklady.id",false);
	
    if(strlen($szukaj['value']) > 0){
		$search = $this->db->escape_like_str($szukaj['value']);
        $this->db->where("(`nazwa_zakladu` LIKE '%$search%' OR `kategoria_danych` LIKE '%$search%' OR `nazwa_firmy` LIKE '%$search%')");
    }

	if($id_zaklad != 0)
		$this->db->where("id_zaklad",$id_zaklad);
 	$order_type = $order[0]["dir"];
	$order_col = $order["columns"][$order[0]["column"]]["data"];
	if($order_col != "0")
		$this->db->order_by($order_col, $order_type);	

	$this->db->limit($ile,$start);
	$q=$this->db->get();

	 if(strlen($szukaj['value']) > 0){
		$filter = $all;
	 }
	 else {
		$filter = $all;
	 } 

	return $this->output
  			->set_content_type('application/json')
	        	->set_output(json_encode(array( "order_type" => $order_type, "order_col" => $order_col, "szukaj" => $szukaj,   "recordsTotal"=> $all,    "recordsFiltered"=> $filter, "data" => $q->result())));
}

function dodaj_u($id_zaklad,$nazwa_firmy,$kategoria,$data_zaw,$data_wyg,$umowa_p){
	$this->db->where("id_zaklad",$id_zaklad);
	$q=$this->db->get("rejestr_u");
	$row = $q->last_row();
	$nr = @intval($row->nr) + 1;

	$wpis = array( 'id' => NULL,
						'id_zaklad' => $id_zaklad,
						'nr' => $nr,
						'nazwa_firmy' => $nazwa_firmy,
						'kategoria_danych' => $kategoria,
						'data_zawarcia' => $data_zaw,
						'data_wygas' => $data_wyg,
						'umowa_posiada' => $umowa_p
					);
	$this->db->insert("rejestr_u",$wpis);

	zapisz_log($this->session->userdata("id"),33,"Firma: ".$nazwa_firmy.", data od-do: ".$data_zaw."-".$data_wyg."");	
	
	$this->db->cache_delete('rejestr_u','json');
	$this->db->cache_delete('rejestr_u','edytuj');
	$this->db->cache_delete('rejestr_u','index');
	$this->db->cache_delete('rejestr_u','zbiory');
	$this->db->cache_delete('rejestr_u_pdf','index');
	$this->db->cache_delete('api','giodo');
}


function usun_u($id,$zaklad)
{
	$this->db->where("id",$id);
	$this->db->delete("rejestr_u");

	$this->db->where("id_umowa",$id);
	$this->db->delete("rejestr_u_zbiory");

	$this->db->where("id_umowa",$id);
	$this->db->delete("rejestr_u_zbiory_zaw");

	zapisz_log($this->session->userdata("id"),48,"Umowa id: ".$id." zakład:".$zaklad."");	
	
	$this->db->cache_delete('rejestr_u','json');
	$this->db->cache_delete('rejestr_u','edytuj');
	$this->db->cache_delete('rejestr_u','index');
	$this->db->cache_delete('rejestr_u','zbiory');
	$this->db->cache_delete('rejestr_u_pdf','index');
	$this->db->cache_delete('api','giodo');
}

function publikuj_u($id,$zaklad)
{
	$wpis = array(
		"flaga" => 1
	);
	$this->db->where("id",$id);
	$this->db->update("rejestr_u",$wpis);

	zapisz_log($this->session->userdata("id"),49,"Umowa id: ".$id.", zakład:".$zaklad."");	
	
	$this->db->cache_delete('rejestr_u','json');
	$this->db->cache_delete('rejestr_u','edytuj');
	$this->db->cache_delete('rejestr_u','index');
	$this->db->cache_delete('rejestr_u','zbiory');
	$this->db->cache_delete('rejestr_u_pdf','index');
	$this->db->cache_delete('api','giodo');
}

function niepublikuj_u($id,$zaklad)
{
	$wpis = array(
		"flaga" => 0
	);
	$this->db->where("id",$id);
	$this->db->update("rejestr_u",$wpis);

	zapisz_log($this->session->userdata("id"),50,"Umowa id: ".$id.", zakład:".$zaklad."");	
	
	$this->db->cache_delete('rejestr_u','json');
	$this->db->cache_delete('rejestr_u','edytuj');
	$this->db->cache_delete('rejestr_u','index');
	$this->db->cache_delete('rejestr_u','zbiory');
	$this->db->cache_delete('rejestr_u_pdf','index');
	$this->db->cache_delete('api','giodo');
}

function zapisz_umowe($id_umowa,$id_zaklad,$dane){
	$wpis = array( 'nazwa_firmy' => $dane['nazwa_firmy'],
						'kategoria_danych' => $dane['cel_przetwarzania'],
						'data_zawarcia' => $dane['data_zawarcia'],
						'data_wygas' => $dane['data_wygas'],
						'umowa_posiada' => $dane['umowa_posiada'],
						'data_dokonania_wpisu' => $dane['data_wpisu'],
						'typ_aktualizacji' => $dane['typ_aktualizacji']
						);
						
	$this->db->where("id",$id_umowa);
	$this->db->update("rejestr_u",$wpis);


	zapisz_log($this->session->userdata("id"),44,"Firma: ".$dane['nazwa_firmy']."",$wpis);	
	
	$this->db->cache_delete('rejestr_u','json');
	$this->db->cache_delete('rejestr_u','edytuj');
	$this->db->cache_delete('rejestr_u','index');
	$this->db->cache_delete('rejestr_u','zbiory');
	$this->db->cache_delete('rejestr_u_pdf','index');
	$this->db->cache_delete('api','giodo');
}	

function usun_zbiory_zaw($id_umowa){
	$this->db->where("id_umowa",$id_umowa);
	$this->db->delete("rejestr_u_zbiory_zaw");
}

function zapisz_zbiory_zaw($id_umowa,$id_zbior,$zbior,$id){
	
	$this->db->where('id_umowa',$id_umowa);
	$this->db->where('id_zbior',$id_zbior);
	$wpis = array();
	$wpis["archiwizacja"] = 0;
	$wpis["odczyt"] = 0;
	$wpis["wprowadzanie"] = 0;
	$wpis["modyfikacja"] = 0;
	$wpis["usuwanie"] = 0;
	if(is_array($zbior))
	{		
	foreach($zbior as $item){
		switch($item){
				case "odczyt":
					$wpis["odczyt"] = 1;
					continue;
				case "wprowadzanie":
					$wpis["wprowadzanie"] = 1;
					continue;
				case "modyfikacja":					
					$wpis["modyfikacja"] = 1;
					continue;
				case "usuwanie":
					$wpis["usuwanie"] = 1;
					continue;
				case "archiwizacja":
					$wpis["archiwizacja"] = 1;
					continue;
		}
	}						}
	
	$this->db->update('rejestr_u_zbiory_zaw',$wpis);	
							
	zapisz_log($this->session->userdata("id"),47,"Id umowy: ".$id_umowa."",$wpis);	
	
	$this->db->cache_delete('rejestr_u','json');
	$this->db->cache_delete('rejestr_u','edytuj');
	$this->db->cache_delete('rejestr_u','index');
	$this->db->cache_delete('rejestr_u','zbiory');
	$this->db->cache_delete('rejestr_u_pdf','index');
	$this->db->cache_delete('api','giodo');
}	
		
function zapisz_ud($id,$id_zaklad,$dane){
	$wpis = array( "data" => $dane["data"],
						"podmiot" => $dane["podmiot"],
						"podstawa_prawna" => $dane["podstawa_prawna"],
						"zakres" => $dane["zakres"],
						"dane_osobowe" => $dane["dane_osobowe"],
						);
						
	$this->db->where("id",$id);
	$this->db->update("rejestr_ud",$wpis);


	zapisz_log($this->session->userdata("id"),46,"Zaklad: ".$dane['nazwa_firmy']."",$wpis);	
	
	$this->db->cache_delete('rejestry_ud','json');
	$this->db->cache_delete('rejestry_ud','edytuj');
	$this->db->cache_delete('rejestry_ud','index');
	$this->db->cache_delete('rejestry_ud_pdf','index');
	$this->db->cache_delete('api','giodo');
}	

function dodaj_zbior($id_zbior,$id_umowy){
	$wpis = array( 'id' => NULL,
						'id_umowa' => $id_umowy,
						'id_zbior' => $id_zbior
						);
	$this->db->insert("rejestr_u_zbiory",$wpis);
	
	$wpis = array( 'id' => $this->db->insert_id(),
						'id_umowa' => $id_umowy,
						'id_zbior' => $id_zbior,
						'odczyt' => 0,
						'wprowadzanie' => 0,
						'modyfikacja' => 0,
						'usuwanie' => 0,
						'archiwizacja' => 0
						);
	$this->db->insert("rejestr_u_zbiory_zaw",$wpis);

	//zapisz_log($this->session->userdata("id"),33,"Firma: ".$nazwa_firmy.", data od-do: ".$data_zaw."-".$data_wyg."");	
	
	$this->db->cache_delete('rejestr_u','json');
	$this->db->cache_delete('rejestr_u','index');
	$this->db->cache_delete('rejestr_u','edytuj');
	$this->db->cache_delete('rejestr_u','zbiory');
	$this->db->cache_delete('rejestr_u_pdf','index');
	$this->db->cache_delete('api','giodo');
}


function usun_zbiory($id,$id_zaklad,$zbiory){
	if(count($zbiory) == 0){
		$this->db->where("id_umowa",$id);
		$this->db->delete("rejestr_u_zbiory");
		$this->db->where("id_umowa",$id);
		$this->db->delete("rejestr_u_zbiory_zaw");
	}
	if(count($zbiory) > 0){
		$zbiory_nazwy = array();
		$this->db->where_in("nazwa",$zbiory);
		$this->db->where("id_zaklad",$id_zaklad);
		$q = $this->db->get("slowniki_zbiory");
		foreach($q->result() as $row){
			$zbiory_nazwy[] = $row->id;
		}
		
		$this->db->where_in("id_umowa",$id);
		$q = $this->db->get("rejestr_u_zbiory");
		$znalazlem = array();
		foreach($q->result() as $row){
			$znalazlem[] = $row->id_zbior;
		}
		
		$diff = array_diff($znalazlem,$zbiory_nazwy);
		$diff2 = array_diff($zbiory_nazwy,$znalazlem);
	   

		if(!empty($diff)){
			$this->db->where("id_umowa",$id);
			$this->db->where_in("id_zbior",$diff);
			$this->db->delete("rejestr_u_zbiory");
			$this->db->where("id_umowa",$id);
			$this->db->where_in("id_zbior",$diff);
			$this->db->delete("rejestr_u_zbiory_zaw");
		}
		if(!empty($diff2)){
			return $diff2;
		}
	}
		$wpis[] = array();
		@$wpis[] = $diff;
		@$wpis[] = $diff2;
		
		
		zapisz_log($this->session->userdata("id"),51,"ID: ".$id."",$wpis);
		
		$this->db->cache_delete('rejestr_u','json');
		$this->db->cache_delete('rejestr_u','index');
		$this->db->cache_delete('rejestr_u','edytuj');
		$this->db->cache_delete('rejestr_u','zbiory');
		$this->db->cache_delete('rejestr_u_pdf','index');
		$this->db->cache_delete('api','giodo');
}

function zmien_typ($id,$typ){
		$wpis = array( 'umowa_posiada' => $typ);
		$this->db->where("id",$id);
		$this->db->update("rejestr_u",$wpis);
		
		$this->db->cache_delete('rejestr_u','json');
		$this->db->cache_delete('rejestr_u','index');
		$this->db->cache_delete('rejestr_u','edytuj');
		$this->db->cache_delete('rejestr_u','zbiory');
		$this->db->cache_delete('rejestr_u_pdf','index');
		$this->db->cache_delete('api','giodo');
}
	
}
?>
