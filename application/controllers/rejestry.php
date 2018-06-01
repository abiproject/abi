<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rejestry extends CI_Controller {

public function __construct()
 {
    parent::__construct();
    check_perm($this->session->userdata("id"),$this->uri->segment(1));
	 $this->load->model(array("Zaklady_model","Rejestry_model","Pracownicy_model","Slowniki_model","Upo_model","Zbiory_model"));
    $this->breadcrumbs->push('Rejestry', 'rejestry/index');
    $this->breadcrumbs->unshift('Zakłady', site_url('admin/index'));	

 }
 
public function index()
	{
			$q = $this->Zaklady_model->pobierz_zaklady($this->session->userdata("zaklad"));
			$data["zaklady"] = $q->result_array();
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();
			
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
			$data["error"] = $this->session->userdata("error");
			$data["msg"] = $this->session->userdata("msg");
			$sesja = array("msg" => '', "error" => '');
			$this->session->unset_userdata($sesja);
			
			$this->load->view("rejestry/rej_index",$data);	
			$this->load->view("motyw_new");	
		
	}
	
	
	public function upowaznienia()
	{		
	
	
		$this->load->library("table");
		$this->load->library('excel');
	
		if($this->session->userdata("zaklad") > 0 and $this->uri->segment(3) != $this->session->userdata("zaklad"))
		{
			$this->session->set_userdata("error","Brak dostępu!");
			redirect('/rejestry', 'refresh');
		}
		
		$q = $this->Slowniki_model->pobierz_slownik("slowniki_systemy",$this->uri->segment(3));
		$slownik_si = $q->result_array();
		$slownik_si_count = $q->num_rows();
		
		$q = $this->Slowniki_model->pobierz_slownik("slowniki_zbiory",$this->uri->segment(3));
		$slownik_zb = $q->result_array();
		$slownik_zb_count = $q->num_rows();
		
		
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getDefaultStyle()->getFont()->setName('Arial');
		$this->excel->getDefaultStyle()->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
		$this->excel->getActiveSheet()->getPageMargins()->setTop(1);
		$this->excel->getActiveSheet()->getPageMargins()->setRight(0.5);
		$this->excel->getActiveSheet()->getPageMargins()->setLeft(0.5);
		$this->excel->getActiveSheet()->getPageMargins()->setBottom(1);
		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->excel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->mergeCells("A1:A2");
		$this->excel->getActiveSheet()->mergeCells("B1:B2");
		$this->excel->getActiveSheet()->mergeCells("C1:C2");
		
		$i="D";
		foreach($slownik_zb as $row){
			$zb_pozycja[$row["id"]] = $i;
			$this->excel->getActiveSheet()->setCellValue("".$i."2",$row["nazwa"]);
			$koniec = $i++;
			$this->excel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
		}
		$this->excel->getActiveSheet()->mergeCells("D1:".$koniec."1");
		$koniec++;
		$poczatek = $koniec;
		$i = $poczatek;
		
		foreach($slownik_si as $row){
			$si_pozycja[$row["id"]] = $i;
			$this->excel->getActiveSheet()->setCellValue("".$i."2",$row["nazwa"]);
			$koniec = $i++;
			if(strlen($row["nazwa"]) < 10 )
			$this->excel->getActiveSheet()->getColumnDimension($i)->setWidth(10);
			else
			$this->excel->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
		}
		
		
		$this->excel->getActiveSheet()->mergeCells("".$poczatek."1:".$koniec."1");
		$this->excel->getActiveSheet()->setCellValue("".$poczatek."1",'Systemy informatyczne');
 		$koniec++;
		$poczatek = $koniec;
		$koniec++;
		$data_od = $poczatek;
		$data_do = $koniec;
		$this->excel->getActiveSheet()->mergeCells("".$data_od."1:".$data_do."1");
		$this->excel->getActiveSheet()->setCellValue("".$data_od."1",'Okres obowiązywania');
		$this->excel->getActiveSheet()->setCellValue("".$data_od."2",'Data od');
		$this->excel->getActiveSheet()->setCellValue("".$data_do."2",'Data do');
		$this->excel->getActiveSheet()->getColumnDimension($data_od)->setAutoSize(true);
		$this->excel->getActiveSheet()->getColumnDimension($data_do)->setAutoSize(true);

		$tabela_up = array('NR Upoważnienia', 'DZIAŁ','PRACOWNIK','Zbiory');
			
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);		
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		
		
		for($i=0;$i<count($tabela_up);$i++)
		{
		$this->excel->getActiveSheet()->setCellValueByColumnAndRow($i,1,$tabela_up[$i]);
		}
				
		$q = $this->Upo_model->upo_by_zaklad_asi($this->uri->segment(3));
		$w=2;$k=1;
		foreach($q->result() as $row)
		{
			if(!isset($poprzednie_nazwisko))
				{
					$poprzednie_nazwisko = $row->nr;
					$w++;
					$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0,$w,$row->nr);
					$this->excel->getActiveSheet()->setCellValueByColumnAndRow(1,$w,@$row->miejsce);
					$this->excel->getActiveSheet()->setCellValueByColumnAndRow(2,$w,$row->nazwiskoimie);
					$this->excel->getActiveSheet()->setCellValue($data_od.$w,$row->data_od);
					$this->excel->getActiveSheet()->setCellValue($data_do.$w,$row->data_do);
					$this->excel->getActiveSheet()->getStyle('A'.$w.':'.$data_do.$w)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				}
			else
				{
					if($poprzednie_nazwisko == $row->nr)
						{
							if($row->ASI != NULL)
								$this->excel->getActiveSheet()->setCellValue("".$si_pozycja[$row->ASI].$w,@$row->ASI_zakres);
						}
					 else
					{
						$poprzednie_nazwisko = $row->nr;
						$w++;
						$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0,$w,$row->nr);
						$this->excel->getActiveSheet()->setCellValueByColumnAndRow(1,$w,@$row->miejsce);
						$this->excel->getActiveSheet()->setCellValueByColumnAndRow(2,$w,$row->nazwiskoimie);
						if($row->ASI_zakres != NULL)
						try {
						$this->excel->getActiveSheet()->setCellValue("".@$si_pozycja[$row->ASI].$w,@$row->ASI_zakres);
                                                }
						catch (Exception $e) {
                                                        echo '';
                                                }
						$this->excel->getActiveSheet()->setCellValue($data_od.$w,$row->data_od);
                                                $this->excel->getActiveSheet()->setCellValue($data_do.$w,$row->data_do);
                                                $this->excel->getActiveSheet()->getStyle('A'.$w.':'.$data_do.$w)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

					}
				}
			}
			
			$q = $this->Upo_model->upo_by_zaklad_abi($this->uri->segment(3));
			$w=2;$k=1;
			foreach($q->result() as $row)
			{
				if(!isset($poprzednie_nazwisko))
					{
						$poprzednie_nazwisko = $row->nr;
						$w++;
					}
				else
					{
						if($poprzednie_nazwisko == $row->nr)
							{
								if($row->ABI != NULL)
								{ try {
								$this->excel->getActiveSheet()->setCellValue("".@$zb_pozycja[$row->ABI].$w,@$row->ABI_zakres);
								} catch (Exception $e) { continue; } }
							}
						else
						{
							$poprzednie_nazwisko = $row->nr;
							$w++;
							if($row->ABI != NULL)
							$this->excel->getActiveSheet()->setCellValue("".$zb_pozycja[$row->ABI].$w,@$row->ABI_zakres);
						}
					}
				}
			
			$this->excel->getActiveSheet()->getStyle('A1:'.$data_do.'2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$this->excel->getActiveSheet()->getStyle("A1:".$data_do."2")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle("A1")->getAlignment()->setWrapText(true);

			for($col = 'D'; $col !== $data_do; $col++) {
			    $this->excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			}
		$filename='rejestr_upowaznien.xls';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
		
	}
	
public function struktury_zbiorow()
		{		
			if($this->session->userdata("zaklad") > 0 and $this->uri->segment(3) != $this->session->userdata("zaklad"))
			{
				$this->session->set_userdata("error","Brak dostępu!");
				redirect('/rejestry', 'refresh');
			}
			
			$this->load->library('tcpdf');
			$this->load->library('fpdi');
			
			$id_zaklad = (int)$this->uri->segment(3);			
			$q = $this->Zbiory_model->pobierz_zbiory_z_zakladu($id_zaklad);
			
			$pdf = new FPDI(); 

		   $data["zbiory"] = $q->result_array();
			$pdf->SetFont('dejavusans', '', '10', '',true);
			$pdf->setFontSubsetting(false);
			$pdf->SetPrintHeader(false);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
			$pdf->AddPage(); 
			$html = $this->load->view("pdf/pdf_struktury_zbiorow",$data,true);
			@$pdf->writeHTML($html, true, false, true, false, '');
			ob_end_clean();
			$pdf->Output('Opis_struktury_zbiorow_danych.pdf', 'D'); 

		}

public function struktury_zbiorow_zab()
			{		
				if($this->session->userdata("zaklad") > 0 and $this->uri->segment(3) != $this->session->userdata("zaklad"))
				{
					$this->session->set_userdata("error","Brak dostępu!");
					redirect('/rejestry', 'refresh');
				}
				$this->load->library('tcpdf');
				$this->load->library('fpdi');
			
				$id_zaklad = (int)$this->uri->segment(3);			
				$q = $this->Zbiory_model->pobierz_zbiory_zab_z_zakladu($id_zaklad);

				$pdf = new FPDI(); 

			   $data["zbiory"] = $q->result_array();
				$pdf->SetFont('dejavusans', '', '9', '',true);
				$pdf->setFontSubsetting(false);
				$pdf->SetPrintHeader(false);
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
				$pdf->AddPage('L'); 
				$html = $this->load->view("pdf/pdf_struktury_zbiorow_zab",$data,true);
				@$pdf->writeHTML($html, true, false, true, false, '');
				ob_end_clean();
				$pdf->Output('Opis_zabezpieczen_zbiorow_danych.pdf', 'D'); 

			}

public function rejestr_pz_pdf()
			{	
				if($this->session->userdata("zaklad") > 0 and $this->uri->segment(3) != $this->session->userdata("zaklad"))
				{
					$this->session->set_userdata("error","Brak dostępu!");
					redirect('/rejestry', 'refresh');
				}
					
				$this->load->library('tcpdf');
				$this->load->library('fpdi');
			
				$id_zaklad = (int)$this->uri->segment(3);			
				$pdf = new FPDI(); 

				$q=$this->Rejestry_model->pobierz_rej_pz($id_zaklad);
				$data["rejestr"] = $q->result_array();
				$pdf->SetFont('dejavusans', '', '10', '',true);
				$pdf->setFontSubsetting(false);
				$pdf->SetPrintHeader(false);
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
				$pdf->AddPage('L'); 
				$html = $this->load->view("pdf/pdf_rejestr_pz",$data,true);
				@$pdf->writeHTML($html, true, false, true, false, '');
				ob_end_clean();
				$pdf->Output('Rejestr_PZ.pdf', 'D');
			}

public function rejestr_ud_pdf()
			{	
				if($this->session->userdata("zaklad") > 0 and $this->uri->segment(3) != $this->session->userdata("zaklad"))
				{
					$this->session->set_userdata("error","Brak dostępu!");
					redirect('/rejestry', 'refresh');
				}
					
				$this->load->library('tcpdf');
				$this->load->library('fpdi');
				$zip = new ZipArchive();

				$id_zaklad = (int)$this->uri->segment(3);
                                $q=$this->Rejestry_model->pobierz_rej_ud($id_zaklad);
                                $res = $q->result_array();

				if (count($res) > 100 ){
		                 $filename = "/tmp/Rejestr_UD_".$id_zaklad.".zip";
                                 @unlink($filename);
                                 @array_map('unlink', glob("/tmp/Rejestr_UD_*.pdf"));
                                 $zip->open($filename, ZipArchive::CREATE);

				 $suma = count($res);
				 $start = 1;
				 $ile = 100;
				 for($start;$start<=$suma;$start=$start+$ile){
				  $q=$this->Rejestry_model->pobierz_rej_ud($id_zaklad,$start,$ile);
                                  $data["rejestr"] = $q->result_array();
				  $data["lp"] = $start;
                                  $pdf = new FPDI();
                                  $pdf->SetFont('dejavusans', '', '10', '',true);
                                  $pdf->setFontSubsetting(false);
                                  $pdf->SetPrintHeader(false);
                                  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                                  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                                  $pdf->AddPage('L');
                                  $html = $this->load->view("pdf/pdf_rejestr_ud",$data,true);
                                  $pdf->writeHTML($html, true, false, true, false, '');
				  $pdf->lastPage();
                                  
								  ob_end_clean();
				  $pdf->Output('/tmp/Rejestr_UD_'.$id_zaklad.'_'.$start.'.pdf', 'F');
    				  $zip->addFile('/tmp/Rejestr_UD_'.$id_zaklad.'_'.$start.'.pdf','Rejestr_UD_'.$id_zaklad.'_'.$start.'.pdf');
				 }
                                $zip->close();

                                header('Content-type: application/zip');
                                header('Content-Disposition: attachment; filename="Rejestr_UD_'.$id_zaklad.'.zip"');
                                readfile($filename);

				}
				else{
  				  $start = 1;
        	                  $ile = 100;

				  $q=$this->Rejestry_model->pobierz_rej_ud($id_zaklad,$start,$ile);
                                  $data["rejestr"] = $q->result_array();
                                  $data["lp"] = $start;
                                  $pdf = new FPDI();
                                  $pdf->SetFont('dejavusans', '', '10', '',true);
                                  $pdf->setFontSubsetting(false);
                                  $pdf->SetPrintHeader(false);
                                  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                                  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                                  $pdf->AddPage('L');
                                  $html = $this->load->view("pdf/pdf_rejestr_ud",$data,true);
                                  $pdf->writeHTML($html, true, false, true, false, '');
                                  $pdf->lastPage();
								  ob_end_clean();
                                  $pdf->Output('Rejestr_UD.pdf', 'D');

				}	
			}


public function rejestr_unk_pdf()
			{	
				if($this->session->userdata("zaklad") > 0 and $this->uri->segment(3) != $this->session->userdata("zaklad"))
				{
					$this->session->set_userdata("error","Brak dostępu!");
					redirect('/rejestry', 'refresh');
				}	
				$this->load->library('tcpdf');
				$this->load->library('fpdi');
		
				$id_zaklad = (int)$this->uri->segment(3);			
				$pdf = new FPDI(); 

				$q=$this->Rejestry_model->pobierz_rej_unk($id_zaklad);
				$data["rejestr"] = $q->result_array();
				$pdf->SetFont('dejavusans', '', '10', '',true);
				$pdf->setFontSubsetting(false);
				$pdf->SetPrintHeader(false);
				$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
				$pdf->AddPage('L'); 
				$html = $this->load->view("pdf/pdf_rejestr_unk",$data,true);
				@$pdf->writeHTML($html, true, false, true, false, '');
				ob_end_clean();
				$pdf->Output('Rejestr_UNK.pdf', 'D');
			}
public function rejestr_umow_pdf()
		{	
			if($this->session->userdata("zaklad") > 0 and $this->uri->segment(3) != $this->session->userdata("zaklad"))
			{
				$this->session->set_userdata("error","Brak dostępu!");
				redirect('/rejestry', 'refresh');
			}	
			$this->load->library('tcpdf');
			$this->load->library('fpdi');

			$id_zaklad = (int)$this->uri->segment(3);			
			$pdf = new FPDI(); 

			$q=$this->Rejestry_model->pobierz_rej_umow($id_zaklad);
			$data["rejestr"] = $q->result_array();
			$pdf->SetFont('dejavusans', '', '10', '',true);
			$pdf->setFontSubsetting(false);
			$pdf->SetPrintHeader(false);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);				
			$pdf->AddPage('L'); 
			$html = $this->load->view("pdf/pdf_rejestr_umow",$data,true);
			@$pdf->writeHTML($html, true, false, true, false, '');
			ob_end_clean();
			$pdf->Output('Rejestr_umow.pdf', 'D');
		}
		
public function rejestr_pz()
		{
			check_perm($this->session->userdata("id"),$this->uri->segment(2));
			$this->breadcrumbs->push('Rejestr podmiotów zewnętrznych', 'rejestry/rejestr_pz');
			
			$data_head["breadcrumbs"] = $this->breadcrumbs->show();
			$this->load->view('head',$data_head);
			$this->load->view("menu_admin",menu_acl($this->session->userdata("id")));
		
			$data["error"] = $this->session->userdata("error");
			$this->session->unset_userdata('error');
			$data["msg"] = $this->session->userdata("msg");
			$this->session->unset_userdata('msg');
			
			if($this->uri->segment(3) == "dodaj")
			{
				
					$this->Rejestry_model->dodaj_rpz($this->input->post("nazwa"),$this->input->post("zaklad"),$this->input->post("zakres"),
				$this->input->post("nr_umowy"), $this->input->post("uwagi"));
					$this->session->set_userdata("msg","Dodano nową pozycję w rejstrze!");
					redirect("rejestry/rejestr_pz/","refresh");
			}
			
			if($this->uri->segment(3) == "update" && is_numeric($this->uri->segment(4)) )
			{
				$this->Slowniki_model->aktualizuj_pozycje($this->uri->segment(4));
				$this->session->set_userdata("msg","Zapisano zmiany!");
						redirect("rejestry/rejestr_pz/","refresh");
			}
			
			if($this->uri->segment(3) == "usun" && is_numeric($this->uri->segment(4)))
				{
					$ans = $this->Rejestr_model->usun_rpz($this->uri->segment(4));
					if($ans == "error")
						$this->session->set_userdata("error","Błąd usuwania pozycji!");
					else
						$this->session->set_userdata("msg","Usunięto pozycję!");
					redirect("rejestry/rejestr_pz/","refresh");
				}
				
			if($this->uri->segment(3) == "edytuj" && is_numeric($this->uri->segment(4)) && is_numeric($this->uri->segment(5)))
			{	
				$q=$this->Slowniki_model->element($this->uri->segment(4),$this->uri->segment(5));
				$data["row"] = $q->row_array();
				$data["id"] = $this->uri->segment(4);
				$this->load->view("slowniki/slo_edytuj",$data);
			}
			else
			{
			$data["a"] = $this->uri->segment(3);
			$q=$this->Zaklady_model->spis_zakladow($this->session->userdata("zaklad"));
			$data["zaklady"] = $q->result_array();
			$this->load->view("rejestry/rej_pz_dodaj",$data);
			$q=$this->Rejestry_model->pobierz_rej_pz($this->session->userdata("zaklad"));
			$data["rejestr"] = $q->result_array();
			
		
				if($q->num_rows() > 0)
				{
					$this->load->view("rejestry/rej_pz_index",$data);
				}
				else
				{
					$data['tresc'] = '<div class="alert alert-danger" role="alert" id="errorMsg">Brak wyników wyszukiwania</div></div>';
				}
						
				
					$this->load->view("motyw_new",$data);	
			}		
		
		}
}
?>
