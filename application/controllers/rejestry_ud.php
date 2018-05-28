<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rejestry_ud extends CI_Controller {
	
public function __construct()
	{
		parent::__construct();
		check_perm($this->session->userdata("id"),$this->uri->segment(1));
		$this->load->model(array("Zaklady_model","Pracownicy_model","Slowniki_model","Zbiory_model","Rejestry_model"));
      $this->breadcrumbs->push('Rejestry', 'rejestry/index');
      $this->breadcrumbs->unshift('Zakłady', site_url('admin/index'));			  			  
	}
public function json()
	{	
		if($this->input->post()){
		
		$order 	= $this->input->post('order');
		$order["columns"] 	= $this->input->post('columns'); // $order[0]['column'];

		if($this->uri->segment(3) === "filtr"  && $this->uri->segment(4) > 0 && $this->session->userdata("zaklad") == 0 && $this->input->post('length')){
			$data["json"] = $this->Rejestry_model->pobierz_rej_ud_json($this->uri->segment(4),$this->input->post('length'),$this->input->post('start'),$this->input->post('search'),$order);
		}
		else{
			$data["json"] = $this->Rejestry_model->pobierz_rej_ud_json($this->session->userdata("zaklad"),$this->input->post('length'),$this->input->post('start'),$this->input->post('search'),$order);
		}
#			$this->output->enable_profiler(TRUE);
			$this->load->view("json",$data);	
	}
	}	
	
public function index()
		{
			$data["perm"] = check_perm($this->session->userdata("id"),$this->uri->segment(1));
	      $this->breadcrumbs->push('Rejestr udostępnień danych', 'rejestry_ud/index');
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();	
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			
			$config['upload_path'] = './pliki/rej_u/';
			$config['allowed_types'] = 'docx|pdf|jpg|tif|png|doc';
			$config['max_size']	= '2048';
			$config['encrypt_name'] = TRUE;
		
			$data["error"] = $this->session->flashdata("error");
			$data["msg"] = $this->session->flashdata("msg");
			
			
			
			if($this->uri->segment(3) === "zalacznik" && is_numeric($this->uri->segment(4)))
			{
				$this->load->helper('download');
				$row = $this->Rejestry_model->zalacznik_ud($this->uri->segment(4),$this->session->userdata("zaklad"));
				
				$data = @file_get_contents("./pliki/rej_u/".$row->zalacznik); 
				$name = 'Zalacznik-id_'.$this->uri->segment(4).$row->zalacznik_typ;

				force_download($name, $data);
				
			}
			if($this->uri->segment(3) === "dodaj")
			{
				
				$this->load->library('upload', $config);
				$this->upload->do_upload();
				$plik = $this->upload->data();
						
				$this->Rejestry_model->dodaj_ud($this->input->post("data"),$this->input->post("zaklad"),$this->input->post("podmiot"),$this->input->post("podstawa"),$this->input->post("zakres"),$this->input->post("dane"),$plik["file_name"],$plik["file_size"],$plik["file_ext"],0);
				$this->session->set_flashdata("msg","Dodano nową pozycję w rejstrze!");
				redirect("rejestry_ud","refresh");
			}
			if($this->uri->segment(3) === "dodaj_zalacznik")
			{
				$this->load->library('upload', $config);
				$this->upload->do_upload();
				$plik = $this->upload->data();
				if($plik["file_size"] > 1){
					$this->Rejestry_model->dodaj_zalacznik($this->input->post("id"),$plik["file_name"],$plik["file_size"],$plik["file_ext"]);
					$this->session->set_flashdata("msg","Dodano nowy załącznik w rejstrze!");
				}
				else{
					$this->session->set_flashdata("msg","Wybrany plik jest za mały!");
				}
				redirect("rejestry_ud","refresh");
			}
			
			
			if($this->uri->segment(3) === "nie" && is_numeric($this->uri->segment(4)))
				{
					$this->Rejestry_model->rud_odmowa($this->uri->segment(4));
					$this->session->set_flashdata("msg","<strong>Zmionono status na</strong>: odmowa udostępnienia danych!");
					redirect("rejestry_ud","refresh");
				}
			if($this->uri->segment(3) === "tak" && is_numeric($this->uri->segment(4)))
				{
					$this->Rejestry_model->rud_akceptacja($this->uri->segment(4));
					$this->session->set_flashdata("msg","<strong>Zmionono status na</strong>: akceptacja udostępnienia danych!");
					redirect("rejestry_ud","refresh");
				}
				
			if($this->uri->segment(3) === "usun" && is_numeric($this->uri->segment(4)))
				{
					$ans = $this->Rejestry_model->usun_rud($this->uri->segment(4),$this->session->userdata("zaklad"));
					if($ans == "error")
						$this->session->set_flashdata("error","Błąd usuwania pozycji!");
					else
						$this->session->set_flashdata("msg","Usunięto pozycję!");
					redirect("rejestry_ud","refresh");
				}
				
			else
			{
			$data["a"] = $this->uri->segment(3);
			$q = $this->Slowniki_model->pobierz_slownik("slowniki_miejsca",$this->session->userdata("zaklad"));
			$data["komorki"] = $q->result_array();
			$q=$this->Zaklady_model->spis_zakladow($this->session->userdata("zaklad"));
			$data["zaklady"] = $q->result_array();	 
			
			if(@$data["perm"] === 2) 
			$this->load->view("rejestry_ud/rejud_dodaj",$data);
			
			if($this->uri->segment(3) === "filtr" && $this->uri->segment(4) > 0 && $this->session->userdata("zaklad") == 0)
			{
				$q=$this->Rejestry_model->pobierz_rej_ud($this->uri->segment(4));
				$data["json_url"] = site_url("rejestry_ud/json/filtr/".$this->uri->segment(4)."");
			}
				else
			{
				$q=$this->Rejestry_model->pobierz_rej_ud($this->session->userdata("zaklad"));
				$data["json_url"] = site_url("rejestry_ud/json/filtr/".$this->session->userdata("zaklad")."");
			}
			$data["rejestr"] = $q->result_array();
			
			if($this->session->userdata("zaklad") == 0){
				$this->load->view("rejestry_ud/rejud_filtr",$data);
			}
			
		
				if($q->num_rows() > 0)
				{		
					$this->load->view("rejestry_ud/rejud_index",$data);
				}
				else
				{
					$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg"><strong>Uwaga!</strong> Brak pozycji w rejestrze.</div></div>';
				}
						
				
					$this->load->view("motyw_new",$data);	
			}		
		
		}
		
public function edytuj()
				{
					$data["perm"] = check_perm($this->session->userdata("id"),$this->uri->segment(1));
			      $this->breadcrumbs->push('Rejestr udostępnień danych', 'rejestry_ud/index');
					$data_head["breadcrumbs"] = $this->breadcrumbs->show();	
					$this->load->view('head',$data_head);
					$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			
			
					$data["error"] = $this->session->flashdata("error");
					$data["msg"] = $this->session->flashdata("msg");
			
					if($this->uri->segment(3) === "update" && is_numeric($this->uri->segment(4)))
						{
							$save = array(
								"nazwa_firmy" => $this->input->post("nazwa_firmy"),
								"data" => $this->input->post("data"),
								"podmiot" => $this->input->post("podmiot"),
								"podstawa_prawna" => $this->input->post("podstawa_prawna"),
								"zakres" => $this->input->post("zakres"),
								"dane_osobowe" => $this->input->post("dane_osobowe"),
							);
								
							$ans = $this->Rejestry_model->zapisz_ud($this->input->post("id"),$this->input->post("id_zaklad"),$save);
						
							if($ans == "error")
								$this->session->set_flashdata("error","Błąd zmiany w pozycji!");
							else
								$this->session->set_flashdata("msg","Zmieniono pozycję!");
					
							redirect("rejestry_ud","refresh");
						}
			
					else if(is_numeric($this->uri->segment(3)))
					{
						$data["id"] = $this->uri->segment(3); //id_rejestru
						$data["row"] = $this->Rejestry_model->pobierz_rej_ud_by_id($data["id"]);
						
						if($data["perm"] === 2){ 
						$this->load->view("rejestry_ud/rejud_edytuj",$data);
						}
					}
					else
						{
								redirect("rejestry_ud","refresh");
						}
						
				
						$this->load->view("motyw_new",$data);	
				}
}
?>
