<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_item_masuk extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url("/"));
		}
	}

	public function index()
	{
		$data=array(
			'judul' => 'Report Stok Masuk'
	);
		$this->load->view('report_item_masuk/index',$data);

	}
	

	public function getreport()
	{
		$sql = "SELECT tr_gr_h.*
				FROM
				tr_gr_h
				INNER JOIN tr_gr_d ON tr_gr_d.gr_id = tr_gr_h.id
				WHERE tr_gr_h.tgl_gr BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'";

		$result = $this->db->query($sql)->result_array();
		echo json_encode($result);
	}


}
