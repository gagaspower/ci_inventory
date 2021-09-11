<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gr_controller extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->db->select('tr_gr_h.*,ms_suplier.nama_suplier');
		$this->db->from('tr_gr_h');
		$this->db->join('ms_suplier', 'ms_suplier.id = tr_gr_h.suplier_gr');
		$data = array(
				'judul' => 'Goods Received',
				'grs' => $this->db->get()->result_array()
		);
		$this->load->view('tr_gr/index',$data);
		

	}


	public function show()
	{

		$gr = "SELECT tr_gr_h.*, 
									   tr_gr_d.gr_id, 
									   tr_gr_d.gr_item_id,
									   tr_gr_d.gr_harga_beli_item,
									   tr_gr_d.gr_harga_jual_item,
									   tr_gr_d.gr_item_qty,
									   ms_barang.kode_barang,
									   ms_barang.nama_barang,
									   ms_suplier.nama_suplier ,
									   tr_gr_d.gr_item_id
									   FROM tr_gr_h
									   INNER JOIN tr_gr_d ON tr_gr_h.id = tr_gr_d.gr_id 
									   INNER JOIN ms_barang ON ms_barang.id = tr_gr_d.gr_item_id
									   INNER JOIN ms_suplier ON ms_suplier.id = tr_gr_h.suplier_gr
									   WHERE tr_gr_h.tgl_gr BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'";
		$result = $this->db->query($gr)->result();
		echo json_encode($result);
	}
	

	public function create()
	{

		$this->db->select('RIGHT(tr_gr_h.kode_gr,5) as kode_gr', FALSE);
		$this->db->order_by('kode_gr','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('tr_gr_h');
			if($query->num_rows() <> 0){      
				 $data = $query->row_array();
				 $kode = intval($data['kode_gr']) + 1; 
			}
			else{      
				 $kode = 1;  
			}
		$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);  


		$data = array(
			'judul' 	=> 'Tambah GR',
			'kode_gr' 	=> 'TRX-GR-'.$batas,
			'supliers' 	=> $this->db->get('ms_suplier')->result_array(),
			'items' 	=> $this->db->get('ms_barang')->result_array(),

		);
		$this->load->view('tr_gr/create',$data);
	 }
	 

	public function store()
	{
		try {
			$data = array(
				'kode_gr' 		=> htmlentities($this->input->post('kode_gr')),
				'tgl_gr' 		=> $this->input->post('tgl_gr'),
				'suplier_gr'	=> htmlentities($this->input->post('suplier_gr')),
				'keterangan_gr'	=> htmlentities($this->input->post('keterangan_gr')),
				'total_harga_beli_gr'	=> htmlentities($this->input->post('gr_total_harga_beli')),
				'total_harga_jual_gr'	=> htmlentities($this->input->post('gr_total_harga_jual')),
				'user_id' 	=> $this->session->userdata('user_id')
		);

		$this->db->set($data);
		$save = $this->db->insert('tr_gr_h');
		if($save){
			$insert_id = $this->db->insert_id();
			foreach($this->input->post('item') as $detail){
				$data2 = array(
					'gr_id' 		=> $insert_id,
					'gr_item_id' 	=> $detail['gr_item_id'],
					'gr_item_qty' 	=> $detail['gr_item_qty'],
					'gr_harga_beli_item'=>$detail['gr_harga_beli_item'],
					'gr_harga_jual_item'=> $detail['gr_harga_jual_item']
				);
				$this->db->set($data2);
				$this->db->insert('tr_gr_d');

				// catat stok
				$data3 = array(
					'kode_dokumen' => $this->input->post('kode_gr'),
					'type_dokumen' => 'GR',
					'item_id' 	   => $detail['gr_item_id'],
					'item_qty' 	   => $detail['gr_item_qty']
				);
				$this->db->set($data3);
				$this->db->insert('ms_kartu_stok');

			}
		} else {
			echo json_encode('Could not created data');
		}
			echo json_encode([
				'success' => "created Data Berhasil",
				'kode_gr' => $this->input->post('kode_gr')
			]);
		} 
		catch ( Exception $e ){
			echo json_encode('Could not created data');
		}


	}



	public function edit()
	{
			$data = array(
					'judul' 		=> 'Edit GR',			
					'supliers' 	=> $this->db->get('ms_suplier')->result_array(),
					'items' 	=> $this->db->get('ms_barang')->result_array(),

			);
			$this->load->view('tr_gr/edit',$data);
	}


	public function show_edit()
	{
		$po = "SELECT tr_gr_h.*, 
				tr_gr_d.gr_id, 
				tr_gr_d.gr_item_id,
				tr_gr_d.gr_harga_beli_item,
				tr_gr_d.gr_harga_jual_item,
				tr_gr_d.gr_item_qty,
				ms_barang.kode_barang,
				ms_barang.nama_barang,
				ms_suplier.nama_suplier ,
				tr_gr_d.gr_item_id,
				tr_gr_d.gr_harga_beli_item * tr_gr_d.gr_item_qty as gr_total_harga_beli,
				tr_gr_d.gr_harga_jual_item * tr_gr_d.gr_item_qty as total_harga_jual_gr
				FROM tr_gr_h
				INNER JOIN tr_gr_d ON tr_gr_h.id = tr_gr_d.gr_id 
				INNER JOIN ms_barang ON ms_barang.id = tr_gr_d.gr_item_id
				INNER JOIN ms_suplier ON ms_suplier.id = tr_gr_h.suplier_gr
				WHERE tr_gr_h.id = '".$this->uri->segment('3')."'";
		$result = $this->db->query($po)->result();
		echo json_encode($result);
	}
    

    public function update()
    {
		try {
			$data = array(
				'kode_gr' 		=> htmlentities($this->input->post('kode_gr')),
				'tgl_gr' 		=> $this->input->post('tgl_gr'),
				'suplier_gr'	=> htmlentities($this->input->post('suplier_gr')),
				'keterangan_gr'	=> htmlentities($this->input->post('keterangan_gr')),
				'total_harga_beli_gr'	=> htmlentities($this->input->post('gr_total_harga_beli')),
				'total_harga_jual_gr'	=> htmlentities($this->input->post('gr_total_harga_jual')),
				'user_id' 	=> $this->session->userdata('user_id')
		);

		$this->db->set($data);
		$this->db->where('id',$this->input->post('id'));
		$save = $this->db->update('tr_gr_h');
		if($save){
			$this->db->delete('tr_gr_d',array('gr_id' => $this->input->post('id')));
			$this->db->delete('ms_kartu_stok',array('kode_dokumen' => $this->input->post('kode_gr')));
			foreach($this->input->post('item') as $detail){
				$data2 = array(
					'gr_id' 		=> $this->input->post('id'),
					'gr_item_id' 	=> $detail['gr_item_id'],
					'gr_item_qty' 	=> $detail['gr_item_qty'],
					'gr_harga_beli_item'=>$detail['gr_harga_beli_item'],
					'gr_harga_jual_item'=> $detail['gr_harga_jual_item']
				);
				$this->db->set($data2);
				$this->db->insert('tr_gr_d');


				// catat stok
				$data3 = array(
					'kode_dokumen' => $this->input->post('kode_gr'),
					'type_dokumen' => 'GR',
					'item_id' 	   => $detail['gr_item_id'],
					'item_qty' 	   => $detail['gr_item_qty']
				);
				$this->db->set($data3);
				$this->db->insert('ms_kartu_stok');

			}
		} else {
			echo json_encode('Could not created data');
		}
			echo json_encode([
				'success' => "created Data Berhasil",
				'kode_gr' => $this->input->post('kode_gr')
			]);
		} 
		catch ( Exception $e ){
			echo json_encode('Could not created data');
		}

	}
	

	public function delete()
	{

		// cek kartu stok
		$cek = $this->db->query("SELECT kode_gr FROM tr_gr_h where id = '".$this->input->post('id')."'")->row_array();
		if($cek){
			$this->db->query("DELETE FROM ms_kartu_stok WHERE kode_dokumen = '".$cek['kode_gr']."'");
			$this->db->delete('tr_gr_h', array('id' =>  $this->input->post('id')));
			$this->db->delete('tr_gr_d',array('gr_id' => $this->input->post('id')));
		}
		echo json_encode('Data Berhasil dihapus');
	}
}
