<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function zapisz_log($id,$stan,$parm,$rekord=NULL)
{
	$ci =& get_instance();
	if(is_array($rekord)){
		$rekord = json_encode($rekord);
	}  
	$dane = array(
		"id" => NULL,
		"data" => date("Y-m-d H:i:s"),
		"id_log" => $stan,
		"id_user" => $id,
		"parametr" => $parm,
		"rekord" => $rekord
	);

	$ci->db->insert("logi",$dane);
	$ci->db->cache_delete("adm","logi");
}
?>