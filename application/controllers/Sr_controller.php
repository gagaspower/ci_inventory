<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sr_controller extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url());
		}
	}


	public function index()
	{

		$data = array(
				'judul' => 'Sales Retur'
		);
		$this->load->view('tr_sr/index',$data);
		

	}

	public function show()
	{

		$gr = "SELECT tr_sr_h.*, 
					tr_sr_d.sr_id, 
					tr_sr_d.sr_item_id,
					tr_sr_d.sr_harga_beli_item,
					tr_sr_d.sr_harga_jual_item,
					tr_sr_d.sr_item_qty,
					ms_barang.kode_barang,
					ms_barang.nama_barang,
					ms_customer.nama_customer,
					tr_sr_d.sr_item_id
					FROM tr_sr_h
					INNER JOIN tr_sr_d ON tr_sr_h.id = tr_sr_d.sr_id 
					INNER JOIN ms_barang ON ms_barang.id = tr_sr_d.sr_item_id
					INNER JOIN ms_customer ON ms_customer.id = tr_sr_h.customer_sr
					WHERE tr_sr_h.tgl_sr BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'";
		$result = $this->db->query($gr)->result();
		echo json_encode($result);
	}
	

	public function create()
	{

		$this->db->select('RIGHT(tr_sr_h.kode_sr,5) as kode_sr', FALSE);
		$this->db->order_by('kode_sr','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('tr_sr_h');
			if($query->num_rows() <> 0){      
				 $data = $query->row_array();
				 $kode = intval($data['kode_sr']) + 1; 
			}
			else{      
				 $kode = 1;  
			}
		$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);  


		$data = array(
			'judul' 	=> 'Tambah SR',
			'kode_sr' 	=> 'TRX-SR-'.$batas,
			'customers' => $this->db->get('ms_customer')->result_array(),
			'items' 	=> $this->db->get('ms_barang')->result_array(),

		);
		$this->load->view('tr_sr/create',$data);
	 }



	public function cari_so()
	{
		$po = "SELECT
			    tr_so_h.id as so_id, 
				tr_so_h.kode_so,
				tr_so_d.so_item_id as sr_item_id,
				tr_so_d.so_item_qty - ifnull(tr_sr_d.sr_item_qty,0) AS sr_item_qty,
				tr_so_d.so_item_harga_beli as sr_harga_beli_item,
				tr_so_d.so_item_harga_jual as sr_harga_jual_item,
				tr_so_d.so_item_harga_jual * (tr_so_d.so_item_qty - ifnull(tr_sr_d.sr_item_qty,0) ) as sr_total_harga_jual,
				tr_so_d.so_item_harga_beli * (tr_so_d.so_item_qty - ifnull(tr_sr_d.sr_item_qty,0) ) as sr_total_harga_beli,
				ms_barang.kode_barang,
				ms_barang.nama_barang
				FROM tr_so_h
				LEFT JOIN tr_so_d ON tr_so_d.so_id = tr_so_h.id
				LEFT JOIN ms_barang ON ms_barang.id = tr_so_d.so_item_id
				LEFT JOIN tr_sr_d ON tr_sr_d.sr_so_id = tr_so_d.so_id AND tr_sr_d.sr_item_id = tr_so_d.so_item_id
				WHERE 
				tr_so_h.tgl_so BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'
				AND tr_so_h.customer_so = '".$this->input->post('customer_so')."'
				AND (tr_so_d.so_item_qty - ifnull(tr_sr_d.sr_item_qty,0) ) > 0
				GROUP BY tr_so_d.so_item_id, tr_so_h.id";
		
		$result = $this->db->query($po)->result();
		echo json_encode($result);
	}
	 

	public function store()
	{
		try {
			$data = array(
				'kode_sr' 		=> htmlentities($this->input->post('kode_sr')),
				'tgl_sr' 		=> $this->input->post('tgl_sr'),
				'customer_sr'	=> $this->input->post('customer_sr'),
				'keterangan_sr'	=> htmlentities($this->input->post('keterangan_sr')),
				'total_harga_beli_sr'	=> htmlentities($this->input->post('sr_total_harga_beli')),
				'total_harga_jual_sr'	=> htmlentities($this->input->post('sr_total_harga_jual')),
				'user_id' 	=> $this->session->userdata('user_id')
		);

		$this->db->set($data);
		$save = $this->db->insert('tr_sr_h');
		if($save){
			$insert_id = $this->db->insert_id();
			foreach($this->input->post('item') as $detail){
				$data2 = array(
					'sr_id' 		=> $insert_id,
					'sr_so_id' 		=> $detail['so_id'],
					'sr_item_id' 	=> $detail['sr_item_id'],
					'sr_item_qty' 	=> $detail['sr_item_qty'],
					'sr_harga_beli_item'=>$detail['sr_harga_beli_item'],
					'sr_harga_jual_item'=> $detail['sr_harga_jual_item']
				);
				$this->db->set($data2);
				$this->db->insert('tr_sr_d');

				// catat stok
				$data3 = array(
					'tgl_dokumen' => $this->input->post('tgl_sr'), 
					'kode_dokumen' => $this->input->post('kode_sr'),
					'type_dokumen' => 'SR',
					'item_id' 	   => $detail['sr_item_id'],
					'item_qty' 	   => $detail['sr_item_qty']
				);
				$this->db->set($data3);
				$this->db->insert('ms_kartu_stok');

			}
		} else {
			echo json_encode('Could not created data');
		}
			echo json_encode([
				'success' => "created Data Berhasil",
				'kode_sr' => $this->input->post('kode_sr')
			]);
		} 
		catch ( Exception $e ){
			echo json_encode('Could not created data');
		}


	}



	public function edit()
	{
			$data = array(
					'judul' 		=> 'Edit SR',			
					'customers' => $this->db->get('ms_customer')->result_array(),
					'items' 	=> $this->db->get('ms_barang')->result_array(),

			);
			$this->load->view('tr_sr/edit',$data);
	}


	public function cari_so_edit()
	{
		// var_dump($this->uri->segment('3'));exit;
		$po = "SELECT
				tr_so_h.id as so_id, 
				tr_so_h.kode_so,
				tr_so_d.so_item_id as sr_item_id,
				(tr_so_d.so_item_qty -ifnull(tr_sr_d.sr_item_qty,0) ) + ifnull(tr_sr_d.sr_item_qty,0) AS sr_item_qty,
				tr_so_d.so_item_harga_beli as sr_harga_beli_item,
				tr_so_d.so_item_harga_jual as sr_harga_jual_item,
				tr_so_d.so_item_harga_jual * ((tr_so_d.so_item_qty -ifnull(tr_sr_d.sr_item_qty,0) ) + ifnull(tr_sr_d.sr_item_qty,0) ) as sr_total_harga_jual,
				tr_so_d.so_item_harga_beli * ((tr_so_d.so_item_qty -ifnull(tr_sr_d.sr_item_qty,0) ) + ifnull(tr_sr_d.sr_item_qty,0) ) as sr_total_harga_beli,
				ms_barang.kode_barang,
				ms_barang.nama_barang
				FROM tr_so_h
				LEFT JOIN tr_so_d ON tr_so_d.so_id = tr_so_h.id
				LEFT JOIN ms_barang ON ms_barang.id = tr_so_d.so_item_id
				LEFT JOIN tr_sr_d ON tr_sr_d.sr_so_id = tr_so_d.so_id AND tr_sr_d.sr_item_id = tr_so_d.so_item_id and tr_sr_d.sr_id <> '".$this->input->post('id')."'
				WHERE 
				tr_so_h.tgl_so BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'
				AND tr_so_h.customer_so = '".$this->input->post('customer_so')."'
				AND (tr_so_d.so_item_qty - ifnull(tr_sr_d.sr_item_qty,0) ) > 0
				GROUP BY tr_so_d.so_item_id, tr_so_h.id";
		
		$result = $this->db->query($po)->result_array();
		echo json_encode($result);
	}



	public function show_edit()
	{
		$po = "SELECT
				tr_sr_h.*,
				tr_so_h.id as so_id, 
				tr_so_h.kode_so,
				tr_sr_d.sr_item_id,
				tr_sr_d.sr_item_qty,
				tr_sr_d.sr_harga_beli_item,
				tr_sr_d.sr_harga_jual_item,
				tr_sr_d.sr_harga_jual_item * tr_sr_d.sr_item_qty as sr_total_harga_jual,
				tr_sr_d.sr_harga_beli_item * tr_sr_d.sr_item_qty as sr_total_harga_beli,
				ms_barang.kode_barang,
				ms_barang.nama_barang
				FROM tr_so_h
				INNER JOIN tr_so_d ON tr_so_d.so_id = tr_so_h.id
				INNER JOIN ms_barang ON ms_barang.id = tr_so_d.so_item_id
				LEFT JOIN tr_sr_d ON tr_sr_d.sr_so_id = tr_so_d.so_id AND tr_sr_d.sr_item_id = tr_so_d.so_item_id
				INNER JOIN tr_sr_h ON tr_sr_h.id = tr_sr_d.sr_id
				WHERE tr_sr_h.id = '".$this->uri->segment('3')."'";

		$result = $this->db->query($po)->result();
		echo json_encode($result);
	}
    

    public function update()
    {
		try {
			$data = array(
				'kode_sr' 		=> htmlentities($this->input->post('kode_sr')),
				'tgl_sr' 		=> $this->input->post('tgl_sr'),
				'customer_sr'	=> $this->input->post('customer_sr'),
				'keterangan_sr'	=> htmlentities($this->input->post('keterangan_sr')),
				'total_harga_beli_sr'	=> htmlentities($this->input->post('sr_total_harga_beli')),
				'total_harga_jual_sr'	=> htmlentities($this->input->post('sr_total_harga_jual')),
				'user_id' 	=> $this->session->userdata('user_id')
		);

		$this->db->set($data);
		$this->db->where('id',$this->input->post('id'));
		$save = $this->db->update('tr_sr_h');
		if($save){
			$this->db->delete('tr_sr_d',array('sr_id' => $this->input->post('id')));
			$this->db->delete('ms_kartu_stok',array('kode_dokumen' => $this->input->post('kode_sr')));
			foreach($this->input->post('item') as $detail){
				$data2 = array(
					'sr_id' 		=> $insert_id,
					'sr_so_id' 		=> $detail['so_id'],
					'sr_item_id' 	=> $detail['sr_item_id'],
					'sr_item_qty' 	=> $detail['sr_item_qty'],
					'sr_harga_beli_item'=>$detail['sr_harga_beli_item'],
					'sr_harga_jual_item'=> $detail['sr_harga_jual_item']
				);
				$this->db->set($data2);
				$this->db->insert('tr_sr_d');


				// catat stok
				$data3 = array(
					'tgl_dokumen' => $this->input->post('tgl_sr'), 
					'kode_dokumen' => $this->input->post('kode_sr'),
					'type_dokumen' => 'SR',
					'item_id' 	   => $detail['sr_item_id'],
					'item_qty' 	   => $detail['sr_item_qty']
				);
				$this->db->set($data3);
				$this->db->insert('ms_kartu_stok');

			}
		} else {
			echo json_encode('Could not created data');
		}
			echo json_encode([
				'success' => "created Data Berhasil",
				'kode_sr' => $this->input->post('kode_sr')
			]);
		} 
		catch ( Exception $e ){
			echo json_encode('Could not created data');
		}

	}
	

	public function delete()
	{

		// cek kartu stok
		$cek = $this->db->query("SELECT kode_sr FROM tr_sr_h where id = '".$this->input->post('id')."'")->row_array();
		if($cek){
			$this->db->query("DELETE FROM ms_kartu_stok WHERE kode_dokumen = '".$cek['kode_sr']."'");
			$this->db->delete('tr_sr_h', array('id' =>  $this->input->post('id')));
			$this->db->delete('tr_sr_d',array('sr_id' => $this->input->post('id')));
		}
		echo json_encode('Data Berhasil dihapus');
	}



}
