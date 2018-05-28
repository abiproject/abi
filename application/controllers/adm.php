<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adm extends CI_Controller {

public function __construct(){
      parent::__construct();
      check_perm($this->session->userdata("id"),$this->uri->segment(1));
		$this->breadcrumbs->unshift('Admin', site_url('adm/index'));		
		$this->load->model("Adm_model");	  
		$this->load->library('pagination');
   }

public function index(){
		$this->load->view('head',$data_head);
		$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
		$this->load->view("admin_index");	
		$this->load->view("motyw_new");	
	}

public function logi_json(){		
	$data["json"] = $this->Adm_model->pobierz_zdarzenia_json();
	$this->load->view("json",$data);	
	}

public function logi(){		
	$this->breadcrumbs->push('Logi zdarzeń', '/adm/logi');
	$data_head["breadcrumbs"] = $this->breadcrumbs->show();
	$data["json_url"] = site_url("adm/logi_json");
						
	$this->load->view('head',$data_head);
	$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
	$this->load->view("adm/spis",$data);	
	$this->load->view("motyw_new",$data);
	}
	
public function logowania_json(){		
	$data["json"] = $this->Adm_model->pobierz_logowania_json();
	$this->load->view("json",$data);	
	}
	
public function logowania(){		
	$this->breadcrumbs->push('Historia logowań', '/adm/logowania');
	$data_head["breadcrumbs"] = $this->breadcrumbs->show();
	$data["json_url"] = site_url("adm/logowania_json");
				
	$this->load->view('head',$data_head);
	$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
	$this->load->view("adm/spis_logowan",$data);		
	$this->load->view("motyw_new",$data);
	}


public function stat(){
		$this->load->model(array("Zaklady_model","Upo_model","Pracownicy_model"));
		$this->breadcrumbs->push('Statystyki', '/adm/stat');
		$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		$this->load->view('head',$data_head);
		$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
		
		$q = $this->Zaklady_model->pobierz_zaklady($this->session->userdata("zaklad"));
		foreach($q->result() as $row)
		{
			$data["z"][$row->id]["suma_upo"] = $this->Upo_model->suma_upo_nazwisko("",$row->id,0);
			$data["z"][$row->id]["suma_upo_aktualnych"] = $this->Upo_model->suma_upo_nazwisko("",$row->id,1,0);								
			$data["z"][$row->id]["suma_upo_wygasajacych"] = $this->Upo_model->suma_upo_nazwisko("",$row->id,0,1);								
			$data["z"][$row->id]["suma_pracownikow"] = $this->Pracownicy_model->suma_pracownikow($row->id); 
			$data["z"][$row->id]["nazwa"] = $row->nazwa_zakladu;
		}
		$data["logi"] = $this->Adm_model->pobierz_logowania_miesiac(date("m"));
		$data["zdarzenia"] = $this->Adm_model->pobierz_zdarzenia_miesiac(date("m"));
		
		$this->load->view("adm/stat",$data);		
		$this->load->view("motyw_new",$data);
	}
}
?>