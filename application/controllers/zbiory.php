<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Zbiory extends CI_Controller {

public function __construct()
   {
     parent::__construct();
     check_perm($this->session->userdata("id"),$this->uri->segment(1));
	  $this->load->model(array("Zaklady_model","Slowniki_model","Zbiory_model"));
 	  $this->breadcrumbs->push('Wykaz zbiorów', '/zbiory/index');
  	  $this->breadcrumbs->unshift('Zakłady', site_url('admin/index'));			  			  
	  
    }
public function index()
	{		
		

		$this->form_validation->set_rules('zaklad', 'Zaklad', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			$q = $this->Zaklady_model->spis_zakladow($this->session->userdata("zaklad"));
			$data["row"] = $q->result_array();
			$this->load->view("zbiory/zbi_zaklad.php",$data);
			$this->load->view("zbiory/zbi_zaklad2.php",$data);		
		}
		else
			{	
				$this->breadcrumbs->push('Opis struktury zbiorów danych', '/zbiory/index2/');
				$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		
				$this->load->view('head',$data_head);
				$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
				$q = $this->Zaklady_model->spis_zakladow($this->session->userdata("zaklad"));
				$data["row"] = $q->result_array();
				$this->load->view("zbiory/zbi_zaklad.php",$data);
				$id_zaklad = $this->input->post("zaklad");
				$row = $this->Slowniki_model->nazwa_slownik_id("slowniki_zbiory");
				$data["slownik_id"] = $row;			
				$q = $this->Zbiory_model->pobierz_zbiory_z_zakladu($id_zaklad);
			   $data["zbiory"] = $q->result_array();
				$data["zaklad_id"] = $this->input->post('zaklad');
				$this->load->view("zbiory/zbi_spis.php",$data);
			}
		$this->load->view("motyw_new",$data);
	}
				
public function index_zab()
			{		
		   	$this->breadcrumbs->push('Zabezpieczenia zbiorów danych', '/zbiory/index_zab');
				$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		
					$this->load->view('head',$data_head);
					$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));

					$this->form_validation->set_rules('zaklad', 'Zaklad', 'required');
					if($this->form_validation->run() == FALSE)
					{
						$q = $this->Zaklady_model->spis_zakladow($this->session->userdata("zaklad"));
						$data["row"] = $q->result_array();
						$this->load->view("zbiory/zbi_zaklad2.php",$data);
					}
					else
						{	
						$q = $this->Zaklady_model->spis_zakladow($this->session->userdata("zaklad"));
							$data["row"] = $q->result_array();
							$this->load->view("zbiory/zbi_zaklad2.php",$data);
							$id_zaklad = $this->input->post("zaklad");
							$row = $this->Slowniki_model->nazwa_slownik_id("slowniki_zbiory");
							$data["slownik_id"] = $row;			
							$q = $this->Zbiory_model->pobierz_zbiory_zab_z_zakladu($id_zaklad);
						   $data["zbiory"] = $q->result_array();
							$this->load->view("zbiory/zbi_spis_zab.php",$data);
				
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
							$this->session->set_userdata("error","Błąd dodawania nowego pracownika - brak imienia oraz nazwiska!");
							redirect("zaklady/index","refresh");
						}
				}
public function edytuj()
		{						
	   	$this->breadcrumbs->push('Modyfikacja zakresu gromadzonych danych', '/zbiory/edytuj');
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		
	  	  	$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			check_perm($this->session->userdata("id"),$this->uri->segment(1),2);
			
			$data["error"] = $this->session->userdata("error");
			$this->session->unset_userdata('error');
			$data["msg"] = $this->session->userdata("msg");
			$this->session->unset_userdata('msg');

			$this->form_validation->set_rules('textbox1', 'Gromadzone dane', 'required');
			
			if(is_numeric($this->uri->segment(3)))
			{
				$data["id"] = $this->uri->segment(3);
				$data["a"] = (int)$this->uri->segment(4);
				$q = $this->Zbiory_model->pobierz_slownik_zbiory_id($this->uri->segment(3));
				$data["id_zaklad"] = $q["id_zaklad"];
				$data["nazwa_zbioru"] = $q["nazwa"];
				
				if($q == FALSE)
					{
					redirect("slowniki/index","refresh");	
					}
				else
				{
				if($this->form_validation->run() == FALSE)
				{
				
				
				$q = $this->Zbiory_model->pobierz_zbiory($this->uri->segment(3));

				$data["zbiory"] = $q->result_array();
				$data["suma_rekordow"] = count($data["zbiory"]) + 1;
				$this->load->view("zbiory/zbi_edytuj",$data);
				}
				else
				{
					foreach($this->input->post() as $key=>$row)
					{
						if(strpos($key,"textbox") !== false)
						{
							$dane[] = $row;
						}
					}
					$this->Zbiory_model->zapisz_dane($this->uri->segment(3),$data["id_zaklad"],$dane);
					$this->session->set_userdata("msg","Zapisano zmiany gromadzonych danych w zbiorze!");
					$back = $this->uri->segment(4);
					if($back == NULL)
						$back = 1;
					redirect("slowniki/index/".$back."","refresh");	
				}
					}
				}
			
				$this->load->view("motyw_new",$data);	
		}
		
public function edit_opis()
		{						
	   	$this->breadcrumbs->push('Modyfikacja opisu zbioru danych', '/zbiory/edit_opis');
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();

	  	  	$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			check_perm($this->session->userdata("id"),$this->uri->segment(1),2);
	
			$data["error"] = $this->session->userdata("error");
			$this->session->unset_userdata('error');
			$data["msg"] = $this->session->userdata("msg");
			$this->session->unset_userdata('msg');

			$this->form_validation->set_rules('id_zbior', '', 'required');
			
			if(is_numeric($this->uri->segment(3)))
			{
				$data["id"] = $this->uri->segment(3);
				$data["a"] = (int)$this->uri->segment(4);
				$q = $this->Zbiory_model->pobierz_zbior_id($this->uri->segment(3));
				$data["id_zaklad"] = $q->id_zaklad;
				$data["nazwa_zbioru"] = $q->nazwa;
		
				if($q == FALSE)
					{
					redirect("slowniki/index","refresh");	
					}
				else
				{
				if($this->form_validation->run() == FALSE)
				{
				$data["dane"] = $q;
				$this->load->view("zbiory/zbi_edytuj_opis",$data);
				}
				else
				{
					$this->Zbiory_model->zapisz_mod_zbioru($this->uri->segment(3),$this->input->post('opis_kat_osob'),$this->input->post('sposob_zbierania_dan'),$this->input->post('kat_odbiorcow'),$this->input->post('ew_przekaz_danych'));
					$this->session->set_userdata("msg","Zapisano zmiany w zbiorze!");
					$back = $this->uri->segment(4);
					if($back == NULL)
						$back = 1;
					redirect("slowniki/index/".$back."","refresh");	
				}
					}
				}
	
				$this->load->view("motyw_new",$data);	
		}
		
public function publikuj()
				{						
					if(is_numeric($this->uri->segment(3)))
					{
							$data["id"] = $this->uri->segment(3);
							$data["a"] = (int)$this->uri->segment(4);
							$q = $this->Zbiory_model->pobierz_slownik_zbiory_id($this->uri->segment(3));
							$data["id_zaklad"] = $q["id_zaklad"];
							$this->Zbiory_model->publikuj_zbior($this->uri->segment(3),$data["id_zaklad"]);
							$this->session->set_userdata("msg","Zapisano zmiany!");
							$back = $this->uri->segment(4);
							redirect("slowniki/index/".$back."","refresh");	
					}
		}

public function niepublikuj()
				{						
					if(is_numeric($this->uri->segment(3)))
					{
							$data["id"] = $this->uri->segment(3);
							$data["a"] = (int)$this->uri->segment(4);
							$q = $this->Zbiory_model->pobierz_slownik_zbiory_id($this->uri->segment(3));
							$data["id_zaklad"] = $q["id_zaklad"];
							$this->Zbiory_model->niepublikuj_zbior($this->uri->segment(3),$data["id_zaklad"]);
							$this->session->set_userdata("msg","Zapisano zmiany!");
							$back = $this->uri->segment(4);
							redirect("slowniki/index/".$back."","refresh");	
					}
		}
		
public function edytuj_zab()
		{						
	   	$this->breadcrumbs->push('Modyfikacja zabezpieczenia zbioru danych', '/zbiory/edytuj_zab');
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			check_perm($this->session->userdata("id"),$this->uri->segment(1),2);
	
			$data["error"] = $this->session->userdata("error");
			$this->session->unset_userdata('error');
			$data["msg"] = $this->session->userdata("msg");
			$this->session->unset_userdata('msg');

			$this->form_validation->set_rules('bazadanych', 'Baza danych', 'required');
	
			if(is_numeric($this->uri->segment(3)))
			{
				$data["id"] = $this->uri->segment(3);
				$data["a"] = (int)$this->uri->segment(4);
				$q = $this->Zbiory_model->pobierz_slownik_zbiory_id($this->uri->segment(3));
				$data["id_zaklad"] = $q["id_zaklad"];
				$data["nazwa_zbioru"] = $q["nazwa"];
		
				if($q == FALSE)
					{
					redirect("slowniki/index","refresh");	
					}
				else
				{
				if($this->form_validation->run() == FALSE)
				{
				$q = $this->Zbiory_model->pobierz_zbiory_zab($this->uri->segment(3));
				$data["zbiory"] = $q->row_array();

				$this->load->view("zbiory/zbi_edytuj_zab",$data);
				}
				else
				{
					$dane = $this->input->post();
					$this->Zbiory_model->zapisz_dane_zab($this->uri->segment(3),$data["id_zaklad"],$dane);
					$this->session->set_userdata("msg","Zapisano zmiany w zabezpieczeniach zbioru danych!");
					$back = $this->uri->segment(4);
					if(!$back)
						$back = 1;
					redirect("slowniki/index/".$back."","refresh");	
				}
					}
				}
	
				$this->load->view("motyw_new",$data);	
		}
}
?>