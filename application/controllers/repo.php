<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Repo extends CI_Controller {

public function __construct()
   {
     	parent::__construct();
	  	$this->load->model("Zaklady_model");  
     	check_perm($this->session->userdata("id"),$this->uri->segment(1));
	 	$this->load->library(array('tcpdf','fpdi'));
		$this->breadcrumbs->unshift('Zakłady', site_url('admin/index'));			  			  
		
    }
	 
public function index()
	{
			$q = $this->Zaklady_model->pobierz_zaklady($this->session->userdata("zaklad"));
			$data["zaklady"] = $q->result_array();
			$this->breadcrumbs->push('Repozytorium dokumentów', '/repo/index');
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			$this->load->view("repo/rep_index",$data);	
			$this->load->view("motyw_new");
			if($this->uri->segment(3) == "pdf")
				{
					$pdf = new FPDI(); 
		
				   $data["data"] = "a";
					$pdf->SetFont('dejavusans', '', '10', '',true);
					$pdf->setFontSubsetting(false);
					$pdf->SetPrintHeader(false);
					$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
					$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
					$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
					$pdf->AddPage(); 
					
					switch($this->uri->segment(4)){
						case "zalacznik3":
							$html = $this->load->view("pdf/pdf_zalacznik3",$data,true);
							@$pdf->writeHTML($html, true, false, true, false, '');
							$pdf->Output('Zalacznik_3.pdf', 'D'); 
							break;
						case "zalacznik4":
							$html = $this->load->view("pdf/pdf_zalacznik4",$data,true);
							@$pdf->writeHTML($html, true, false, true, false, '');
							$pdf->Output('Zalacznik_4.pdf', 'D'); 
							break;
						case "zalacznik7":
							$html = $this->load->view("pdf/pdf_zalacznik7",$data,true);
							@$pdf->writeHTML($html, true, false, true, false, '');
							$pdf->Output('Zalacznik_7.pdf', 'D'); 
							break;
						case "zalacznik9":
							$html = $this->load->view("pdf/pdf_zalacznik9",$data,true);
							@$pdf->writeHTML($html, true, false, true, false, '');
							$pdf->Output('Zalacznik_9.pdf', 'D'); 
							break;
						case "zalacznik10":
							$html = $this->load->view("pdf/pdf_zalacznik10",$data,true);
							@$pdf->writeHTML($html, true, false, true, false, '');
							$pdf->Output('Zalacznik_10.pdf', 'D'); 
							break;
						}
				}	
	}
	
public function zalacznikI()
	{		
		$dokument_id = (int)$this->uri->segment(3);
		$pdf = new FPDI(); 

	   $data["data"] = "a";
		$pdf->SetFont('dejavusans', '', '10', '',true);
		$pdf->setFontSubsetting(false);
		$pdf->SetPrintHeader(false);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
		$pdf->AddPage(); 
		if($this->uri->segment(3) == 1)
		$html = $this->load->view("pdf/pdf_zalacznik_i_1",$data,true);
		if($this->uri->segment(3) == 2)
		$html = $this->load->view("pdf/pdf_zalacznik_i_2",$data,true);
		if($this->uri->segment(3) == 3)
		$html = $this->load->view("pdf/pdf_zalacznik_i_3",$data,true);
		if($this->uri->segment(3) == 4)
		$html = $this->load->view("pdf/pdf_zalacznik_i_4",$data,true);
		@$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('Zalacznik_I.pdf', 'D'); 

	}
	
public function powolanie_asi()
		{		
			$dokument_id = (int)$this->uri->segment(3);
			$pdf = new FPDI(); 

		   $data["data"] = "a";
			$pdf->SetFont('dejavusans', '', '10', '',true);
			$pdf->setFontSubsetting(false);
			$pdf->SetPrintHeader(false);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
			$pdf->AddPage(); 
			$html = $this->load->view("pdf/pdf_powolanie_asi",$data,true);
			@$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('Powolanie_ASI.pdf', 'D'); 

		}

public function oswiadczenie_wolonat()
		{
			$dokument_id = (int)$this->uri->segment(3);
			$pdf = new FPDI(); 

		   $data["data"] = "a";
			$pdf->SetFont('dejavusans', '', '10', '',true);
			$pdf->setFontSubsetting(false);
			$pdf->SetPrintHeader(false);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
			$pdf->AddPage(); 
			$html = $this->load->view("pdf/pdf_oswiadczenie_wolontariusz",$data,true);
			@$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('Oswiadczenie_wolontariusza.pdf', 'D'); 
		}

public function oswiadczenie_pracownika_t()
		{
			$dokument_id = (int)$this->uri->segment(3);
			$pdf = new FPDI(); 

		   $data["data"] = "a";
			$pdf->SetFont('dejavusans', '', '10', '',true);
			$pdf->setFontSubsetting(false);
			$pdf->SetPrintHeader(false);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
			$pdf->AddPage(); 
			$html = $this->load->view("pdf/pdf_oswiadczenie_pracownika_t",$data,true);
			@$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('Oswiadczenie_pracownika_technicznego.pdf', 'D'); 
		}
		
public function oswiadczenie_uzytk_zat()
		{
			$dokument_id = (int)$this->uri->segment(3);
			$pdf = new FPDI(); 

		   $data["data"] = "a";
			$pdf->SetFont('dejavusans', '', '10', '',true);
			$pdf->setFontSubsetting(false);
			$pdf->SetPrintHeader(false);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
			$pdf->AddPage(); 
			$html = $this->load->view("pdf/pdf_oswiadczenie_uzytk_zat",$data,true);
			@$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('Oswiadczenie_uzytkownika_zatrudnionego.pdf', 'D'); 
		}

public function oswiadczenie_zleceniobiorcy()
		{
			$dokument_id = (int)$this->uri->segment(3);
			$pdf = new FPDI(); 

		   $data["data"] = "a";
			$pdf->SetFont('dejavusans', '', '10', '',true);
			$pdf->setFontSubsetting(false);
			$pdf->SetPrintHeader(false);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
			$pdf->AddPage(); 
			$html = $this->load->view("pdf/pdf_oswiadczenie_zleceniobiorcy",$data,true);
			@$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('Oswiadczenie_zleceniobiorcy.pdf', 'D'); 
		}

public function wniosek_do()
		{
			$dokument_id = (int)$this->uri->segment(3);
			$pdf = new FPDI(); 

		   $data["data"] = "a";
			$pdf->SetFont('dejavusans', '', '10', '',true);
			$pdf->setFontSubsetting(false);
			$pdf->SetPrintHeader(false);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
			$pdf->AddPage(); 
			$html = $this->load->view("pdf/pdf_wniosek_do",$data,true);
			@$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('Wniosek_udostepnienie_do.pdf', 'D'); 
		}

public function upowaznienie_osoby()
		{
			$dokument_id = (int)$this->uri->segment(3);
			$pdf = new FPDI(); 

		   $data["data"] = "a";
			$pdf->SetFont('dejavusans', '', '10', '',true);
			$pdf->setFontSubsetting(false);
			$pdf->SetPrintHeader(false);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
			$pdf->AddPage(); 
			$html = $this->load->view("pdf/pdf_upowaznienie_osoby",$data,true);
			@$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('Upowazenienie_osoby_trzeciej.pdf', 'D'); 
		}


}