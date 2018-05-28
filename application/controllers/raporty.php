<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Raporty extends CI_Controller {

public function __construct()
	 {
	       parent::__construct();
	       check_perm($this->session->userdata("id"),$this->uri->segment(1));
			 $this->load->model(array("Zaklady_model","Raporty_model"));
			 $this->breadcrumbs->unshift('Zakłady', site_url('admin/index'));
	 }
		 
public function index()
	{
		$this->breadcrumbs->push('Raporty', 'raporty/index');
		$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		
		$this->load->view('head',$data_head);
		$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
		$data["error"] = $this->session->flashdata("error");
		$data["msg"] = $this->session->flashdata("msg");
		
		$q = $this->Zaklady_model->pobierz_zaklady($this->session->userdata("zaklad"));
		$data["zaklady"] = $q->result_array();
		$this->load->view("raporty/rap_index",$data);
			
		$q = $this->Raporty_model->pobierz_raporty_pok($this->session->userdata("zaklad"));	
		$data["raporty_pok"] = $q->result_array();
		$this->load->view("raporty/rap_spis_pok",$data);	


		$q = $this->Raporty_model->pobierz_raporty_roczne($this->session->userdata("zaklad"));	
		$data["raporty"] = $q->result_array();
		$this->load->view("raporty/rap_spis_roczne",$data);	
		
		$this->load->view("motyw_new");	
		
	}

public function pokontrolny()
		{
			$this->breadcrumbs->push('Raporty', 'raporty/index');
			$this->breadcrumbs->push('Raport pokontrolny ODO', 'raporty/pokontrolny');
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();
			
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			
			if($this->uri->segment(3) == "pdf" && is_numeric($this->uri->segment(4)))
			{
				$this->load->library('tcpdf');
				$this->load->library('fpdi');
			
				$id = (int)$this->uri->segment(4);			
				$q = $this->Raporty_model->pobierz_pok($id);

				$pdf = new FPDI(); 

			   $data["pok"] = $q->row_array();
				$pdf->SetFont('dejavusans', '', '10', '',true);
				$pdf->setFontSubsetting(false);
				$pdf->SetPrintHeader(false);
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
				$pdf->AddPage(); 
				$html = $this->load->view("pdf/pdf_raport_pok",$data,true);
				@$pdf->writeHTML($html, true, false, true, false, '');
				$pdf->Output('Raport_pokontrolny.pdf', 'D'); 
			}
			if($this->uri->segment(3) == "usun" && is_numeric($this->uri->segment(4)))
				{
					$this->Raporty_model->usun_pok($this->uri->segment(4));
					$this->session->set_flashdata("msg","Usunięto pozycję!");
					redirect("raporty","refresh");
				}
			
			$this->form_validation->set_rules('zaklad', 'Zaklad', 'required');
			$this->form_validation->set_rules('termin', 'Termin', 'required');
			$this->form_validation->set_rules('miejsce', 'Miejsce', 'required');
			$this->form_validation->set_rules('kier_kontrolowanego_ob','Kierownik kontrolowanego obszaru','required');
				if($this->form_validation->run() == FALSE)
				{
					$q = $this->Zaklady_model->pobierz_zaklady($this->session->userdata("zaklad"));
					$data["zaklady"] = $q->result_array();
					$this->load->view("raporty/rap_pok",$data);			
				}
				else
					{	
						$this->Raporty_model->dodaj_rap_pok($this->input->post());
						$this->session->set_flashdata("msg","Dodano nowy raport pokontrolny!");
						redirect("raporty","refresh");
					
					}
				$this->load->view("motyw_new");	
		
		}
		
public function roczny()
	{
		$this->breadcrumbs->push('Raporty', 'raporty/index');
		$this->breadcrumbs->push('Raport roczny ODO', 'raporty/roczny');
		$data_head["breadcrumbs"] = $this->breadcrumbs->show();
		
		$this->load->view('head',$data_head);
		$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));

		if($this->uri->segment(3) == "pdf" && is_numeric($this->uri->segment(4)))
		{
			$this->load->library('tcpdf');
			$this->load->library('fpdi');

			$id = (int)$this->uri->segment(4);			
			$q = $this->Raporty_model->pobierz_roczny($id);

			$pdf = new FPDI(); 

		   $data["rap"] = $q->row_array();
			$pdf->SetFont('dejavusans', '', '10', '',true);
			$pdf->setFontSubsetting(false);
			$pdf->SetPrintHeader(false);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
			$pdf->AddPage(); 
			$html = $this->load->view("pdf/pdf_raport_roczny",$data,true);
			@$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('Raport_roczny.pdf', 'D'); 
		}
		
		if($this->uri->segment(3) == "usun" && is_numeric($this->uri->segment(4)))
			{
				$this->Raporty_model->usun_roczny($this->uri->segment(4));
				$this->session->set_flashdata("msg","Usunięto pozycję!");
				redirect("raporty","refresh");
			}
			
		$this->form_validation->set_rules('zaklad', 'Zaklad', 'required');
		$this->form_validation->set_rules('termin', 'Termin', 'required');
		$this->form_validation->set_rules('uczestnicy', 'Uczestnicy przeglądu', 'required');
		$this->form_validation->set_rules('zagadnienia', 'Zagadnienia', 'required');
		
			if($this->form_validation->run() == FALSE)
			{
				$q = $this->Zaklady_model->pobierz_zaklady($this->session->userdata("zaklad"));
				$data["zaklady"] = $q->result_array();
				$this->load->view("raporty/rap_odo",$data);			
			}
			else
				{	
					$this->Raporty_model->dodaj_rap_roczny($this->input->post());
					$this->session->set_flashdata("msg","Dodano nowy raport roczny!");
					redirect("raporty","refresh");
		
				}
	
	
			$this->load->view("motyw_new");	

	}


}
?>