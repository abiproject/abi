<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

public function __construct()
   {
       parent::__construct();
     }

public function giodo()
	{
		$this->load->model("Api_model");
		
		if(strlen($this->uri->segment(3)) == 32)
			{
				$api_key = $this->uri->segment(3);
				$data["zaklad"] = $this->Api_model->pobierz_zaklad($api_key);
				$zbiory = $this->Api_model->pobierz_rejestr_u_zbiory($api_key);
				$zbiory_details = $this->Api_model->pobierz_zbiory_details($api_key);
				$podstawy_prawne = $this->Api_model->pobierz_podstawe_prze($api_key);
				$pobierz_umowy = $this->Api_model->pobierz_umowy($api_key);
				$pobierz_zakres = $this->Api_model->pobierz_zakres_przetwarzania($api_key);
					
				if($zbiory->num_rows > 0){
					$data["data"] = "API";
					$data["zbiory"] = $zbiory->result_array();
					$data["zbiory_details"] = $zbiory_details->result_array();
					$data["podstawy_prawne"] = $podstawy_prawne->result_array();
					$data["umowy"] = $pobierz_umowy->result_array();
					$data["zakres"] = $pobierz_zakres->result_array();
					
					$this->Api_model->zapisz_dostep($api_key,0);
				}
				else
				{
					$this->Api_model->zapisz_dostep($api_key,1);
					redirect("start/logowanie","refresh");
				}
			}
			else
			{
				$this->Api_model->zapisz_dostep($api_key,2);
				redirect("start/logowanie","refresh");
			}
		$this->load->view("api/api",$data);
		$this->load->view("motyw_new");
	}
}
?>