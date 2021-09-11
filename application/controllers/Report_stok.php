<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_stok extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url("/"));
		}
	}

	public function index()
	{
		$data=array(
			'judul' => 'Report Stok',
			'items' => $this->db->get('ms_barang')->result_array()
	);
		$this->load->view('report_stok/index',$data);

	}
	

	public function getreport()
	{

		if($this->input->post('item_id') == ""){
			$sql = "SELECT ms_barang.*,
					(SUM(IF(ms_kartu_stok.type_dokumen='GR',ms_kartu_stok.item_qty,0)) - SUM(IF(ms_kartu_stok.type_dokumen='SO',ms_kartu_stok.item_qty,0))) as stok
					FROM 
					ms_barang
					LEFT JOIN ms_kartu_stok ON ms_barang.id = ms_kartu_Stok.item_id
					WHERE ms_kartu_stok.tgl_dokumen BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'
					GROUP BY ms_barang.id";
		}else{
			$sql = "SELECT ms_barang.*,
					(SUM(IF(ms_kartu_stok.type_dokumen='GR',ms_kartu_stok.item_qty,0)) - SUM(IF(ms_kartu_stok.type_dokumen='SO',ms_kartu_stok.item_qty,0))) as stok
					FROM 
					ms_barang
					LEFT JOIN ms_kartu_stok ON ms_barang.id = ms_kartu_Stok.item_id
					WHERE ms_kartu_stok.tgl_dokumen BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'
					AND ms_barang.id = '".$this->input->post('item_id')."'
					GROUP BY ms_barang.id";
		}


		$result = $this->db->query($sql)->result_array();
		echo json_encode($result);
	}


}
