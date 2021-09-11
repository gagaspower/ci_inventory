<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_pemesanan extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url("/"));
		}
	}

	public function index()
	{
		$data=array(
			'judul' => 'Report Pemesanan Barang'
	);
		$this->load->view('report_pemesanan/index',$data);

	}
	

	public function getreport()
	{


		$sql = "SELECT tr_po_h.*, ms_suplier.nama_suplier 
				FROM
				tr_po_h
				INNER JOIN ms_suplier ON ms_suplier.id = tr_po_h.suplier_po
				WHERE tr_po_h.tgl_po BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'";

		$result = $this->db->query($sql)->result_array();
		echo json_encode($result);
	}


}
