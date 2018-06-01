<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Europe/Warsaw');
if(!function_exists('date_diff')) {
    class DateInterval {
        public $y;
        public $m;
        public $d;
        public $h;
        public $i;
        public $s;
        public $invert;
        
        public function format($format) {
            $format = str_replace('%R%y', ($this->invert ? '-' : '+') . $this->y, $format);
            $format = str_replace('%R%m', ($this->invert ? '-' : '+') . $this->m, $format);
            $format = str_replace('%R%d', ($this->invert ? '-' : '+') . $this->d, $format);
            $format = str_replace('%R%a', ($this->invert ? '-' : '+') . $this->d, $format);
            $format = str_replace('%R%h', ($this->invert ? '-' : '+') . $this->h, $format);
            $format = str_replace('%R%i', ($this->invert ? '-' : '+') . $this->i, $format);
            $format = str_replace('%R%s', ($this->invert ? '-' : '+') . $this->s, $format);
            
            $format = str_replace('%y', $this->y, $format);
            $format = str_replace('%m', $this->m, $format);
            $format = str_replace('%d', $this->d, $format);
            $format = str_replace('%h', $this->h, $format);
            $format = str_replace('%i', $this->i, $format);
            $format = str_replace('%s', $this->s, $format);
            
            return $format;
        }
    }

    function date_diff(DateTime $date1, DateTime $date2) {
        $diff = new DateInterval();
        if($date1 > $date2) {
            $tmp = $date1;
            $date1 = $date2;
            $date2 = $tmp;
            $diff->invert = true;
        }
        
        $diff->y = ((int) $date2->format('Y')) - ((int) $date1->format('Y'));
        $diff->m = ((int) $date2->format('n')) - ((int) $date1->format('n'));
        if($diff->m < 0) {
            $diff->y -= 1;
            $diff->m = $diff->m + 12;
        }
        $diff->d = ((int) $date2->format('j')) - ((int) $date1->format('j'));
        if($diff->d < 0) {
            $diff->m -= 1;
            $diff->d = $diff->d + ((int) $date1->format('t'));
        }
        $diff->h = ((int) $date2->format('G')) - ((int) $date1->format('G'));
        if($diff->h < 0) {
            $diff->d -= 1;
            $diff->h = $diff->h + 24;
        }
        $diff->i = ((int) $date2->format('i')) - ((int) $date1->format('i'));
        if($diff->i < 0) {
            $diff->h -= 1;
            $diff->i = $diff->i + 60;
        }
        $diff->s = ((int) $date2->format('s')) - ((int) $date1->format('s'));
        if($diff->s < 0) {
            $diff->i -= 1;
            $diff->s = $diff->s + 60;
        }
        
        return $diff;
    }
}
class Admin extends CI_Controller {

public function __construct()
   {
         parent::__construct();
			$this->load->model(array("Zaklady_model","Slowniki_model","Zbiory_model","Upo_model","Pracownicy_model"));
	  		$this->breadcrumbs->unshift('Upoważnienia', '/admin');	
    }
function _zapiszupo($id_upo,$od,$do,$idprac,$miejsce)
	{
		
	$q = $this->Upo_model->upo_pobierz((int)$id_upo);
	if($q->num_rows() > 0)
	{
		$row = $q->row();
		$zaklad = $row->id_zaklad;
	}
	$id_slownik = $this->Slowniki_model->nazwa_slownik_id("slowniki_miejsca");
	$q = $this->Slowniki_model->sprawdz_pozycje($id_slownik,$miejsce,$zaklad);
	$row = $q->row();
	if($q->num_rows() > 0)
		$id_miejsce = $row->id;
	else
		{
			$this->Slowniki_model->dodaj_pozycje($miejsce,$zaklad,$id_slownik);
			$id_miejsce = $this->db->insert_id();
		}
			
 			
		$this->Upo_model->upo_zapisz((int)$id_upo,$idprac,$od,$do,$id_miejsce);
 		
		$q = $this->Slowniki_model->pobierz_slownik_id_sort("slowniki_systemy",$zaklad);
		$baza = "systemy";
		$q2 = $this->Upo_model->upo_pobierz_upowaznienia($baza,$id_upo);
		$up = 0;
		foreach($q->result() as $row)
 	  	{
			if(!is_array($this->input->post("si".$row->id."")))
			{
				$this->Upo_model->upo_zapisz_upowaznienia($baza,$id_upo,$row->id,"","");	
			}
			if(is_array($this->input->post("si".$row->id."")))
 			{
 				$zakres = implode(",", $this->input->post("si".$row->id.""));
				//insert albo update
				
				foreach($q2->result() as $row_upo)
						{
							$up = 0;
							if($row_upo->id_system == $row->id)
								{
							$id_system = $row->id;
							$login = $this->input->post("login".$id_system."");
							$this->Upo_model->upo_zapisz_upowaznienia($baza,$id_upo,$id_system,$login,$zakres);
							$up = 1;
							break;
							
								}
							else
							{
							continue;
						} 
					}
					if($up == 0)
					{
						$login = $this->input->post("login".$row->id."");
						$id_system = $row->id;
						$this->Upo_model->upo_dodaj_upowaznienia($baza,$id_upo,$id_system,$login,$zakres);
					}
					
 				
 				}
 		}		
		$q = $this->Slowniki_model->pobierz_slownik_id_sort("slowniki_zbiory",$zaklad);
		$baza = "zbiory";
		$q2 = $this->Upo_model->upo_pobierz_upowaznienia($baza,$id_upo);
		$up = 0;
		foreach($q->result() as $row)
 	  	{
			if(!is_array($this->input->post("zb".$row->id."")))
			{
				$this->Upo_model->upo_zapisz_upowaznienia($baza,$id_upo,$row->id,"","");
			}
			
			if(is_array($this->input->post("zb".$row->id."")))
 			{
 				$zakres = implode(",", $this->input->post("zb".$row->id.""));
				//insert albo update
				
				foreach($q2->result() as $row_upo)
						{
							$up = 0;
							if($row_upo->id_zbior == $row->id)
								{
									$this->Upo_model->upo_zapisz_upowaznienia($baza,$id_upo,$row->id,"",$zakres);
									$up = 1;
									break;
								}
							else
								{
									continue;
								}
						}
						if($up == 0)
							{
								$this->Upo_model->upo_dodaj_upowaznienia($baza,$id_upo,$row->id,"",$zakres);
							}
 				}
 		}

		redirect('/admin/upo', 'refresh');
	}

public function index()
	{
		if(!check_login())
			{
				header('Location: '.site_url('start/logowanie'));
			}
			
			$data_head["breadcrumbs"] = "";
			$this->load->view('head',$data_head);
			$data["error"] = $this->session->flashdata("error");
			$data["msg"] = $this->session->flashdata("msg");
			$this->load->model(array("User_model","Pracownicy_model","Zaklady_model","Upo_model"));
			
			$data["nazwa"] = $this->User_model->uzytkownik_pokaz_nazwe($this->session->userdata("id"));
			$data["last_log"] = $this->User_model->uzytkownik_ostatnie_log($this->session->userdata("id"));
			$users_raw = $this->User_model->uzytkownicy_zalogowani();
			foreach($users_raw as $item){
				if(!empty($item["user_data"])){
					$users[] = $item["user_data"];
				}
			}
			$uu = array_unique($users);
			foreach($uu as $user){
			preg_match("/\"login\";s:(.*)\"(.*)\";(.*)\"id\"/", $user, $m);
			$data["users_logged"][] = $m[2];
			$data["users_logged"] = array_unique($data["users_logged"]);
			}
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			if($this->session->userdata("zaklad") == 0)
			{
				$data["zaklad"] = "Wszystkie";
			}
			else
			{
				$q = $this->Zaklady_model->pobierz_zaklady($this->session->userdata("zaklad"));
				$row = $q->row();
				$data["zaklad"] = $row->nazwa_zakladu;
			}
			$data["suma_upo"] = $this->Upo_model->suma_upo_nazwisko("",$this->session->userdata("zaklad"),0);
			$data["suma_upo_wygasajacych"] = $this->Upo_model->suma_upo_nazwisko("",$this->session->userdata("zaklad"),0,1);								
			$data["suma_pracownikow"] = $this->Pracownicy_model->suma_pracownikow($this->session->userdata("zaklad")); 
			$this->load->view("admin_index",$data);	
			$this->load->view("motyw_new");	
	}
	
public function upo_edytuj()
	{
		function check_options($v,$id,$zbior)
		{
			if(strpos(@$zbior[$id],$v) !== false)
				return "checked";
			else
				return "";
		}
	$this->breadcrumbs->push('Spis upoważnień', '/admin/upo');
	$this->breadcrumbs->push('Edycja', '/admin/upo_edytuj');
	$data_head["breadcrumbs"] = $this->breadcrumbs->show();
	
		
	if(is_numeric($this->uri->segment(3)))
	{
		$q = $this->Upo_model->Upo_edytuj_spr($this->uri->segment(3),$this->session->userdata("zaklad"));
			if($q->num_rows() < 1)
			{
				$this->session->set_flashdata("error","Wystąpił błąd - błędny numer upoważnienia lub brak dostępu!");
				redirect('/admin/upo', 'refresh');
			}
		$row = $q->row();
		
		if($row->id_prac !=0){
			$q = $this->Upo_model->Upo_edytuj($this->uri->segment(3),$this->session->userdata("zaklad"));
		}else{
			$q = $this->Upo_model->upo_edytuj_puste($this->uri->segment(3),$this->session->userdata("zaklad"));
			$row = $q->row();
			$data["id_zakladu"] = $row->id_zaklad;
		}
		
		
		$this->form_validation->set_rules('pracownik', 'Pracownik', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
		$data["row"] = $q->row_array();
		
		if (isset($data["row"]["miejsce"]))
		$data["miejsce"] = $data["row"]["miejsce"];
		$data["uid"] = $data["row"]["uid"];
			
	
	if(isset($data["row"]["id_prac"])){
	
	$q = $this->Pracownicy_model->pobierz_pracownik_id($data["row"]["id_prac"]);
	$row = $q->row();
	$data["id_zakladu"] = $row->id_zakladu;
	$data["id_prac"] = $row->id;
	$data['nazwisko_imie'] = $row->nazwiskoimie;
	}
	
	
	$q = $this->Slowniki_model->pobierz_slownik("slowniki_miejsca",$data["id_zakladu"]);
	$data["komorki"] = $q->result_array();	

	$q = $this->Pracownicy_model->spis_pracownikow($data["id_zakladu"]);
	$data["pracownicy_w"]= $q->result_array();
		
	$q = $this->Upo_model->upo_pobierz_upowaznienia("systemy",$data["uid"]);
	foreach($q->result() as $row)
				{
					$data["si"][$row->id_system] = $row->zakres;
					$data["si_login"][$row->id_system] = $row->login;
				}
												
$q = $this->Slowniki_model->pobierz_slownik_id_sort("slowniki_systemy",$data["id_zakladu"]);		
foreach($q->result() as $row)
{
	$data["z_si"][] = array(
			"id" 		=> $row->id,
		 	"nazwa" 	=> $row->nazwa,
			"login"	=> @$data["si_login"][$row->id],
			"O" => check_options('O',$row->id,@$data["si"]),
			"W" => check_options('W',$row->id,@$data["si"]),
			"M" => check_options('M',$row->id,@$data["si"]),
			"U" => check_options('U',$row->id,@$data["si"]),
			"A" => check_options('A',$row->id,@$data["si"])
		);	
}

$q = $this->Upo_model->upo_pobierz_upowaznienia("zbiory",$data["uid"]);
	foreach($q->result() as $row)
					{
						$data["zb"][$row->id_zbior] = $row->zakres;
					}		
					
	$q = $this->Slowniki_model->pobierz_slownik_id_sort("slowniki_zbiory",$data["id_zakladu"]);	
		foreach($q->result() as $row)
						{
							$data["z_zb"][] = array(
									"id" 		=> $row->id,
								 	"nazwa" 	=> $row->nazwa,
									"O" => check_options('O',$row->id,@$data["zb"]),
									"W" => check_options('W',$row->id,@$data["zb"]),
									"M" => check_options('M',$row->id,@$data["zb"]),
									"U" => check_options('U',$row->id,@$data["zb"]),
									"A" => check_options('A',$row->id,@$data["zb"])
								);							
						}

			
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			$this->load->view("upo/upo_edytuj",$data);	
		}
		else	
			{
				Admin::_zapiszupo($this->uri->segment(3),$this->input->post("od"),$this->input->post("do"),$this->input->post("pracownik"),$this->input->post("miejsce"));
				
			}
						$this->load->view("motyw_new");
	}
}





public function upo()
		{					
         $data["perm"] = check_perm($this->session->userdata("id"),$this->uri->segment(2));

			$this->breadcrumbs->push('Wyszukiwanie', '/admin/upo/index');
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();
			
			
			if($this->uri->segment(3) == "cofnij" && $this->input->post("uid") !== FALSE )
			{
				if($data["perm"] == 2)
				{
					$this->Upo_model->cofnij_upo((int)$this->input->post("uid"),$this->input->post("data_cofniecia"));
					$this->session->set_flashdata("msg","Cofnięto upoważnienie!");
				}
				else
					$this->session->set_flashdata("error","Brak dostępu!");
				
				redirect('/admin/upo', 'refresh');
			}
			if($this->uri->segment(3) == "5lat" && is_numeric($this->uri->segment(4)))
			{
				if($data["perm"] == 2)
				{
					$this->Upo_model->przedluz_upo((int)$this->uri->segment(4));
					$this->session->set_flashdata("msg","Przedłużono upoważnienie o 5 lat!");
				}
				else
					$this->session->set_flashdata("error","Brak dostępu!");
				
				redirect('/admin/upo', 'refresh');
			}
			if($this->uri->segment(3) == "upo_wyczysc" && is_numeric($this->uri->segment(4)))
			{
				if($data["perm"] == 2)
				{
				$this->Upo_model->upo_zapisz((int)$this->uri->segment(4), null, null, null, null);
				$this->Slowniki_model->usun_wszystko((int)$this->uri->segment(4),'upowaznienia_systemy');
				$this->Slowniki_model->usun_wszystko((int)$this->uri->segment(4),'upowaznienia_zbiory');
				
				$this->session->set_flashdata("msg","Wyczyszczono upoważnienie!");
				redirect('/admin/upo', 'refresh');
				}
				else
					$this->session->set_flashdata("error","Brak dostępu!");
					redirect('/admin/upo', 'refresh');

			}
			if($this->uri->segment(3) == "clean")
			{
				$sesja = array(
					"name" 		=> '',
					"sort"		=> '',
					"sortid"	=> '',
					"aktualne"  => ''
				);
				$this->session->set_flashdata("msg","Zresetowano wyszukiwanie!");
				$this->session->unset_userdata($sesja);
				redirect('/admin/upo', 'refresh');
			}
			
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			
			$data["error"] = $this->session->flashdata("error");
			$data["msg"] = $this->session->flashdata("msg");
			
			if($this->input->post("name") !== FALSE)
				{
					$name = $this->input->post("name");
					$sesja = array(
						"name" 		=> $this->input->post("name"),
						"sort"		=> $this->input->post("sort"),
						"sortid"	=> $this->input->post("sortid"),
						"aktualne"  => $this->input->post("aktualne")
					);
					
					$this->session->set_userdata($sesja);
				}
			else
				{
					$name = $this->session->userdata("name");
				}	
							
				if($this->input->post("sortid") == "tak" or $this->session->userdata("sortid") == "tak")
					  { 
							 $opcja["uid"] = 1;
							 $data["sortid"] = 1;
					  }
				else
				{
					if($this->input->post("sort") == 1 or $this->session->userdata("sort") == 1)
						{
							$opcja["data"] = 1;
							$data["sort"] = 1;
						}
					else
						{
							$opcja["data"] = 0;
						}
				}
				if($this->input->post("aktualne") == 1 or $this->session->userdata("aktualne") == 1)
				{
					$opcja["aktualne"] = 1;
					$data["aktualne"] = 1;
				}
				
				$puste=0;
				if($this->input->post("puste") == "tak" or $this->session->userdata("puste") == "tak"){
					
					$puste=1;

					
				}
				
				
				if($this->session->userdata("name") !== FALSE)
				{
					$data["name"]	 	= $this->session->userdata("name");
					$data["sort"]	 	= $this->session->userdata("sort");
					$data["sortid"]	    = $this->session->userdata("sortid");
					$data["aktualne"]   = $this->session->userdata("aktualne");
					$data['puste']      = $this->session->userdata("puste");
				}
				$data["name"] = $name;
			
			if($data["perm"] == 2)
			{
			$q = $this->Zaklady_model->spis_zakladow($this->session->userdata("zaklad"));
			$data["row"] = $q->result_array();
			$this->load->view("upo/upo_zaklady",$data);		
			}
			
			$this->load->view("upo/upo_wyszukaj",$data);	
				
		
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Pracownik', '');
			
			 
			
		if ($this->form_validation->run() !== FALSE or $this->session->userdata("name") !== FALSE or $this->uri->segment(3) == "wygasajace")
					{
						$ile = 20;
						if($this->uri->segment(3) !== NULL)
						{
								$od = $this->uri->segment(3);
						}
						else
						{
								$od = 0;
						}
						
						
		
		If ($puste == 1){
			
			$q= $this->Upo_model->suma_puste($this->session->userdata("zaklad"));
			
			
		}else{
		
			if($this->uri->segment(3) == "wygasajace")
			{
				$q = $this->Upo_model->suma_upo_nazwisko($name,$this->session->userdata("zaklad"),$opcja,1);			
			}
			else
			{
				$q = $this->Upo_model->suma_upo_nazwisko($name,$this->session->userdata("zaklad"),$opcja);			
			}
		}
		$data["wyszukiwanie"] = $name;			
		if($q > 0)
				{
					$suma = $q;
					
					
						if($puste == 1){
							
							$q = $this->Upo_model->upo_puste($this->session->userdata("zaklad"),$od,$ile);	
							
						}else{
							if($this->uri->segment(3) == "wygasajace")
							{
								$q = $this->Upo_model->upo_nazwisko($name,$this->session->userdata("zaklad"),$opcja,$od,$ile,1);	
							}
							else
							{
								$q = $this->Upo_model->upo_nazwisko($name,$this->session->userdata("zaklad"),$opcja,$od,$ile);	
							}
						}
				
					$this->load->library('Ajax_pagination');
					//$config['base_url'] = $this->config->item("pag_suffix").'/index.php/admin/upo/';
					$config['base_url']= site_url('admin/upo/');
					$config['total_rows'] = $suma;
					$config['per_page'] = $ile; 
					$config['full_tag_open'] = '<ul class="pagination">';
					$config['full_tag_close'] = '</ul>';
					$this->ajax_pagination->initialize($config);
					
					$data["pagination"] = $this->ajax_pagination->create_links();		
					$data["i"] = 0;
					$data["suma"] = $suma;
					$data["tydzien"] = date("Y-m-d",strtotime("+2 week 1 day"));
					$data["row"] = $q->result_array();
							
							$this->load->view("upo/upo_spis",$data);
				}
				else
						{
							$data["error"] = "Brak elementów do wyświetlenia!";
							$this->load->view("upo/upo_error",$data);
					}
			}
			$this->load->view("motyw_new",$data);	
		}

function upo_nowe()
	{
		
		$this->breadcrumbs->push('Spis upoważnień', '/admin/upo');
		$this->breadcrumbs->push('Nowe upoważnienie', '/admin/upo_nowe');
		$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		
		$this->load->view('head',$data_head);
		$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
		check_perm($this->session->userdata("id"),$this->uri->segment(2),2);
		
		$data["error"] = $this->session->flashdata("error");
		$data["msg"] = $this->session->flashdata("msg");
		
		if(is_numeric($this->uri->segment(3)))
			{
			$data["id_zaklad"]=$this->uri->segment(3);
			$q = $this->Zaklady_model->spis_zakladow($data["id_zaklad"]);
			
			if($q->num_rows() == 0)	
				{
					$data["error"] = "Wybrano błędny zakład!";
					$this->load->view("upo/upo_error",$data);
				}
				else
				{
			
				$q = $this->Pracownicy_model->pobierz_pracownikow($data["id_zaklad"],1);
			
				if($q->num_rows() == 0)
					{
						$data["error"] = "Brak pracowników w wybrany zakładzie!";
						$this->load->view("upo/upo_error",$data);
					}
				else
					{
					$this->form_validation->set_rules('od', 'Data od', 'required|exact_length[10]');
					$this->form_validation->set_rules('do', 'Data do', 'required|exact_length[10]');
					
					if ($this->form_validation->run() == FALSE)
					{
					$data["pracownicy"] = $q->result_array();
					$q = $this->Slowniki_model->pobierz_slownik("slowniki_miejsca",$data["id_zaklad"]);
					$data["komorki"] = $q->result_array();	  
											
					$q = $this->Slowniki_model->pobierz_slownik_id_sort("slowniki_systemy",$data["id_zaklad"]);	
					$data["z_si"] = $q->result_array();	
					$q = $this->Slowniki_model->pobierz_slownik_id_sort("slowniki_zbiory",$data["id_zaklad"]);	
					$data["z_zb"] = $q->result_array();
					$this->load->view("upo/upo_nowy",$data);
					}
					else
					{
						$this->Upo_model->nowe_upo($this->uri->segment(3),$this->input->post("od"),$this->input->post("do"),$this->input->post("pracownik"),$this->input->post("miejsce"));
						$this->session->set_flashdata("msg","Dodano nowe upoważnienie!");
						redirect('/admin/upo', 'refresh');
					}		
						
					}
				}
			}
		$this->load->view("motyw_new",$data);	

	}					
}?>
