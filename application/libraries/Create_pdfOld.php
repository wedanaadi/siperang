<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/mpdf/mpdf.php';

if (!defined('_MPDF_PATH')) define('_MPDF_PATH', APPPATH . 'libraries/mpdf/');

class Create_pdf {


	// function Create_pdf()
	public function __construct()
	{
		$CI = & get_instance();
		
	}


	function load($html,$namafile,$ukuran){

		$mpdf =  new mPDF('utf-8', $ukuran);
	
		$mpdf->SetTitle($namafile);
		$mpdf->SetHTMLFooter('
					<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;"><tr>
					<td width="33%"> <img style="width: 70px; " src="' . base_url() . '> </td>
					<td width="33%" align="right" style="font-weight: bold; ">{PAGENO}/{nbpg}</td>
					</tr></table>');

		$mpdf->WriteHTML($html);
		$mpdf->Output(); 

	}

}