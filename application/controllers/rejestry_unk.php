<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rejestry_unk extends CI_Controller {

public function __construct()
   {
     parent::__construct();
     check_perm($this->session->userdata("id"),$this->uri->segment(1));
	  $this->load->model(array("Zaklady_model","Pracownicy_model","Slowniki_model","Zbiory_model","Rejestry_model"));
     $this->breadcrumbs->push('Rejestry', 'rejestry/index');
     $this->breadcrumbs->unshift('Zakłady', site_url('admin/index'));			  			  
	  
    }
public function index()
		{
			$this->breadcrumbs->push('Rejestr uszkodzonych nośników komputerowych','rejestry_unk/index');
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
		
			$data["error"] = $this->session->flashdata("error");
			$data["msg"] = $this->session->flashdata("msg");
			
			if($this->uri->segment(3) == "dodaj")
			{
					$this->Rejestry_model->dodaj_unk($this->input->post("data"),$this->input->post("zaklad"),$this->input->post("komorka"));
					$this->session->set_flashdata("msg","Dodano nową pozycję w rejstrze!");
					redirect("rejestry_unk","refresh");
			}
			
			if($this->uri->segment(3) == "usun" && is_numeric($this->uri->segment(4)))
				{
					$ans = $this->Rejestry_model->usun_runk($this->uri->segment(4),$this->session->userdata("zaklad"));
					if($ans == "error")
						$this->session->set_flashdata("error","Błąd usuwania pozycji!");
					else
						$this->session->set_flashdata("msg","<strong>OK!</strong> Usunięto pozycję z rejestru.");
					redirect("rejestry_unk","refresh");
				}
				
			else
			{
			$data["a"] = $this->uri->segment(3);
			$q = $this->Slowniki_model->pobierz_slownik("slowniki_miejsca",$this->session->userdata("zaklad"));
			$data["komorki"] = $q->result_array();
			$q=$this->Zaklady_model->spis_zakladow($this->session->userdata("zaklad"));
			$data["zaklady"] = $q->result_array();	  
			$this->load->view("rejestry_unk/rejunk_dodaj",$data);
			$q=$this->Rejestry_model->pobierz_rej_unk($this->session->userdata("zaklad"));
			$data["rejestr"] = $q->result_array();
			
		
				if($q->num_rows() > 0)
				{
					$this->load->view("rejestry_unk/rejunk_index",$data);
				}
				else
				{
					$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg"><strong>Uwaga!</strong> Brak pozycji w rejestrze!</div></div>';
				}
						
				
					$this->load->view("motyw_new",$data);	
			}		
		
		}
		public function drukuj()
			{		
				$this->load->library('tcpdf');
				$this->load->library('fpdi');
				
				$id = (int)$this->uri->segment(3);			
				$pdf = new FPDI(); 

				$q=$this->Rejestry_model->pobierz_protokol_unk($id,$this->session->userdata("zaklad"));
				$data["protokol"] = $q->row_array();
				if($q->num_rows > 0)
				{
				$pdf->SetFont('dejavusans', '', '10', '',true);
				$pdf->setFontSubsetting(false);
				$pdf->SetPrintHeader(false);
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
				$pdf->AddPage(); 
				$html = $this->load->view("pdf/pdf_protokol_unk",$data,true);
				
				@$pdf->writeHTML($html, true, false, true, false, '');
				$pdf->Output('Protkol_UNK.pdf', 'D');
				}
				else
				{
					$this->session->set_flashdata("error","Brak dostępu!");
					redirect("rejestry_unk","refresh");
				}
				
			}
}
?>