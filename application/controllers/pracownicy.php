<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pracownicy extends CI_Controller {

public function __construct()
   {
	  parent::__construct();
     check_perm($this->session->userdata("id"),$this->uri->segment(1));
	  $this->load->model(array("Zaklady_model","Pracownicy_model"));
 	  $this->breadcrumbs->push('Pracownicy', '/pracownicy/index');
  	  $this->breadcrumbs->unshift('Zakłady', site_url('admin/index'));			  			  
   }

public function json()
		{
			if($this->uri->segment(3) === "filtr"  && $this->uri->segment(4) > 0 && $this->session->userdata("zaklad") == 0){
				$data["json"] = $this->Pracownicy_model->spis_pracownikow_json($this->uri->segment(4));
			}
			else{
				$data["json"] = $this->Pracownicy_model->spis_pracownikow_json($this->session->userdata("zaklad"));
			}
				$this->load->view("json",$data);	
		}	
		
public function index()
	{
			$this->breadcrumbs->push('Pracownicy', '/pracownicy/index');
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();
			
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			$data["perm"] = check_perm($this->session->userdata("id"),$this->uri->segment(1));
			
			$data["prac_bez_upo"] = $this->Pracownicy_model->spis_pracownikow_bez_upo();
		
		if($this->uri->segment(3) === "filtr" && $this->uri->segment(4) > 0 && $this->session->userdata("zaklad") == 0)
			{
				$q=$this->Pracownicy_model->spis_pracownikow($this->uri->segment(4));
				$data["prac_bez_upo"] = $this->Pracownicy_model->spis_pracownikow_bez_upo($this->uri->segment(4));
				$data["json_url"] = site_url("pracownicy/json/filtr/".$this->uri->segment(4)."");
			}
				else
			{
				$q=$this->Pracownicy_model->spis_pracownikow($this->session->userdata("zaklad"));
				$data["json_url"] = site_url("pracownicy/json/filtr/".$this->session->userdata("zaklad")."");
			}
			
			$data["rejestr"] = $q->result_array();
	
		if($this->uri->segment(3) == "usun" && is_numeric($this->uri->segment(4)) && $data["perm"] == 2)
		{
			$ans = $this->Pracownicy_model->usun_pracownika($this->uri->segment(4));
			if($ans == "error")
				$this->session->set_flashdata("error","Pracownik posiada już wystawione upoważnienia - nie można go usunąć!");
			else
				$this->session->set_flashdata("msg","Usunięto pracownika!");
			redirect('/pracownicy', 'refresh');
		}
		
		if($this->uri->segment(3) == "dez" && is_numeric($this->uri->segment(4)))
		{
			$ans = $this->Pracownicy_model->dez_prac($this->uri->segment(4));
			if($ans == "error")
				$this->session->set_flashdata("error","Pracownik nie został zdezaktywowany!");
			else
				$this->session->set_flashdata("msg","Pracownik został zdezaktywowany!");
			redirect('/pracownicy', 'refresh');
		}
		
		if($this->uri->segment(3) == "akt" && is_numeric($this->uri->segment(4)))
		{
			$ans = $this->Pracownicy_model->akt_prac($this->uri->segment(4));
			if($ans == "error")
				$this->session->set_flashdata("error","Pracownik nie został aktywowany!");
			else
				$this->session->set_flashdata("msg","Pracownik został aktywowany!");
			redirect('/pracownicy', 'refresh');
		}

		$data["error"] = $this->session->flashdata("error");
		$data["msg"] = $this->session->flashdata("msg");
		
		
		$q = $this->Zaklady_model->spis_zakladow($this->session->userdata("zaklad"));
		$data["zaklady"] = $q->result_array();
	
		
		if($data["perm"] == 2)
		{
			$this->load->view("pracownicy/pra_dodaj",$data);
		}		
		
		if($this->session->userdata("zaklad") == 0)
		{
			$this->load->view("pracownicy/pra_filtr",$data);
		}

		//$logi_suma = $this->Pracownicy_model->suma_pracownikow($this->session->userdata("zaklad"),$this->input->post("szukaj"));
		$this->load->view("pracownicy/pra_spis",$data);
		$this->load->view("motyw_new",$data);
	}

public function dodaj()
	{	
		if($this->input->post("name"))
		{
			$this->Pracownicy_model->dodaj_pracownika($this->input->post("name"),$this->input->post("plec"),$this->input->post("zaklad"));
			$this->session->set_flashdata("msg","Dodano nowego pracownika!");
			redirect("pracownicy/index","refresh");
		}
		else
			{
				$this->session->set_flashdata("error","Błąd dodawania nowego pracownika - brak imienia i nazwiska!");
				redirect("pracownicy/index","refresh");
			}
	}
public function edytuj()
	{
		$this->breadcrumbs->push('Edycja', '/pracownicy/edytuj');
		$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		
		$this->load->view('head',$data_head);
		$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
		check_perm($this->session->userdata("id"),$this->uri->segment(1),2);
		$this->breadcrumbs->push('Edycja', '/pracownicy/edytuj');
		$data_head["breadcrumbs"] = $this->breadcrumbs->show();
	

		$data["error"] = $this->session->flashdata("error");
		$data["msg"] = $this->session->flashdata("msg");
		
		$this->form_validation->set_rules('name', 'Imię i Nazwisko', 'required|min_length[6]');
		
		if(is_numeric($this->uri->segment(3)))
		{
			if($this->form_validation->run() == FALSE)
			{
			$q=$q=$this->Pracownicy_model->pobierz_pracownik_id($this->uri->segment(3));

			$data["pracownik"] = $q->row_array();
			if($data["pracownik"] == NULL)
			{
				redirect("pracownicy/index","refresh");
			}
			if(@$data["pracownik"]["id_zakladu"] == $this->session->userdata("zaklad") or $this->session->userdata("zaklad") == 0)
				{
					$q = $this->Zaklady_model->spis_zakladow($this->session->userdata("zaklad"));
					$data["zaklady"] = $q->result_array();

					$this->load->view("pracownicy/pra_edytuj",$data);
				}
				else
				{
					$this->load->view("err_perm");
					
				}
			}
			else
			{
				$this->Pracownicy_model->zapisz_pracownika($this->uri->segment(3),$this->input->post("name"),$this->input->post("plec"),$this->input->post("zaklad"));
				$this->session->set_flashdata("msg","Zapisano zmiany!");
				redirect("pracownicy/index","refresh");	
			}
				}
			$this->load->view("motyw_new",$data);	
	}
}
?>