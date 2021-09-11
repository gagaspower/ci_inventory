<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_labarugi extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url("/"));
		}
	}

	public function index()
	{
		$data=array(
			'judul' => 'Report Laba/Rugi',
	);
		$this->load->view('report_laba_rugi/index',$data);

	}
	

	public function getreport()
	{
		// data pendapatan
        $sql = "SELECT 
                    tr_trx.id,
                    tr_trx.kode_trx,
                    tr_trx.tgl_trx,
                    tr_trx.detail_trx,
                    tr_trx.nilai_trx,
					tr_trx.jenis_trx_id
                    FROM 
                    tr_trx
                    WHERE tr_trx.tgl_trx BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'
                    AND tr_trx.jenis_trx_id = 1";

		// data pengeluaran atau beban
		$sql2 = "SELECT 
                    tr_trx.id,
                    tr_trx.kode_trx,
                    tr_trx.tgl_trx,
                    tr_trx.detail_trx,
                    tr_trx.nilai_trx,
					tr_trx.jenis_trx_id
                    FROM 
                    tr_trx
                    WHERE tr_trx.tgl_trx BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'
                    AND tr_trx.jenis_trx_id = 2";


		$sql_sum_pendapatan = $this->db->query("SELECT SUM(nilai_trx) as total_pendapatan FROM tr_trx WHERE tr_trx.tgl_trx BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'
												AND tr_trx.jenis_trx_id = 1")->row();

		$sql_sum_pengeluaran = $this->db->query("SELECT SUM(nilai_trx) as total_pengeluaran FROM tr_trx WHERE tr_trx.tgl_trx BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'
												AND tr_trx.jenis_trx_id = 2")->row();
		$result = $this->db->query($sql)->result_array();
		$result2 = $this->db->query($sql2)->result_array();

		echo json_encode(['pendapatans' => $result, 'pengeluarans' => $result2, 'total_pendapatan' => $sql_sum_pendapatan->total_pendapatan, 'total_pengeluaran' => $sql_sum_pengeluaran->total_pengeluaran]);
	}


}
