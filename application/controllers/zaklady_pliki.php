<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Zaklady_pliki extends CI_Controller {

public function __construct(){
	        parent::__construct();
	        check_perm($this->session->userdata("id"),$this->uri->segment(1));
			  $this->load->model(array("Zaklady_model"));

		  	  $this->breadcrumbs->unshift('Pliki dla zakładów', site_url('admin/index'));	

	  }
	  
public function json(){
		if($this->uri->segment(4) > 0 && $this->session->userdata("zaklad") == 0){
			$data["json"] = $this->Zaklady_model->spis_plikow_json($this->uri->segment(4));
		}
		else{
			$data["json"] = $this->Zaklady_model->spis_plikow_json($this->session->userdata("zaklad"));
		}
			$this->load->view("json",$data);	
	}	  
public function index(){
		$this->breadcrumbs->push('Zarządzenie plikami', '/zaklady_pliki/index');
		$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		$this->load->view('head',$data_head);
		$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));	
		$data["json_url"] = site_url("zaklady_pliki/json/".$this->uri->segment(4)."");	
		$config['upload_path'] = './pliki/zaklady/';
		$config['allowed_types'] = 'docx|pdf|jpg|tif|png|doc';
		$config['max_size']	= '16048';
		$config['encrypt_name'] = TRUE;
		
		$data["error"] = $this->session->flashdata("error");
		$data["msg"] = $this->session->flashdata("msg");		
				
		if($this->uri->segment(3) === "pobierz" && is_numeric($this->uri->segment(4)))
		{
			$this->load->helper('download');
			$row = $this->Zaklady_model->pobierz_plik($this->uri->segment(4),$this->session->userdata("zaklad"));
			
			if(isset($row->plik)){
			$data = file_get_contents("./pliki/zaklady/".$row->plik); 
			$name = 'Plik-id_'.$this->uri->segment(4).$row->plik_roz;
			force_download($name, $data);	
			}
			else{
				$this->session->set_flashdata("msg","Brak załączonego pliku!");
				redirect("zaklady_pliki","refresh");
			}
		}
		if($this->uri->segment(3) === "usun" && is_numeric($this->uri->segment(4)))
		{
			$row = $this->Zaklady_model->usun_plik($this->uri->segment(4),$this->session->userdata("zaklad"));
			$this->session->set_flashdata("msg","Plik został usunięty!");
			redirect("zaklady_pliki","refresh");
		}
			
		if($this->uri->segment(3) === "dodaj")
			{		
				$this->load->library('upload', $config);
				$this->upload->do_upload();
				if($this->upload->display_errors()){
					$this->session->set_flashdata("error",$this->upload->display_errors());
					redirect("zaklady_pliki","refresh");
				}
				else{
				$plik = $this->upload->data();
					if($plik["file_size"] > 0){
					$this->Zaklady_model->dodaj_plik($this->input->post("data"),$this->input->post("zaklad"),$this->input->post("nazwa_pliku"),$plik["file_name"],$plik["file_ext"],$plik["file_size"],$this->input->post("komentarz"),$this->session->userdata("id"));
					$this->session->set_flashdata("msg","Dodano nowy plik!");
					redirect("zaklady_pliki","refresh");
					}
					else{
						$this->session->set_flashdata("error","Brak załączonego pliku!");
						redirect("zaklady_pliki","refresh");
					}
				}
				

		}

		
		$q = $this->Zaklady_model->spis_zakladow();	

		if($q->num_rows() > 0)
			{
				$data["zaklady"] = $q->result_array();
				$this->load->view("zaklady_pliki/pliki_dodaj",$data);
				$this->load->view("zaklady_pliki/pliki_spis",$data);
			}
					else
					{
						$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg">Brak wyników</div></div>';
					}		
			$this->load->view("motyw_new",$data);	
	}
}
?>