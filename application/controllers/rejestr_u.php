<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rejestr_u extends CI_Controller {
	
public function __construct()
	{
		parent::__construct();
		check_perm($this->session->userdata("id"),$this->uri->segment(1));
		$this->load->model(array("Zaklady_model","Pracownicy_model","Slowniki_model","Zbiory_model","Rejestry_model"));
      $this->breadcrumbs->push('Rejestry', '/rejestry/index');
		
      //$this->breadcrumbs->unshift('Zakłady', site_url('admin/index'));			  			  
	}
public function json()
	{
		if($this->input->post()){
		
		$order 	= $this->input->post('order');
		$order["columns"] 	= $this->input->post('columns'); // $order[0]['column'];

		if($this->uri->segment(3) === "filtr"  && $this->uri->segment(4) > 0 && $this->session->userdata("zaklad") == 0 && $this->input->post('length')){
			$data["json"] = $this->Rejestry_model->pobierz_rej_u_json($this->uri->segment(4),$this->input->post('length'),$this->input->post('start'),$this->input->post('search'),$order);
		}
		else{
			$data["json"] = $this->Rejestry_model->pobierz_rej_u_json($this->session->userdata("zaklad"),$this->input->post('length'),$this->input->post('start'),$this->input->post('search'),$order);
		}
			$this->load->view("json",$data);	
	}	
}
public function index()
		{
	      $this->breadcrumbs->push('Rejestr umów', '/rejestr_u/index');
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();	
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			$data["perm"] = check_perm($this->session->userdata("id"),$this->uri->segment(1));
		
			$data["error"] = $this->session->flashdata("error");
			$data["msg"] = $this->session->flashdata("msg");
			
			
			if($this->uri->segment(3) === "dodaj")
			{								
				if($this->input->post("nieokreslony") == 1){
					$data_zakonczenia = "0000-00-00";
				}
				else{
					$data_zakonczenia = $this->input->post("data_wygasniecia");
				}
				
				$this->Rejestry_model->dodaj_u($this->input->post("zaklad"),$this->input->post("nazwa_firmy"),$this->input->post("kategoria"),$this->input->post("data_zawarcia"),$data_zakonczenia,$this->input->post("UmowaPosiada"));
				$this->session->set_flashdata("msg","Dodano nową pozycję w rejstrze!");
				redirect("rejestr_u","refresh");
			}
			
			if($this->uri->segment(3) === "zmien")
				{
					$ans = $this->Rejestry_model->zmien_typ($this->input->post("id"),$this->input->post("typ"));
					if($ans == "error")
						$this->session->set_flashdata("error","Błąd zmiany w pozycji!");
					else
						$this->session->set_flashdata("msg","Zmieniono pozycję!");
					redirect("rejestr_u","refresh");
				}
				
			if($this->uri->segment(3) === "publikuj" && is_numeric($this->uri->segment(4)))
					{
						$ans = $this->Rejestry_model->publikuj_u($this->uri->segment(4),$this->session->userdata("zaklad"));
						if($ans == "error")
							$this->session->set_flashdata("error","Wyłączenie publikacji pozycji!");
						else
							$this->session->set_flashdata("msg","Pozycja została opublikowana!");
						redirect("rejestr_u","refresh");
					}
			if($this->uri->segment(3) === "niepublikuj" && is_numeric($this->uri->segment(4)))
					{
						$ans = $this->Rejestry_model->niepublikuj_u($this->uri->segment(4),$this->session->userdata("zaklad"));
						if($ans == "error")
							$this->session->set_flashdata("error","Pozycja została opublikowana!");
						else
							$this->session->set_flashdata("msg","Wyłączenie publikacji pozycji!");
						redirect("rejestr_u","refresh");
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
				$q=$this->Zaklady_model->spis_zakladow($this->session->userdata("zaklad"));
				$data["zaklady"] = $q->result_array();	 
			
				if($data["perm"] === 2){ 
				$this->load->view("rejestry_u/reju_dodaj",$data);
				}
				
				if($this->session->userdata("zaklad") == 0){
					$this->load->view("rejestry_u/reju_filtr",$data);
				}
				
			
				if($this->uri->segment(3) === "filtr" && $this->uri->segment(4) > 0 && $this->session->userdata("zaklad") == 0)
				{
					$q=$this->Rejestry_model->pobierz_rej_u($this->uri->segment(4));
					$data["json_url"] = site_url("rejestr_u/json/filtr/".$this->uri->segment(4)."");
				}
					else
				{
					$q=$this->Rejestry_model->pobierz_rej_u($this->session->userdata("zaklad"));
					$data["json_url"] = site_url("rejestr_u/json/filtr/".$this->session->userdata("zaklad")."");
				}
				
				
				
			
			// $q=$this->Rejestry_model->pobierz_rej_u($this->session->userdata("zaklad"));
// 			$data["rejestr"] = $q->result_array();
//
		
				if($q->num_rows() > 0)
				{
					$this->load->view("rejestry_u/reju_index",$data);
				}
				else
				{
					$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg">Brak wyników wyszukiwania</div></div>';
				}
						
				
					$this->load->view("motyw_new",$data);	
			}		
		
		}

public function edytuj()
		{
	      $this->breadcrumbs->push('Rejestr umów', '/rejestr_u/index');
			$this->breadcrumbs->push('Modyfikacja umowy', '/rejestr_u/edytuj');
			
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();	
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			$data["perm"] = check_perm($this->session->userdata("id"),$this->uri->segment(1));
		
			$data["error"] = $this->session->flashdata("error");
			$data["msg"] = $this->session->flashdata("msg");
			
			if($this->uri->segment(3) === "update")
				{
					//$ans = $this->Rejestry_model->zmien_typ($this->input->post("id"),$this->input->post("typ"));
					$zbiory = array_unique(array_filter(explode(", ",$this->input->post("zbiory"))));
					$nowe = $this->Rejestry_model->usun_zbiory($this->input->post("id_umowy"),$this->input->post("id_zaklad"),$zbiory);
					if(!empty($nowe)){
					foreach($nowe as $zbior)
					{
						$this->Rejestry_model->dodaj_zbior($zbior,$this->input->post("id_umowy"));
					}
				   }
					$save = array(
						"nazwa_firmy" => $this->input->post("nazwa_firmy"),
						"cel_przetwarzania" => $this->input->post("cel_przetwarzania"),
						"data_zawarcia" => $this->input->post("data_zawarcia"),
						"data_wygas" => $this->input->post("data_wygas"),
						"umowa_posiada" => $this->input->post("umowa_posiada"),
						'data_wpisu' => $this->input->post('data_wpisu'),
						'typ_aktualizacji' => $this->input->post('typ_aktualizacji'),
					);
								
					$ans = $this->Rejestry_model->zapisz_umowe($this->input->post("id_umowy"),$this->input->post("id_zaklad"),$save);
						
					if($ans == "error")
						$this->session->set_flashdata("error","Błąd zmiany w pozycji!");
					else
						$this->session->set_flashdata("msg","Zmieniono pozycję!");
					
					redirect("rejestr_u","refresh");
				}
			
				else{
					$data["id"] = $this->uri->segment(3); //id_umowy
					$data["row"][] = $this->Rejestry_model->pobierz_rej_u_by_id(intval($this->uri->segment(3)));
					$data["zbiory_dostepne"] = $this->Zbiory_model->pobierz_liste_zbiorow($data["row"][0]->id_zaklad);
					$data["zbiory"] = $this->Rejestry_model->pobierz_rej_u_zbiory(intval($this->uri->segment(3)));
			
					
					if($data["perm"] === 2){ 
					$this->load->view("rejestry_u/reju_edytuj",$data);
					}
				}
			
			$this->load->view("motyw_new",$data);	
		}
public function zbiory()
		{
	      $this->breadcrumbs->push('Rejestr umów', '/rejestr_u/index');
			$this->breadcrumbs->push('Modyfikacja umowy (zbiory)', '/rejestr_u/edytuj');
	
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();	
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			$data["perm"] = check_perm($this->session->userdata("id"),$this->uri->segment(1));

			$data["error"] = $this->session->flashdata("error");
			$data["msg"] = $this->session->flashdata("msg");
	
			if($this->uri->segment(3) === "update")
				{
					$data["zbiory"] = $this->Rejestry_model->pobierz_rej_u_zbiory(intval($this->input->post("id_umowy")));
					//$this->Rejestry_model->usun_zbiory_zaw($this->input->post("id_umowy"));
					foreach ($data["zbiory"] as $item)
					{
					
				$ans = $this->Rejestry_model->zapisz_zbiory_zaw($this->input->post("id_umowy"),$item->id_zbior,$this->input->post($item->id),$item->id);
					
					}
					
					if($ans == "error")
						$this->session->set_flashdata("error","Błąd zmiany w pozycji!");
					else
						$this->session->set_flashdata("msg","Zapisano zmiany w zbiorach pozycję!");
			
				redirect("rejestr_u","refresh");
				}
	
				else{
					$data["id"] = $this->uri->segment(3); //id_umowy
					$data["row"][] = $this->Rejestry_model->pobierz_rej_u_by_id(intval($this->uri->segment(3)));
					if(isset($data["row"][0]->id_zaklad)){
					$data["zbiory_zaw"] = $this->Zbiory_model->pobierz_zbiory_z_zakladu($data["row"][0]->id_zaklad);
					}
					else{
						$data["zbiory_zaw"] = "";
					}
					$data["zbiory"] = $this->Rejestry_model->pobierz_rej_u_zbiory(intval($this->uri->segment(3)));
					$data["zbiory_zaznaczone"] = $this->Rejestry_model->pobierz_rej_u_zbiory_zaznaczone(intval($this->uri->segment(3)));
					foreach ($data["zbiory_zaznaczone"] as $item)
					{
						$data["zbiory_zazn"][$item->id]["odczyt"] = $item->odczyt;
						$data["zbiory_zazn"][$item->id]["wprowadzanie"] = $item->wprowadzanie;
						$data["zbiory_zazn"][$item->id]["modyfikacja"] = $item->modyfikacja;
						$data["zbiory_zazn"][$item->id]["usuwanie"] = $item->usuwanie;
						$data["zbiory_zazn"][$item->id]["archiwizacja"] = $item->archiwizacja;
					}
					
					if($data["perm"] === 2){ 
					$this->load->view("rejestry_u/reju_zbiory",$data);
					}
				}
	
			$this->load->view("motyw_new",$data);	
		}

}
?>