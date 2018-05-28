<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Zaklady extends CI_Controller {

public function __construct()
	  {
	        parent::__construct();
	        check_perm($this->session->userdata("id"),$this->uri->segment(1));
			  $this->load->model(array("Zaklady_model"));

		  	  $this->breadcrumbs->unshift('Zakłady', site_url('admin/index'));	

	  }
	  
	  public function index()
	  				{
	  				 	  $this->breadcrumbs->push('Zarządzenie zakładami', '/zaklady/index');
	  					  $data_head["breadcrumbs"] = $this->breadcrumbs->show();
	  						$this->load->view('head',$data_head);
	  						$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
						
	  					if($this->uri->segment(3) == "usun" && is_numeric($this->uri->segment(4)))
	  					{
	  						$ans = $this->Zaklady_model->usun_zaklad($this->uri->segment(4));
	  						if($ans == "error")
	  							$this->session->set_userdata("error","Zakład posiada już pracowników - nie można go usunąć!");
	  						else
	  							$this->session->set_userdata("msg","Usunięto zakład!");
	  					}
	  					if($this->uri->segment(3) == "api_dodaj" && is_numeric($this->uri->segment(4)))
	  					{
	  						$ans = $this->Zaklady_model->dodaj_api($this->uri->segment(4));
	  						if($ans == "error")
	  							$this->session->set_userdata("error","Zakład posiada już swój klucz API - nie można go zmienić!");
	  						else
	  							$this->session->set_userdata("msg","Dodano klucz API dla zakładu!");
	  					}
			
	  					$data["error"] = $this->session->userdata("error");
	  					$this->session->unset_userdata('error');
	  					$data["msg"] = $this->session->userdata("msg");
	  					$this->session->unset_userdata('msg');
					
					
					
	  					$this->load->view("zaklady/zak_dodaj",$data);
				
	  					$this->load->library('pagination');
	  					$ile = 10;
	  						if($this->uri->segment(3))
	  						{
	  								$od = $this->uri->segment(3);
	  						}
	  						else
	  						{
	  							$od = 0;
	  						}
	  					$logi_suma = $this->Zaklady_model->suma_zakladow();
		
	  					$config['base_url'] = $this->config->item("pag_suffix").'/index.php/zaklady/index';
	  					$config['total_rows'] = $logi_suma;
	  					$config['per_page'] = $ile; 
	  					$config['full_tag_open'] = '<div class="pagination">Strona: ';
	  					$config['full_tag_close'] = '</div>';
	  					$config['last_link'] = 'Ostatnia';
	  					$config['first_link'] = 'Pierwsza';
	  					$this->pagination->initialize($config); 
	
	  					$q = $this->Zaklady_model->spis_zakladow();
	  					if($q->num_rows() > 0)
	  						{
	  							$data["zaklady"] = $q->result_array();
	  							$data['pagination'] = $this->pagination->create_links();							
	  							$a = $this->uri->segment(3);

	  							$this->load->view("zaklady/zak_spis",$data);
	  						}
	  								else
	  								{
	  									$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg">Brak wyników</div></div>';
	  								}		
	  						$this->load->view("motyw_new",$data);	
	  				}
	
public function abi()
				{
				 	  $this->breadcrumbs->push('Zarządzenie zakładami', '/zaklady/index');
					  $this->breadcrumbs->push('Zgłoszenie Powołania/Odwołania ABI', '/zaklady/abi');
					  $data_head["breadcrumbs"] = $this->breadcrumbs->show();
					  $this->load->view('head',$data_head);
					  $this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
						
					if($this->uri->segment(3) == "usun" && is_numeric($this->uri->segment(4)))
					{
						$ans = $this->Zaklady_model->usun_abi($this->uri->segment(4));
						if($ans == "error")
							$this->session->set_userdata("error","Nie można usunąć ABI!");
						else
							$this->session->set_userdata("msg","Usunięto ABI!");
						
						redirect("zaklady/index/","refresh");	
					}
					
					if($this->uri->segment(3) == "odwolaj" && is_numeric($this->uri->segment(4)))
					{
						$ans = $this->Zaklady_model->odwolaj_abi($this->uri->segment(4),$this->input->post("data_odwolania"),$this->input->post("przyczyna"));
						if($ans == "error")
							$this->session->set_userdata("error","Nie można odwołać ABI!");
						else
							$this->session->set_userdata("msg","Odwołano ABI - pobierz PDF!");

						redirect("zaklady/abi/".$this->input->post("uid"),"refresh");						
					}
					
			
					$data["error"] = $this->session->userdata("error");
					$this->session->unset_userdata('error');
					$data["msg"] = $this->session->userdata("msg");
					$this->session->unset_userdata('msg');
					
					
					
					//$this->load->view("zaklady/zak_dodaj",$data);
				
					$this->load->library('pagination');
					$ile = 10;
						if($this->uri->segment(4))
						{
								$od = $this->uri->segment(4);
						}
						else
						{
							$od = 0;
						}
					$logi_suma = $this->Zaklady_model->suma_zakladow();
		
					$config['base_url'] = $this->config->item("pag_suffix").'/index.php/zaklady/abi';
					$config['total_rows'] = $logi_suma;
					$config['per_page'] = $ile; 
					$config['full_tag_open'] = '<div class="pagination">Strona: ';
					$config['full_tag_close'] = '</div>';
					$config['last_link'] = 'Ostatnia';
					$config['first_link'] = 'Pierwsza';
					$this->pagination->initialize($config); 
	
					$q = $this->Zaklady_model->spis_abi((int)$this->uri->segment(3));
					if($q->num_rows() > 0)
						{
							$data["abi"] = $q->result_array();
							$q = $this->Zaklady_model->pobierz_zaklady($this->uri->segment(3));
							$data["zaklad"] = $q->result_array();
							$data['pagination'] = $this->pagination->create_links();							
							$a = $this->uri->segment(4);

							$this->load->view("zaklady/zak_spis_abi",$data);
						}
								else
								{
									$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg">Brak wyników</div></div>';
								}		
						$this->load->view("motyw_new",$data);	
						//$this->output->enable_profiler("TRUE");
				}
				
public function abi_dodaj()
	{
   $this->breadcrumbs->push('Zarządzenie zakładami', '/zaklady/index');
   $this->breadcrumbs->push('Zgłoszenie powołania ABI', '/zaklady/abi');
   $data_head["breadcrumbs"] = $this->breadcrumbs->show();
   $this->load->view('head',$data_head);
   $this->load->view("menu_admin",menu_acl($this->session->userdata("id")));	
	
	$this->form_validation->set_rules('imie_nazwisko', 'Imię i Nazwisko', 'required');
	$this->form_validation->set_rules('pesel', 'PESEL', 'required');
	$this->form_validation->set_rules('data', 'Data powołania', 'required');
	
	if(is_numeric($this->uri->segment(3)))
	{
			if($this->form_validation->run() == FALSE)
			{
				$q = $this->Zaklady_model->pobierz_zaklady((int)$this->uri->segment(3));
				$data["zaklad"] = $q->result_array();
				$data["id"] = $this->uri->segment(3);
				$this->load->view("zaklady/zak_abi_dodaj",$data);
			}
			else
			{
				$this->Zaklady_model->dodaj_abi($this->uri->segment(3),$this->input->post("imie_nazwisko"),$this->input->post("pesel"),$this->input->post("nazwa_dok"),$this->input->post("seria_dok"),$this->input->post("kulica"),$this->input->post("knr_domu"),$this->input->post("knr_lokalu"),$this->input->post("kkod"),$this->input->post("kmiasto"),$this->input->post("data"),$this->input->post("c1"),$this->input->post("c2"),$this->input->post("c3"),$this->input->post("c4"));
				$this->session->set_userdata("msg","Dodano zgłoszenie powołania ABI!");
				redirect("zaklady/index","refresh");	
			}	
		}
	$this->load->view("motyw_new",$data);	
}

public function dodaj()
				{
					if($this->input->post("name"))
					{
						$this->Zaklady_model->dodaj_zaklad($this->input->post("name"),$this->input->post("miasto"),$this->input->post("adres"),$this->input->post("nip"),$this->input->post("regon"));
						$this->session->set_userdata("msg","Dodano nowy zaklad!");
						redirect("zaklady/index","refresh");
					}
					else
						{
							$this->session->set_userdata("error","Błąd dodawania nowego zakładu!");
							redirect("zaklady/index","refresh");
						}
				}
				
						
public function edytuj()
		{
	 	   $this->breadcrumbs->push('Zarządzanie zakładami', '/zaklady/index');
		  $this->breadcrumbs->push('Edycja zakładu', '/zaklady/edytuj');
		  $data_head["breadcrumbs"] = $this->breadcrumbs->show();
	
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
	
			$data["error"] = $this->session->userdata("error");
			$data["msg"] = $this->session->userdata("msg");
			$sesja = array("msg" => '', "error"=> '');
			$this->session->unset_userdata($sesja);
			
			$this->form_validation->set_rules('nazwa_zakladu', 'Nazwa zakładu', 'required');
			$this->form_validation->set_rules('miasto', 'Miasto', 'required');
			$this->form_validation->set_rules('adres', 'Adres', 'required');
			$this->form_validation->set_rules('nip', 'NIP', 'required');
			$this->form_validation->set_rules('regon', 'REGON', 'required');
			
			if(is_numeric($this->uri->segment(3)))
			{
				if($this->form_validation->run() == FALSE)
				{
				$q=$this->Zaklady_model->pobierz_zaklady($this->uri->segment(3));
				$data["zaklad"] = $q->row_array();
				
				$this->load->view("zaklady/zak_edytuj",$data);
				}
				else
				{
					$this->Zaklady_model->zapisz_zaklad($this->uri->segment(3),$this->input->post("nazwa_zakladu"),$this->input->post("miasto"),$this->input->post("adres"),$this->input->post("nip"),$this->input->post('regon'));
					$this->session->set_userdata("msg","Zapisano zmiany!");
					redirect("zaklady/index","refresh");	
				}
					}
				$this->load->view("motyw_new",$data);	
		}
}
?>