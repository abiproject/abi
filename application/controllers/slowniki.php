<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Slowniki extends CI_Controller {

public function __construct(){
     parent::__construct();
     check_perm($this->session->userdata("id"),$this->uri->segment(1));
	  $this->load->model(array("Zaklady_model","Slowniki_model","Zbiory_model"));
 	  $this->breadcrumbs->push('Zbiory i słowniki', '/slowniki/index');
  	  $this->breadcrumbs->unshift('Zakłady', site_url('admin/index'));			  			  
   }

public function json(){
	$data["perm"] = check_perm($this->session->userdata("id"),$this->uri->segment(1));
	
	if($this->uri->segment(4) > 0){
		$row = $this->Slowniki_model->wybierz_slownik($this->uri->segment(4));
	}
	$data["json"] = $this->Slowniki_model->pobierz_pozycje_json($row->nazwa_slownik,$this->session->userdata("zaklad"));
	
	$this->load->view("json",$data);	
}	

public function index(){
	$data["perm"] = check_perm($this->session->userdata("id"),$this->uri->segment(1));
	$this->breadcrumbs->push('Zbiory i słowniki', '/slowniki/index');
	$data_head["breadcrumbs"] = $this->breadcrumbs->show();
	
	$this->load->view('head',$data_head);
	$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
	$data["error"] = $this->session->flashdata("error");
	$data["msg"] = $this->session->flashdata("msg");
	
	if($this->uri->segment(3) == "update" && is_numeric($this->uri->segment(4)) )
	{
		$this->Slowniki_model->aktualizuj_pozycje($this->uri->segment(4),$this->uri->segment(5),$this->input->post("name"));
		$this->session->set_flashdata("msg","Zapisano zmiany!");
		redirect("slowniki/index/".$this->uri->segment(4)."","refresh");
	}
	
	if($this->uri->segment(3) == "usun" && is_numeric($this->uri->segment(4)))
		{
			check_perm($this->session->userdata("id"),$this->uri->segment(1),2);
			$ans = $this->Slowniki_model->usun_pozycje($this->uri->segment(4),$this->uri->segment(5));
			if($ans == "error")
				$this->session->set_flashdata("error","Błąd usuwania pozycji!");
			else
				$this->session->set_flashdata("msg","Usunięto pozycję!");
			redirect("slowniki/index/".$this->uri->segment(4)."","refresh");
		}		

	$this->form_validation->set_rules('name', 'Nazwa pozycji', 'require|min_length[2]');

	if($this->uri->segment(3) == "edytuj" && is_numeric($this->uri->segment(4)) && is_numeric($this->uri->segment(5))){	
		check_perm($this->session->userdata("id"),$this->uri->segment(1),2);
		$q=$this->Slowniki_model->element($this->uri->segment(4),$this->uri->segment(5));
		$data["row"] = $q->row_array();
		$data["id"] = $this->uri->segment(4);
		$this->load->view("slowniki/slo_edytuj",$data);
	}
	else{
		$q=$this->Slowniki_model->spis_slownikow();
		$data["zbiory_bez_zakresu"] = $this->Slowniki_model->spis_zbiory_bez_zakresu();
		$data["zbiory_bez_zab"] = $this->Slowniki_model->spis_zbiory_bez_zab();
		$data["row"] = $q->result_array();
		$data["show"] = 1;
		if(is_numeric($this->uri->segment(3))){
		$data["show"] = 0;
		}
		$this->load->view("slowniki/slo_lista",$data);
	}
	
	if(is_numeric($this->uri->segment(3))){
		$data["a"] = $this->uri->segment(3);
		$q = $this->Zaklady_model->spis_zakladow();
		$data["zaklady"] = $q->result_array();
	
	if($data["perm"] == 2){
		$this->load->view("slowniki/slo_dodaj",$data);
	}
			
		$row = $this->Slowniki_model->wybierz_slownik($this->uri->segment(3));
		$data["slownik_nazwa"] = $row->nazwa;
	if(!$row){
		$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg">Brak słownika!</div></div>';
	}
	else{
		$data["json_url"] = site_url("slowniki/json/filtr/".$this->uri->segment(3)."/".$this->session->userdata("zaklad")."");
		$this->load->view("slowniki/slo_spis_pozycji",$data);
	}					
	}
	$this->load->view("motyw_new",$data);
}

function dodaj(){
	if(strlen($this->input->post("name")) > 0){
		$this->Slowniki_model->dodaj_pozycje($this->input->post("name"),$this->input->post("zaklad"),$this->uri->segment(3));
		$this->session->set_flashdata("msg","Dodano nową pozycję!");

		redirect("slowniki/index/".$this->uri->segment(3)."","refresh");
	}
	else{
		$this->session->set_flashdata("error","Błąd dodawania nowej pozycji!");
	
		redirect("slowniki/index/".$this->uri->segment(3)."","refresh");
	}
}
}
?>
