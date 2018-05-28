<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function check_login()
{
	$ci =& get_instance();
	if($ci->session->userdata('hash'))
	{
		$sprawdz = $ci->session->userdata('mail').$ci->session->userdata('id').$ci->input->ip_address();
		$sprawdz = md5(sha1($sprawdz));
		if($ci->session->userdata('hash') == $sprawdz)
			return TRUE;
		else
			return FALSE;
	}
	else
		return FALSE;
}
?>