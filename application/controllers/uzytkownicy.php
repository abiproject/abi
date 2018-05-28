<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Uzytkownicy
 *
 * @package Uzytkownicy uzytkownicy.php
 * @author Michal Terbert
 *
 */

class Uzytkownicy extends CI_Controller {

public function __construct()
	{
	    parent::__construct();
	    check_perm($this->session->userdata("id"),$this->uri->segment(1));
		 $this->breadcrumbs->unshift('Admin', site_url('adm/index') );
   }

public function index()
	{
		$this->load->model("User_model");
		$this->breadcrumbs->push('Użytkownicy', '/użytkownicy');
		$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		$this->load->view('head',$data_head);
		$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
		$data["perm"] = check_perm($this->session->userdata("id"),$this->uri->segment(1));
  
		if($this->uri->segment(3) == "usun" && is_numeric($this->uri->segment(4)) && isset($data["perm"]))
		{
			if($data["perm"] == 2)
			{
				$this->User_model->usun_uzytkownika($this->uri->segment(4));	
				$this->session->set_flashdata("msg","Usunięto użytkownika!");
			}
			else
				$this->session->set_flashdata("error","Brak uprawnień do usunięcia użytkownika!");
			redirect('/uzytkownicy', 'refresh');
		}
		if($this->uri->segment(3) == "haslo" && is_numeric($this->uri->segment(4)) && isset($data["perm"]))
		{
			if($data["perm"] == 2)
			{
				$this->load->library("encrypt");					
				$key = $this->config->item("encryption_key");
				$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
				$haslo = substr(str_shuffle($chars),0,8);
				$haslo_hash = $this->encrypt->encode(md5($haslo),$key);
				
				$ans = $this->User_model->nowe_haslo($this->uri->segment(4),$haslo_hash);	
				$this->session->set_flashdata("msg","Nowe hasło: $haslo");
			}
			else
				$this->session->set_flashdata("error","Brak uprawnień do zmiany hasła użytkownika!");
			redirect('/uzytkownicy', 'refresh');
		}
		
		if($this->uri->segment(3) == "zablokuj" && is_numeric($this->uri->segment(4)))
		{
			$ans = $this->User_model->zablokuj_uzytkownika($this->uri->segment(4));
			if($ans == "error")
				$this->session->set_flashdata("error","Użytkownik nie został zablokowany!");
			else
				$this->session->set_flashdata("msg","Użytkownik został zablokowany!");
			redirect('/uzytkownicy', 'refresh');
		}
		
		if($this->uri->segment(3) == "odblokuj" && is_numeric($this->uri->segment(4)))
		{
			$ans = $this->User_model->odblokuj_uzytkownika($this->uri->segment(4));
			if($ans == "error")
				$this->session->set_flashdata("error","Użytkownik nie został odblokowany!");
			else
				$this->session->set_flashdata("msg","Użytkownik został odblokowany!");
			redirect('/uzytkownicy', 'refresh');
		}
		
   
		$data["error"] = $this->session->flashdata("error");
		$data["msg"] = $this->session->flashdata("msg");
		$this->session->unset_userdata(array('error' => "", "msg" => ""));
		
		$this->load->view("uzytkownicy/szukaj",$data);		
		
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
		
		$this->form_validation->set_rules('name', 'Użytkownik', '');
			
			if ($this->form_validation->run() === TRUE)
			
			{	
				$q=$this->User_model->spis_uzytkownikow($this->input->post("name"),$od,$ile);
				$logi_suma = $this->User_model->suma_uzytkownikow($this->input->post("name"));
				
				$config['base_url'] =  $this->config->item("pag_suffix").'/index.php/uzytkownicy/index';
				$config['total_rows'] = $logi_suma;
				$config['per_page'] = $ile; 
				$config['full_tag_open'] = '<div class="pagination">Strona: ';
				$config['full_tag_close'] = '</div>';
				$config['last_link'] = 'Ostatnia';
				$config['first_link'] = 'Pierwsza';
				$this->pagination->initialize($config); 
				
					$data["wyszukiwanie"] = $this->input->post("name");
		
			if($q->num_rows() > 0)
			{
					$data['pagination'] = $this->pagination->create_links();	
					$data["uzytkownicy"] = $q->result_array();
					$this->load->view("uzytkownicy/spis",$data);
			}
			else
				{
					$data['error'] = 'Brak wyników wyszukiwania!';
					$this->load->view("uzytkownicy/spis_no",$data);
				}
			}	
				$this->load->view("motyw_new",$data);
				
		}	
		
public function nowy()
	{	
		$this->load->model(array("User_model","Zaklady_model"));
		$this->breadcrumbs->push('Użytkownicy','/uzytkownicy');
		$this->breadcrumbs->push('Nowy użytkownik', '/uzytkownicy/nowy');
		$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		$this->load->view('head',$data_head);

		$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
		
		$this->form_validation->set_rules('name', 'Imię i nazwisko', 'required|max_length[100]');
		$this->form_validation->set_rules('login', 'Login', 'required|min_length[6]|max_length[25]');	
		$this->form_validation->set_rules('haslo', 'Hasło', 'required|min_length[8]|alpha_numeric');	
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
		$this->form_validation->set_rules('typ', 'Typ konta');
		$this->form_validation->set_rules('zaklad','Zaklad pracy');
		
		$q=$this->User_model->spis_acl();
		foreach($q->result() as $row)
		{
			$this->form_validation->set_rules('acl'.$row->id, 'ACL');
		}
		
			if ($this->form_validation->run() === TRUE)
			{	
				$q = $this->User_model->uzytkownik_login($this->input->post("name"));
				if($q->num_rows == 0)
				{
					$this->load->library("encrypt");					
					$key = $this->config->item("encryption_key");
		 			$haslo = $this->encrypt->encode(md5($this->input->post("haslo")), $key);
					$this->User_model->dodaj_uzytkownika($this->input->post(),$haslo);
					$this->session->set_flashdata("msg","Dodano nowego użytkownika!");
					redirect("/uzytkownicy","refresh");			
				}
				else
				{
					$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg">Taki użytkownik istnieje już w bazie!</div></div>';
				}
			}
			else
			{
				$data["acl"] = $q->result_array();
				$q=$this->Zaklady_model->spis_zakladow();
				$data["zaklady"] = $q->result_array();
		
				$this->load->view("uzytkownicy/uzy_nowy",$data);
			}
		$this->load->view("motyw_new",$data);
	}		

public function acl()
	{	
		$this->load->model(array("User_model","Zaklady_model"));
		$this->breadcrumbs->push('Użytkownicy','/uzytkownicy');
		$this->breadcrumbs->push('Edycja uprawnień', '/uzytkownicy/acl');
		$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		$this->load->view('head',$data_head);
		$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
	
		if($this->input->post("id") !== FALSE)
			$user_id = $this->input->post("id");
		else
			$user_id = $this->uri->segment(3);

		if(is_numeric($user_id) && $user_id > 1)
		{
		
		$q = $this->User_model->uzytkownik_id($user_id);
		if($q->num_rows() > 0)
		{
			$row = $q->row();
			$data["dane"]["id"]		= $row->id;
			$data["dane"]["name"]   = $row->nazwa;
			$data["dane"]["login"]  = $row->login;
			$data["dane"]["typ"]    = $row->upr;
			$data["dane"]["zaklad"] = $row->zaklad;
			
			$q=$this->User_model->spis_acl();
			foreach($q->result() as $row)
			{
				$this->form_validation->set_rules('acl'.$row->id, 'ACL');
			}
			if ($this->form_validation->run() === TRUE)
				{	
					$this->User_model->edytuj_acl_uzytkownika($user_id,$this->input->post("name"),$this->input->post());
					$this->session->set_flashdata("msg","Zmieniono uprawnienia dla użytkownika <strong>".$this->input->post("name")."</strong>!");
					redirect("/uzytkownicy","refresh");
								
				}
			else
				{
				$data["szablon_acl"] = $q->result_array();
				$q=$this->Zaklady_model->spis_zakladow();
				$data["zaklady"] = $q->result_array();
				$q = $this->User_model->pobierz_acl($user_id);
				foreach($q->result() as $row)
					{
						$data["acl"][$row->acl] = $row->access_rw;
					}
				$this->load->view("uzytkownicy/uzy_acl",$data);
			}
		}
		else
			{
				$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg">Taki użytkownik nie istnieje w bazie!</div></div>';
			}
		}
		else
			{
				$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg">Taki użytkownik nie istnieje w bazie!</div></div>';
			}
		
		$this->load->view("motyw_new",$data);
	}
public function edytuj()
	{	
		$this->load->model(array("User_model","Zaklady_model"));
		$this->breadcrumbs->push('Użytkownicy','/uzytkownicy');
		$this->breadcrumbs->push('Edycja użytkownika', '/uzytkownicy/edytuj');
		$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		$this->load->view('head',$data_head);
		$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));

		if($this->input->post("id") !== FALSE)
			$user_id = $this->input->post("id");
		else
			$user_id = $this->uri->segment(3);

		if(is_numeric($user_id) && $user_id > 1)
		{
	
		$q = $this->User_model->uzytkownik_id($user_id);
		if($q->num_rows() > 0)
		{
			$row = $q->row();
			$data["dane"]["id"]		= $row->id;
			$data["dane"]["name"]   = $row->nazwa;
			$data["dane"]["login"]  = $row->login;
			$data["dane"]["email"]  = $row->email;
			
		
			$this->form_validation->set_rules('name', 'Imię i nazwisko', 'required|max_length[100]');
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
		
			if ($this->form_validation->run() === TRUE)
				{	
					$this->User_model->edytuj_uzytkownika($user_id,$this->input->post("name"),$this->input->post("email"));
					$this->session->set_flashdata("msg","Zmieniono ustawienia dla użytkownika <strong>".$this->input->post("name")."</strong>!");
					redirect("/uzytkownicy","refresh");
							
				}
			else
				{
				$this->load->view("uzytkownicy/uzy_edytuj",$data);
			}
		}
		else
			{
				$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg">Taki użytkownik nie istnieje w bazie!</div></div>';
			}
		}
		else
			{
				$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg">Taki użytkownik nie istnieje w bazie!</div></div>';
			}
	
		$this->load->view("motyw_new",$data);
	}		
}