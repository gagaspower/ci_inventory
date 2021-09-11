<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
		   if($this->session->userdata('login') !== TRUE){
			redirect(base_url("/"));
		   }

	}
	public function index()
	{
		$sql_pemasukan = $this->db->query("select sum(nilai_trx) as pemasukan_hari_ini from tr_trx where jenis_trx_id = 1 and tgl_trx = CURDATE()")->row();
		$sql_pengeluaran = $this->db->query("select sum(nilai_trx) as pengeluaran_hari_ini from tr_trx where jenis_trx_id = 2 and tgl_trx = CURDATE()")->row();



		$sql = "SELECT SUM(IF(tr_trx.jenis_trx_id=1,tr_trx.nilai_trx,0)) AS pendapatan, SUM(IF(tr_trx.jenis_trx_id=2,tr_trx.nilai_trx,0)) AS pengeluaran, ms_periode.bulan_periode as periode
				FROM tr_trx
				LEFT JOIN ms_periode ON ms_periode.id = tr_trx.periode_trx_id 
				WHERE ms_periode.tahun_periode = date('Y')
				GROUP BY tr_trx.periode_trx_id
				ORDER BY ms_periode.id ASC";
		  // echo $sql;exit;
		$rs = $this->db->query($sql)->result();



		$data = array(
			'welcome' => 'Selamat Datang <b> ' .$this->session->userdata('nama'). ' </b> Sistem inventory',
			'sum_pemasukan' 	=> $sql_pemasukan->pemasukan_hari_ini,
			'sum_pengeluaran' 	=> $sql_pengeluaran->pengeluaran_hari_ini,
			'saldo' 			=> $sql_pemasukan->pemasukan_hari_ini - $sql_pengeluaran->pengeluaran_hari_ini,
			'charts' 			=> json_encode($rs)
		);
		$this->load->view('home',$data);

    }

	public function grafik()
	{

	
	}
}
