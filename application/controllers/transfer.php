<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transfer extends CI_Controller {
	
public function __construct()
	{
		parent::__construct();
		check_perm($this->session->userdata("id"),$this->uri->segment(1));
		$this->load->model(array("Zaklady_model","Pracownicy_model","Slowniki_model","Zbiory_model","Transfer_model","Rejestry_model"));
      $this->breadcrumbs->push('Transfer z HD', 'transfer/index');
      $this->breadcrumbs->unshift('Zakłady', site_url('admin/index'));			  			  
	}
public function index()
		{
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();	
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
		
			$data["error"] = $this->session->flashdata("error");
			$data["msg"] = $this->session->flashdata("msg");
			
			
			$this->load->view("transfer/transfer_szukaj",$data);
			
			if($this->uri->segment(3) === "dodaj")
			{	
				$this->load->helper('file');
				
				$url = $this->input->post("url");
				$plik = './pliki/rej_u/'.$this->input->post("nazwa_pliku");
				$ssl_opts=array(
				    "ssl"=>array(
				        "verify_peer"=>false,
				        "verify_peer_name"=>false,
				    ),
				);  
				
				file_put_contents($plik, file_get_contents($url,false, stream_context_create($ssl_opts)));
				$rozmiar = get_file_info($plik, "size");
				$ext = pathinfo($plik, PATHINFO_EXTENSION);
				$id_hd = $this->input->post("id_hd");						
											
				$this->Rejestry_model->dodaj_ud($this->input->post("data"),$this->input->post("zaklad"),$this->input->post("podmiot"),$this->input->post("podstawa"),$this->input->post("zakres"),$this->input->post("dane"),$this->input->post("nazwa_pliku"),$rozmiar["size"]/1000,".".$ext,$id_hd);
				$this->session->set_flashdata("msg","Dodano nową pozycję w rejstrze!");
				redirect("rejestry_ud","refresh");
						
			}
			if($this->uri->segment(3) === "szukaj" && (int)$this->input->post("id_zgloszenia") > 0)
			{	
				$data["dane"] = $this->Transfer_model->pobierz_zgloszenie($this->input->post("id_zgloszenia"));							
				$data["plik"] = $this->Transfer_model->pobierz_zalacznik($this->input->post("id_zgloszenia"));
				$data["id_hd"] = $this->input->post("id_zgloszenia");
			
				$this->load->view("transfer/wynik_szukania",$data);
				
				$q = $this->Slowniki_model->pobierz_slownik("slowniki_miejsca",$this->session->userdata("zaklad"));
				$data["komorki"] = $q->result_array();
				$q=$this->Zaklady_model->spis_zakladow($this->session->userdata("zaklad"));
				$data["zaklady"] = $q->result_array();

				$this->load->view("transfer/rejud_dodaj",$data);
				
			}
			
			
			if($this->uri->segment(3) === "usun" && is_numeric($this->uri->segment(4)))
				{
					$ans = $this->Rejestry_model->usun_u($this->uri->segment(4),$this->session->userdata("zaklad"));
					if($ans == "error")
						$this->session->set_flashdata("error","Błąd usuwania pozycji!");
					else
						$this->session->set_flashdata("msg","Usunięto pozycję!");
					redirect("rejestr_u","refresh");
				}
				
			else
			{
			$data["a"] = $this->uri->segment(3);
			
			
			
				// if($q->num_rows() > 0)
// 				{
// 					$this->load->view("rejestry_u/reju_index",$data);
// 				}
// 				else
// 				{
// 					$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg">Brak wyników wyszukiwania</div></div>';
// 				}
						
				
					$this->load->view("motyw_new",$data);	
			}		
		
		}
}
?>