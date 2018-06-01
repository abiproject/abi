<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Export extends CI_Controller {
	
public function __construct()
   {
     parent::__construct();
     check_perm($this->session->userdata("id"),$this->uri->segment(1));
	  $this->load->model(array("Upo_model","Zaklady_model"));
	  $this->load->library(array('tcpdf','fpdi'));
   }

public function pdf()
		{
			$this->load->helper('text');
			$dokument_id = (int)$this->uri->segment(3);
			$anulowanie = $this->uri->segment(4);
			if((int)$dokument_id > 0)
			{
				$q = $this->Upo_model->upo_by_id($dokument_id,$this->session->userdata("zaklad"));
				$data = $q->row_array();
				if($data["nazwiskoimie"] != NULL)
				{
				$q = $this->Upo_model->upo_pobierz_upowaznienia_slownik("systemy",$dokument_id);
				$data["si"] = $q->result_array();
				$q = $this->Upo_model->upo_pobierz_upowaznienia_slownik("zbiory",$dokument_id);
				$data["zb"] = $q->result_array();				
		    
				$pdf = new FPDI(); 
				$pdf->SetFont('dejavusans', '', '10', '',true);
				$pdf->setFontSubsetting(false);
				$pdf->SetPrintHeader(false);
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
				$pdf->AddPage(); 
				if($anulowanie == TRUE)
					$html = $this->load->view("pdf/pdf_upowaznienie_anuluj",$data,true);
				else
					$html = $this->load->view("pdf/pdf_upowaznienie",$data,true);				
				$pdf->writeHTML($html, true, false, true, false, '');
				ob_end_clean();
				$pdf->Output('UPO_'.convert_accented_characters($data["nazwiskoimie"]).'.pdf', 'D'); 
				}
				else
					die("Brak dostepu!");
			}
			else
				die("Brak dostepu!");
			}

public function pdf_abi()
		{
			$this->load->helper('text');
			$abi_id = (int)$this->uri->segment(3);
			$anulowanie = $this->uri->segment(4);
			if((int)$abi_id > 0)
			{
				$q = $this->Zaklady_model->pobierz_abi($abi_id,$this->session->userdata("zaklad"));
				$data["dane"] = $q->row_array();
				$pdf = new FPDI(); 
				$pdf->SetFont('dejavusans', '', '10', '',true);
				$pdf->setFontSubsetting(false);
				$pdf->SetPrintHeader(false);
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
				$pdf->AddPage(); 
				if($anulowanie == TRUE)
				$html = $this->load->view("pdf/pdf_odwolanie_abi",$data,true);				
					else
				$html = $this->load->view("pdf/pdf_zgloszenie_abi",$data,true);				
				$pdf->writeHTML($html, true, false, true, false, '');
				ob_end_clean();
				$pdf->Output('ABI.pdf', 'D'); 
				
			}
			else
				die("Brak dostepu!");
			}
				
		}
?>