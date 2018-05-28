<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Start extends CI_Controller {
	
	public function index()
	{
		if(check_login() AND $this->uri->segment(2) != 'wyloguj')
			{
				header('Location: '.site_url('admin/index'));
			}
			else
			{
				header('Location: '.site_url('start/logowanie'));
			}	
	}
	
	public function logowanie()
	{
		$this->load->library("encrypt");
		$key = $this->config->item("encryption_key");

 		// $msg = 'akiermasz99';
//  		$encrypted_string = $this->encrypt->encode(md5($msg), $key);
//  		echo $encrypted_string."<br/>";
// 		die();
//$encrypted_string = "" //62ts2o93s1 
// 		$msg = $this->encrypt->decode($encrypted_string, $key);
// 		echo $msg."<br/>";
// 		//var_dump($this->config->item("encryption_key"));
// 		die("END");
		
		$this->load->helper('logacs');
		$this->load->model('Login_model');
		$data_head["tytul"] = "Upoważnienia - Logowanie";
		$data["url"] = site_url("start/rejestracja");
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert" id="errorMsg">', '</div>');
		$this->form_validation->set_rules('username', 'Użytkownik', 'required');
		$this->form_validation->set_rules('password', 'Hasło', 'required');
		
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('head',$data_head);
					$this->load->view('logowanie',$data);
					$this->load->view('motyw_new');

				}
					else
					{
					//logowanie
					$query = $this->Login_model->sprawdz_login($this->input->post('username'));
					if($query->num_rows() == 1)
					{
						$row = $query->row();
						if($this->encrypt->decode($row->haslo, $key) === md5($this->input->post('password')))
						{

						if($row->aktywne_konto == 0)
						{
							$this->load->view('head',$data_head);
							logi_access($this->input->post('username'),2);
							$data["msg"] = '<div id="error">Twoje konto jest zablokowane!<br/>Skontaktuj się z administratorem!</div>';
							$this->load->view('logowanie',$data);
							$this->load->view('motyw_new');

						}
						else
						{
						logi_access($this->input->post('username'),0);
						$this->session->set_userdata('login', $this->input->post('username'));
						$this->session->set_userdata('id',$row->id);
						$this->session->set_userdata('typ',md5($row->upr));
						$this->session->set_userdata('zaklad',($row->zaklad));
						$this->session->set_userdata('hash',md5(sha1($this->input->post('ussername').$row->id.$this->input->ip_address())));
						if($row->zmiana_hasla == 1)
						{

						$data["msg"] = '<div id="error">Twoje hasło wygasło!</div>';
						redirect('start/zmiana_hasla','refresh');

						}
							$this->db->cache_delete("adm","logowania");
							$this->db->cache_delete("admin","index");
							redirect('admin/index','refresh');
						}

					}
						else
							{
								$this->load->view('head',$data_head);
								logi_access($this->input->post('username'),1);
								$data["msg"] = '<div id="error">Błędny login lub hasło!</div>';
								$this->load->view('logowanie',$data);
								$this->load->view('motyw_new');

							}

					}
					else
					{
						$this->load->view('head',$data_head);
						logi_access($this->input->post('username'),1);
						$data["msg"] = ('<div id="error">Błędny login lub hasło!</div>');
						$this->load->view('logowanie',$data);
						$this->load->view('motyw_new');

					}
				}
	}
	
public function zmiana_hasla()
	{
		$this->load->model('Login_model');
		$this->load->library("encrypt");
		$key = $this->config->item("encryption_key");		
		$this->load->helper('logacs');
		
		$data_head["tytul"] = "";
		$data["url"] = site_url("start/rejestracja");
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert" id="errorMsg">', '</div>');
		$this->form_validation->set_rules('password', 'Hasło', 'required|md5');
		$this->form_validation->set_rules('password_n', 'Nowe Hasło', 'required|min_length[6]|md5');
		$this->form_validation->set_rules('password_n1', 'Powtórz Nowe Hasło', 'required|matches[password_n]|md5');
		$data["id"] = $this->session->userdata("id");
		$data["username"] = $this->session->userdata("login"); 
		
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('head',$data_head);
					$this->load->view('logowanie2',$data);
					$this->load->view('motyw_new');
				}
				else
				{
					$query = $this->Login_model->sprawdz_login($data["username"]);
					if($query->num_rows() == 1)
					{
						$row = $query->row();
						if($this->encrypt->decode($row->haslo, $key) === $this->input->post('password'))
						{	
				 			$haslo = $this->encrypt->encode($this->input->post("password_n"), $key);
							$this->Login_model->zmien_haslo($this->input->post("id"),$data["username"],$haslo);
							$this->session->set_flashdata("msg","Pomyślnie zmieniono hasło użytkownika!");
							redirect("/start","refresh");			
						}
					}
					$this->load->view('head',$data_head);
					$data["msg"] ="Aktualne hasło jest nieprawidłowe!";
					$this->load->view('logowanie2',$data);
					$this->load->view('motyw_new');	
				}
	}

public function wyloguj()
	{
		$this->session->sess_destroy();
		redirect("start","refresh");
	}
}