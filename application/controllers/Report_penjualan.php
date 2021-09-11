<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_penjualan extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url("/"));
		}
	}

	public function index()
	{
		$data=array(
			'judul' => 'Report Penjualan'
	);
		$this->load->view('report_penjualan/index',$data);

	}
	

	public function getreport()
	{


		$sql = "SELECT tr_so_h.*, ms_customer.nama_customer 
				FROM
				tr_so_h
				INNER JOIN ms_customer ON ms_customer.id = tr_so_h.customer_so
				WHERE tr_so_h.tgl_so BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'";

		$result = $this->db->query($sql)->result_array();
		echo json_encode($result);
	}


}
