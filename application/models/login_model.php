<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends Ci_Model
{
	function __construct()
	 {
		 parent::__construct();
	 }		

	function sprawdz_login($login)
	 {
		$this->db->cache_off();
		$this->db->where('login',$login);

		return $this->db->get('users');
	 }

	function zmien_haslo($id,$login,$nowe_haslo)
	 {
		$array = array(
			"haslo" 			=> $nowe_haslo,
			"zmiana_hasla" => 0
		);
		$this->db->where("id",$id);
		$this->db->where("login",$login);
		$this->db->update("users",$array);

		zapisz_log($this->session->userdata("id"),25,"Login: ".$login."");	
	 }
}
?>