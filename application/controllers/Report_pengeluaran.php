<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_pengeluaran extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url("/"));
		}
	}

	public function index()
	{
		$data=array(
			'judul' => 'Report Pengeluaran',
	);
		$this->load->view('report_pengeluaran/index',$data);

	}
	

	public function getreport()
	{
        $sql = "SELECT 
                    tr_trx.id,
                    tr_trx.kode_trx,
                    tr_trx.tgl_trx,
                    tr_trx.detail_trx,
                    tr_trx.nilai_trx
                    FROM 
                    tr_trx
                    WHERE tr_trx.tgl_trx BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'
                    AND tr_trx.jenis_trx_id = 2";

		$result = $this->db->query($sql)->result_array();
		echo json_encode($result);
	}


}
