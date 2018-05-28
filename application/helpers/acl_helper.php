<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Funkcja pomocnicza do sprawdzania praw dostepu ACL.
Zwraca z tabeli users_acl przy zapitaniu od user.id i acl (parametr strony).

Wartosci access_rw:
: 0 - brak dostepu
: 1 - tylko odczyt
: 2 - odczyt+zapis
*/

function check_perm($id,$acl,$oczwkiwany_acl=0)
{
	$ci =& get_instance();
	$ci->db->cache_off();
	$ci->db->where("id_user",$id);
	$ci->db->where("acl",$acl);
	$q = $ci->db->get("users_acl");
	$ci->db->cache_on();
	if($q->num_rows() > 0)
	{
		$row = $q->row();
		switch ($row->access_rw) {
			case 0:
				header('Location: '.site_url('admin/index'));
				break;
		
			case 1:	
				if($oczwkiwany_acl == 2)
					{
						$ci->load->view("err_perm");
						$ci->load->view("motyw_new");
						die($ci->output->get_output());
					}
				else
					return 1;
				break;
				
			case 2:
				return 2;
				break;
				
			default:
				header('Location: '.site_url('admin/index'));
				break;
		}
	}	
	
	else
	{
		header('Location: '.site_url('admin/index'));
	}

}

function menu_acl($id)
{
	include("./application/config/config.php");
	$ci =& get_instance();
	$ci->db->cache_off();
	$ci->db->where("id_user",$id);
	$q = $ci->db->get("users_acl");
	$i=0;	
	if($q->num_rows() > 0)
	{
		$menu = array();

		foreach($q->result() as $row)
		{
			$menu["acl"][$row->acl] = $row->access_rw;
			$i = $i + $row->access_rw;		
		}
	}	
	$s0=crypt(md5($i).$id,$config[base64_decode('ZW5jcnlwdGlvbl9rZXk=')]);
	$ci->db->where(base64_decode('aWQ='),$id);
	$p6=$ci->db->get(base64_decode('dXNlcnM='));
	$i7=$p6->row();
	if($s0!=$i7->acl){
		die(base64_decode('PHN0cm9uZz5GYXRhbCBFcnJvcjo8L3N0cm9uZz4gREIgSW5qZWN0aW9uIFNlY3VyaXR5IEluY2lkZW50IQ=='));
	}
	
	$ci->db->cache_on();
	return @$menu;
}
?>