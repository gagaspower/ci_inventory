<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class So_controller extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->db->select('tr_so_h.*,ms_customer.nama_customer');
		$this->db->from('tr_so_h');
		$this->db->join('ms_customer', 'ms_customer.id = tr_so_h.customer_so');
		$data = array(
				'judul' => 'Sales Order',
				'sos' => $this->db->get()->result_array()
		);
		$this->load->view('tr_so/index',$data);
		

	}


	public function show()
	{

		$po = "SELECT tr_so_h.*, 
									   tr_so_d.so_id, 
									   tr_so_d.so_item_id,
									   tr_so_d.so_item_harga_beli as so_harga_beli_item,
									   tr_so_d.so_item_harga_jual as so_harga_jual_item,
									   tr_so_d.so_item_qty,
									   ms_barang.kode_barang,
									   ms_barang.nama_barang,
									   ms_customer.nama_customer ,
									   tr_so_d.so_item_id
									   FROM tr_so_h
									   INNER JOIN tr_so_d ON tr_so_h.id = tr_so_d.so_id 
									   INNER JOIN ms_barang ON ms_barang.id = tr_so_d.so_item_id
									   INNER JOIN ms_customer ON ms_customer.id = tr_so_h.customer_so
									   WHERE tr_so_h.tgl_so BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'";
		$result = $this->db->query($po)->result();
		echo json_encode($result);
	}
	

	public function create()
	{

		$this->db->select('RIGHT(tr_so_h.kode_so,5) as kode_so', FALSE);
		$this->db->order_by('kode_so','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('tr_so_h');
			if($query->num_rows() <> 0){      
				 $data = $query->row_array();
				 $kode = intval($data['kode_so']) + 1; 
			}
			else{      
				 $kode = 1;  
			}
		$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);  


		$data = array(
			'judul' 	=> 'Tambah PO',
			'kode_so' 	=> 'TRX-SO-'.$batas,
			'customers' => $this->db->get('ms_customer')->result_array(),
			'items' 	=> $this->db->get('ms_barang')->result_array()

		);
		$this->load->view('tr_so/create',$data);
	 }
	 

	public function store()
	{
		try {
			$data = array(
				'kode_so' 		=> htmlentities($this->input->post('kode_so')),
				'tgl_so' 		=> $this->input->post('tgl_so'),
				'customer_so'	=> htmlentities($this->input->post('customer_so')),
				'keterangan_so'	=> htmlentities($this->input->post('keterangan_so')),
				'so_total_harga_beli'	=> htmlentities($this->input->post('so_total_harga_beli')),
				'so_total_harga_jual'	=> htmlentities($this->input->post('so_total_harga_jual')),
				'user_id' 	=> $this->session->userdata('user_id')
		);

		$this->db->set($data);
		$save = $this->db->insert('tr_so_h');
		if($save){
			$insert_id = $this->db->insert_id();
			foreach($this->input->post('item') as $detail){
				$data2 = array(
					'so_id' 		=> $insert_id,
					'so_item_id' 	=> $detail['so_item_id'],
					'so_item_qty' 	=> $detail['so_item_qty'],
					'so_item_harga_beli'=>$detail['so_harga_beli_item'],
					'so_item_harga_jual'=> $detail['so_harga_jual_item']
				);
				$this->db->set($data2);
				$this->db->insert('tr_so_d');


				// catat stok
				$data3 = array(
					'tgl_dokumen'  => $this->input->post('tgl_so'),
					'kode_dokumen' => $this->input->post('kode_so'),
					'type_dokumen' => 'SO',
					'item_id' 	   => $detail['so_item_id'],
					'item_qty' 	   => $detail['so_item_qty']
				);
				$this->db->set($data3);
				$this->db->insert('ms_kartu_stok');

			}
		} else {
			echo json_encode('Could not created data');
		}
			echo json_encode([
				'success' => "created Data Berhasil",
				'kode_so' => $this->input->post('kode_so')
			]);
		} 
		catch ( Exception $e ){
			echo json_encode('Could not created data');
		}


	}



	public function edit()
	{
			$data = array(
					'judul' 		=> 'Edit SO',			
					'customers' => $this->db->get('ms_customer')->result_array(),
					'items' 	=> $this->db->get('ms_barang')->result_array()

			);
			$this->load->view('tr_so/edit',$data);
	}


	public function show_edit()
	{
		$po = "SELECT tr_so_h.*, 
					tr_so_d.so_id, 
					tr_so_d.so_item_id,
					tr_so_d.so_item_harga_beli as so_harga_beli_item,
					tr_so_d.so_item_harga_jual as so_harga_jual_item,
					tr_so_d.so_item_qty,
					ms_barang.kode_barang,
					ms_barang.nama_barang,
					ms_customer.nama_customer ,
					tr_so_d.so_item_id
					FROM tr_so_h
					INNER JOIN tr_so_d ON tr_so_h.id = tr_so_d.so_id 
					INNER JOIN ms_barang ON ms_barang.id = tr_so_d.so_item_id
					INNER JOIN ms_customer ON ms_customer.id = tr_so_h.customer_so
					WHERE tr_so_h.id = '".$this->uri->segment('3')."'";
		$result = $this->db->query($po)->result();
		echo json_encode($result);
	}
    

    public function update()
    {
		try {
			$data = array(
				'kode_so' 		=> htmlentities($this->input->post('kode_so')),
				'tgl_so' 		=> $this->input->post('tgl_so'),
				'customer_so'	=> htmlentities($this->input->post('customer_so')),
				'keterangan_so'	=> htmlentities($this->input->post('keterangan_so')),
				'so_total_harga_beli'	=> htmlentities($this->input->post('so_total_harga_beli')),
				'so_total_harga_jual'	=> htmlentities($this->input->post('so_total_harga_jual')),
				'user_id' 	=> $this->session->userdata('user_id')
		);

		$this->db->set($data);
		$this->db->where('id',$this->input->post('id'));
		$save = $this->db->update('tr_so_h');
		if($save){
			$this->db->delete('tr_so_d',array('so_id' => $this->input->post('id')));
			$this->db->delete('ms_kartu_stok',array('kode_dokumen' => $this->input->post('kode_so')));
			foreach($this->input->post('item') as $detail){
				$data2 = array(
					'so_id' 		=> $this->input->post('id'),
					'so_item_id' 	=> $detail['so_item_id'],
					'so_item_qty' 	=> $detail['so_item_qty'],
					'so_item_harga_beli'=>$detail['so_harga_beli_item'],
					'so_item_harga_jual'=> $detail['so_harga_jual_item']
				);
				$this->db->set($data2);
				$this->db->insert('tr_so_d');

				// catat stok
				$data3 = array(
					'tgl_dokumen'  => $this->input->post('tgl_so'),
					'kode_dokumen' => $this->input->post('kode_so'),
					'type_dokumen' => 'SO',
					'item_id' 	   => $detail['so_item_id'],
					'item_qty' 	   => $detail['so_item_qty']
				);
				$this->db->set($data3);
				$this->db->insert('ms_kartu_stok');


			}
		} else {
			echo json_encode('Could not created data');
		}
			echo json_encode([
				'success' => "created Data Berhasil",
				'kode_so' => $this->input->post('kode_so')
			]);
		} 
		catch ( Exception $e ){
			echo json_encode('Could not created data');
		}

	}
	

	public function delete()
	{
		$cek = $this->db->query("SELECT kode_so FROM tr_so_h where id = '".$this->input->post('id')."'")->row_array();
		if($cek){
		$this->db->query("DELETE FROM ms_kartu_stok WHERE kode_dokumen = '".$cek['kode_so']."'");
		$this->db->delete('tr_so_h', array('id' =>  $this->input->post('id')));
		$this->db->delete('tr_so_d',array('so_id' => $this->input->post('id')));
		}
		echo json_encode('Data Berhasil dihapus');
	}


	public function cek_stok()
	{
		   // cek untuk PO
		   $gr = $this->db->select('IFNULL(SUM(item_qty), 0) AS `qty_gr`', false)->from('ms_kartu_stok')->where('item_id',$this->input->post('item_id'))->where('type_dokumen','GR')->get()->row_array();
		   // cek untuk SO
		   $so = $this->db->select('IFNULL(SUM(item_qty), 0) AS `qty_so`', false)->from('ms_kartu_stok')->where('item_id',$this->input->post('item_id'))->where('type_dokumen','SO')->get()->row_array();
		   $stok_final = 0;
		   $stok_final = $gr['qty_gr'] - $so['qty_so'];
		   echo json_encode($stok_final);
	}


	public function cek_stok_edit()
	{
		   // cek untuk PO
		   $gr = $this->db->select('IFNULL(SUM(item_qty), 0) AS `qty_gr`', false)->from('ms_kartu_stok')->where('item_id',$this->input->post('item_id'))->where('type_dokumen','GR')->get()->row_array();
		   // cek untuk SO
		   // kembalikan nilai qty so terkait
		   $so = $this->db->select('IFNULL(SUM(item_qty), 0) AS `qty_so`', false)->from('ms_kartu_stok')->where('item_id',$this->input->post('item_id'))->where('type_dokumen','SO')->where_not_in('kode_dokumen', $this->input->post('kode_so'))->get()->row_array();
		   $stok_final = 0;
		   $stok_final = $gr['qty_gr'] - $so['qty_so'];
		   echo json_encode($stok_final);
	}
   


}
