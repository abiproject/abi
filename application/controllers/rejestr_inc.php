<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rejestr_inc extends CI_Controller {
	
public function __construct()
	{
		parent::__construct();
		check_perm($this->session->userdata("id"),$this->uri->segment(1));
		$this->load->model(array("Zaklady_model","Pracownicy_model","Slowniki_model","Zbiory_model","Rejestry_model"));
      $this->breadcrumbs->push('Rejestry', 'rejestry/index');
      $this->breadcrumbs->unshift('Zakłady', site_url('admin/index'));			  			  
	}
public function index()
		{
	      $this->breadcrumbs->push('Rejestr incydentów', 'rejestr_inc/index');
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();	
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
		
			$data["error"] = $this->session->flashdata("error");
			$data["msg"] = $this->session->flashdata("msg");
			
			
			if($this->uri->segment(3) === "dodaj")
			{								
				$this->Rejestry_model->dodaj_inc($this->input->post("zaklad"),$this->input->post("data_wykrycia"),$this->input->post("opis"),$this->input->post("data_zgloszenia"),$this->input->post("opis_pr"));
				$this->session->set_flashdata("msg","<strong>OK!</strong> Dodano nową pozycję w rejstrze incydentów.");
				redirect("rejestr_inc","refresh");
			}
			
			if($this->uri->segment(3) === "usun" && is_numeric($this->uri->segment(4)))
				{
					$ans = $this->Rejestry_model->usun_inc($this->uri->segment(4),$this->session->userdata("zaklad"));
					if($ans == "error")
						$this->session->set_flashdata("error","<strong>Uwaga!</strong> Błąd usuwania pozycji.");
					else
						$this->session->set_flashdata("msg","<strong>OK!</strong> Pozycja została usunięta z rejestru.");
					redirect("rejestr_inc","refresh");
				}
				
			else
			{
			$data["a"] = $this->uri->segment(3);
			$q = $this->Slowniki_model->pobierz_slownik("slowniki_miejsca",$this->session->userdata("zaklad"));
			$data["komorki"] = $q->result_array();
			$q=$this->Zaklady_model->spis_zakladow($this->session->userdata("zaklad"));
			$data["zaklady"] = $q->result_array();	  
			$this->load->view("rejestry_inc/rejinc_dodaj",$data);
			$q=$this->Rejestry_model->pobierz_rej_inc($this->session->userdata("zaklad"));
			$data["rejestr"] = $q->result_array();
			
		
				if($q->num_rows() > 0)
				{
					$this->load->view("rejestry_inc/rejinc_index",$data);
				}
				else
				{
					$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg"><strong>Uwaga!</strong> Brak pozycji do wyświetlenia</div>';
				}
						
				
					$this->load->view("motyw_new",$data);	
			}		
		
		}
}
?>