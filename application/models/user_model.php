<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User_model 
 *
 * @category 	Obsluga kont uzytkownikow 
 * @package 	CodeIgniter user_model.php
 * @author 		Michal Terbert
 * @version 	2014-11-07
*/

/**
 * @property suma_uzytkownikow   		Suma uzytkownikow z LIKE po nazwie i loginie
 * @property spis_uzytkownikow   		Spis uzytkownikow z LIKE po nazwie i loginie
 * @property uzytkownik_id       		Pobranie uzytwkonika po ID
 * @property uzytkownik_pokaz_nazwe		Pobierz nazwe uzytkownika po id
 * @property uzytkownik_ostatnie_log	Pobierz ostatnie logowanie uzytkownika
 * @property uzytkownik_login				Pobranie uzytkownika po loginie
 * @property uzytkownik_login_id 		Pobranie ID uzytkownika po loginie
 * @property uzytkownik_perm     		Pobranie ACL uzytkownika po ID
 * @property spis_acl            		Pobranie szablonu ACL
 * @property dodaj_uzytkownika   		Dodanie nowego uzytkownika
 * @property nowe_haslo          		Zmiana hasla dla uzytkownika
 * @property usun_uzytkownika    		Usuniecie uzytkownika
 * @property zablokuj_uzytkownika		Blokada uzytkownika (brak mozliwosci zalogowania do aplikacji)
 * @property odblokuj_uzytkownika		Zdjecie blokady uzytkownika
 * @property pobierz_acl					Pobranie uprawnien uzytkownika
 */


class User_model extends CI_Model
{
function __construct()
    {
        parent::__construct();
    }		
			 
function suma_uzytkownikow($nazwa=0)
 	{
 		if(strlen($nazwa) > 2)
		{
			$this->db->like("nazwa",$nazwa);
			$this->db->or_like("login",$nazwa);
		}
 	
		return $this->db->count_all_results('users');
	}
	
function spis_uzytkownikow($nazwa=0,$od,$ile)
	{
		if(strlen($nazwa) > 2)
		{
			$this->db->like("nazwa",$nazwa);
			$this->db->or_like("login",$nazwa);			
		}
		$this->db->limit($ile,$od);
		$this->db->order_by("nazwa","ASC");
		
		return $this->db->get("users");
	}
	
function uzytkownik_id($id)
	{
		$this->db->where("id",$id);
		
		return $this->db->get("users");
	}
	
function uzytkownik_pokaz_nazwe($id)
	{
		$this->db->where("id",$id);
		$q = $this->db->get("users");
		$row = $q->row();

		return $row->nazwa;
	}
	
function uzytkownik_ostatnie_log($id)
	{
		$this->db->cache_off();
		$this->db->where("id",$id);
		$q = $this->db->get("users");
		$row = $q->row();

		return $row->last_log;
	}

function uzytkownik_login($login)
	{
		$this->db->where("login",$login);
		
		return $this->db->get("users");
	}
		
function uzytkownik_login_id($login)
	{
		$this->db->cache_off();
		$this->db->where("login",$login);
		$q = $this->db->get("users");
		$row = $q->row();
		
		return $row->id;
	}

function uzytkownik_perm($id)
	{
		$this->db->select("upr");
		$this->db->where("id",$id);
		
		return $this->db->get("users");
	}
	
function spis_acl()
	{
		return $this->db->get("users_acl_szablon");
	}

function dodaj_uzytkownika($tablica,$haslo)
	{
		$r = array(
			'id'            => NULL,
			'nazwa'         => $tablica["name"],
			'email'         => $tablica["email"],
			'login'         => $tablica["login"],
			'haslo'         => $haslo,
			'zmiana_hasla'  => 1,
			'last_log'      => NULL,
			'upr'           => $tablica["typ"],
			'aktywne_konto' => 1,
			'zaklad'        => $tablica["zaklad"]
		);
		
			
		$this->db->insert("users",$r);
		
		$id_user = $this->User_model->uzytkownik_login_id($tablica["login"]);
		
		if($id_user !== 0)
		{	
		$q = $this->User_model->spis_acl();
		foreach($q->result() as $i => $row)
		{
			if(isset($tablica["acl".$row->id][1]))
				$access_rw = 2;
			else
				{
			if(isset($tablica["acl".$row->id][0]))
				$access_rw = 1;
			else
				$access_rw = 0;
			}
			
			$rekord[$i] = array(
				"id" 			=> NULL,
				"id_user"	=> $id_user,
				"acl" 		=> $row->modul,
				"access_rw" => $access_rw
			);
			
			
		}
		$this->db->insert_batch('users_acl',$rekord);	
		}
		
		zapisz_log($this->session->userdata("id"),24,$tablica["name"]." / ".$tablica["login"]."");
		$this->db->cache_delete('uzytkownicy','index');		
		
		$this->db->select_max('id');
		$result= $this->db->get('users')->row_array();
		return $result['id'];
		
	}
	
function nowe_haslo($id,$hash)
	{
		$wpis = array( 'haslo' => $hash,
							'zmiana_hasla' => 1);
		$this->db->where('id', $id);
		$this->db->update('users',$wpis);
		$nazwa = $this->uzytkownik_pokaz_nazwe($id);
		
		zapisz_log($this->session->userdata("id"),19,"".$nazwa."");
		$this->db->cache_delete('uzytkownicy','index');
	}
	
function usun_uzytkownika($id)
	{
		$nazwa = $this->uzytkownik_pokaz_nazwe($id);
		
		$this->db->where('id',$id);
		$this->db->delete('users');
		$this->db->where('id_user',$id);
		$this->db->delete('users_acl');
		
		zapisz_log($this->session->userdata("id"),20,"Id: ".$id." / ".$nazwa);
		$this->db->cache_delete('uzytkownicy','index');			
	}
	
function zablokuj_uzytkownika($id)
	{
		$nazwa = $this->uzytkownik_pokaz_nazwe($id);
		
		$wpis = array( 'aktywne_konto' => 0);
		$this->db->where('id', $id);
		$this->db->update('users',$wpis);
		
		zapisz_log($this->session->userdata("id"),21,"Id: ".$id." / ".$nazwa);
		$this->db->cache_delete('uzytkownicy','index');		
	}
	
function odblokuj_uzytkownika($id)
	{
		$nazwa = $this->uzytkownik_pokaz_nazwe($id);
		
		$wpis = array( 'aktywne_konto' => 1);
		$this->db->where('id', $id);
		$this->db->update('users',$wpis);
		
		zapisz_log($this->session->userdata("id"),22,"Id: ".$id." / ".$nazwa);
		$this->db->cache_delete('uzytkownicy','index');		
	}

function pobierz_acl($id)
	{
		$this->db->cache_off();
		$this->db->where('id_user',$id);

		return $this->db->get('users_acl');
	}	
	
// function edytuj_acl_uzytkownika($id,$name,$tablica)
	// {
		// $r = array(
			// 'upr'           => $tablica["typ"],
			// 'zaklad'        => $tablica["zaklad"]
		// );
	
		// $this->db->where("id",$id);
		// $this->db->update("users",$r);
		
		// $this->db->where("id_user",$id);
		// $this->db->delete("users_acl");
		
		// $q = $this->User_model->spis_acl();
		// $z = 0;
		// foreach($q->result() as $i => $row)
		// {
			// if(isset($tablica["acl".$row->id][1]))
				// $access_rw = 2;
			// else
				// {
			// if(isset($tablica["acl".$row->id][0]))
				// $access_rw = 1;
			// else
				// $access_rw = 0;
			// }
		
			// $rekord[$i] = array(
				// "id" 			=> NULL,
				// "id_user"	=> $id,
				// "acl" 		=> $row->modul,
				// "access_rw" => $access_rw
			// );
			
			// $z = $z + $access_rw;
		// }
		// $this->db->insert_batch('users_acl',$rekord);	
		
		// $acl_s = crypt(md5($z).$id,$this->config->item("encryption_key"));
		// $acl = array ( "acl" => $acl_s );
		// $this->db->where("id",$id);
		// $this->db->update("users",$acl);
	
		// zapisz_log($this->session->userdata("id"),23,"".$name."",$rekord);
		// $this->db->cache_delete_all();		
	// }
function dodaj_acll($id, $acll)
{
		$r = array(
			'acl'           => $acll
		);

		echo $id.'<br>';
		
		$this->db->where("id",$id);
		$this->db->update("users",$r);
		zapisz_log($this->session->userdata("id"),23,"Acl: ".$acll."");
		$this->db->cache_delete('uzytkownicy','index');
}



function edytuj_uzytkownika($id,$name,$email)
	{
		$r = array(
			'nazwa'           => $name,
			'email'        	=> $email
		);

		$this->db->where("id",$id);
		$this->db->update("users",$r);

		zapisz_log($this->session->userdata("id"),23,"Nazwisko: ".$name."");
		$this->db->cache_delete('uzytkownicy','index');
	}
	
function uzytkownicy_zalogowani(){
	$this->db->select("user_data");
	$this->db->from("sesje");
	
	$q = $this->db->get();
	
	return $q->result_array();
}
}
?>
