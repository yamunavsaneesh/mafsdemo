<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
	var $CI;
	function createpdf($html,$pdfname,$title,$output='F'){ 
		$ci = get_instance(); 
		try {
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false); 
			$pdf->SetTitle($title);
			$pdf->setPrintHeader(false);
			$pdf->SetAutoPageBreak(true);
			$pdf->SetAuthor($ci->config->item('app_title'));
			$lg = Array();
			$lg['a_meta_charset'] = 'UTF-8'; 
			$pdf->setLanguageArray($lg);
			$pdf->SetMargins(PDF_MARGIN_LEFT,5, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(5);
			$pdf->SetFooterMargin(10);   
			$pdf->SetAutoPageBreak(TRUE, 25);           
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			//$pdf->SetFont('dejavusans', '', 11);
			$pdf->AddPage(); 
			$pdf->WriteHTML($html, true, 0, true, 0);
			$pdf->Output(FCPATH.$pdfname, $output);
		}
		catch(TCPDF_exception $e) {
			return $e;exit;
		} 
    }
}
