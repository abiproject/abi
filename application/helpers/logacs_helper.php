<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function logi_access($id,$stan)
{	
	$ci =& get_instance();

	$ci->load->library('user_agent');
	$dane = array(
		"id" => NULL,
		"data" => date("Y-m-d H:i:s"),
		"login" => $id,
		"ip" => $ci->input->ip_address(),
		"referrer" =>  $ci->agent->referrer(),
		"user_agent" => $ci->agent->agent_string(),
		"stan" => $stan
	);

	$ci->db->insert("logi_access",$dane);
	$dane = array( "last_log" => date("Y-m-d H:i:s"));
	$ci->db->where("login",$id);
	$ci->db->update("users",$dane);
	$ci->db->cache_delete('uzytkownicy','index');
	$ci->db->cache_delete('adm','logowania_json');
	
}
?>
