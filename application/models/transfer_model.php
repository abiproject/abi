<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transfer_model extends CI_Model
{
 
function __construct(){
	 parent::__construct();
}		

function pobierz_zalacznik($id_zgloszenia){
   $hd = $this->load->database('hd', TRUE); 
	$hd->select("tid,filename");
	$hd->where("tid",$id_zgloszenia);
	$q = $hd->get("oo_attachments");		
	
	return $q->result();
}

function pobierz_zgloszenie($id_zgloszenia){
   $hd = $this->load->database('hd', TRUE); 
	$hd->select("id,user,short,description,create_date");
	$hd->where("id",$id_zgloszenia);
	$q = $hd->get("oo_tickets");		
	
	return $q->result();
}
 
	
}
?>