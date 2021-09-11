<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Po_controller extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->db->select('tr_po_h.*,ms_suplier.nama_suplier');
		$this->db->from('tr_po_h');
		$this->db->join('ms_suplier', 'ms_suplier.id = tr_po_h.suplier_po');
		$data = array(
				'judul' => 'Purchase Order',
				'pos' => $this->db->get()->result_array()
		);
		$this->load->view('tr_po/index',$data);
		

	}


	public function show()
	{

		$po = "SELECT tr_po_h.*, 
									   tr_po_d.po_id, 
									   tr_po_d.po_item_id,
									   tr_po_d.po_harga_beli_item,
									   tr_po_d.po_harga_jual_item,
									   tr_po_d.po_item_qty,
									   ms_barang.kode_barang,
									   ms_barang.nama_barang,
									   ms_suplier.nama_suplier ,
									   tr_po_d.po_item_id
									   FROM tr_po_h
									   INNER JOIN tr_po_d ON tr_po_h.id = tr_po_d.po_id 
									   INNER JOIN ms_barang ON ms_barang.id = tr_po_d.po_item_id
									   INNER JOIN ms_suplier ON ms_suplier.id = tr_po_h.suplier_po
									   WHERE tr_po_h.tgl_po BETWEEN '".$this->input->post('tanggal_awal')."' AND '".$this->input->post('tanggal_akhir')."'";
		$result = $this->db->query($po)->result();
		echo json_encode($result);
	}
	

	public function create()
	{

		$this->db->select('RIGHT(tr_po_h.kode_po,5) as kode_po', FALSE);
		$this->db->order_by('kode_po','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('tr_po_h');
			if($query->num_rows() <> 0){      
				 $data = $query->row_array();
				 $kode = intval($data['kode_po']) + 1; 
			}
			else{      
				 $kode = 1;  
			}
		$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);  


		$data = array(
			'judul' 	=> 'Tambah PO',
			'kode_po' 	=> 'TRX-PO-'.$batas,
			'supliers' 	=> $this->db->get('ms_suplier')->result_array(),
			'items' 	=> $this->db->get('ms_barang')->result_array(),

		);
		$this->load->view('tr_po/create',$data);
	 }
	 

	public function store()
	{
		try {
			$data = array(
				'kode_po' 		=> htmlentities($this->input->post('kode_po')),
				'tgl_po' 		=> $this->input->post('tgl_po'),
				'suplier_po'	=> htmlentities($this->input->post('suplier_po')),
				'keterangan_po'	=> htmlentities($this->input->post('keterangan_po')),
				'total_harga_beli_po'	=> htmlentities($this->input->post('po_total_harga_beli')),
				'total_harga_jual_po'	=> htmlentities($this->input->post('po_total_harga_jual')),
				'user_id' 	=> $this->session->userdata('user_id')
		);

		$this->db->set($data);
		$save = $this->db->insert('tr_po_h');
		if($save){
			$insert_id = $this->db->insert_id();
			foreach($this->input->post('item') as $detail){
				$data2 = array(
					'po_id' 		=> $insert_id,
					'po_item_id' 	=> $detail['po_item_id'],
					'po_item_qty' 	=> $detail['po_item_qty'],
					'po_harga_beli_item'=>$detail['po_harga_beli_item'],
					'po_harga_jual_item'=> $detail['po_harga_jual_item']
				);
				$this->db->set($data2);
				$this->db->insert('tr_po_d');
			}
		} else {
			echo json_encode('Could not created data');
		}
			echo json_encode([
				'success' => "created Data Berhasil",
				'kode_po' => $this->input->post('kode_po')
			]);
		} 
		catch ( Exception $e ){
			echo json_encode('Could not created data');
		}


	}



	public function edit()
	{
			$data = array(
					'judul' 		=> 'Edit PO',			
					'supliers' 	=> $this->db->get('ms_suplier')->result_array(),
					'items' 	=> $this->db->get('ms_barang')->result_array(),

			);
			$this->load->view('tr_po/edit',$data);
	}


	public function show_edit()
	{
		$po = "SELECT tr_po_h.*, 
				tr_po_d.po_id, 
				tr_po_d.po_item_id,
				tr_po_d.po_harga_beli_item,
				tr_po_d.po_harga_jual_item,
				tr_po_d.po_item_qty,
				ms_barang.kode_barang,
				ms_barang.nama_barang,
				ms_suplier.nama_suplier ,
				tr_po_d.po_item_id,
				tr_po_d.po_harga_beli_item * tr_po_d.po_item_qty as po_total_harga_beli,
				tr_po_d.po_harga_jual_item * tr_po_d.po_item_qty as total_harga_jual_po
				FROM tr_po_h
				INNER JOIN tr_po_d ON tr_po_h.id = tr_po_d.po_id 
				INNER JOIN ms_barang ON ms_barang.id = tr_po_d.po_item_id
				INNER JOIN ms_suplier ON ms_suplier.id = tr_po_h.suplier_po
				WHERE tr_po_h.id = '".$this->uri->segment('3')."'";
		$result = $this->db->query($po)->result();
		echo json_encode($result);
	}
    

    public function update()
    {
		try {
			$data = array(
				'kode_po' 		=> htmlentities($this->input->post('kode_po')),
				'tgl_po' 		=> $this->input->post('tgl_po'),
				'suplier_po'	=> htmlentities($this->input->post('suplier_po')),
				'keterangan_po'	=> htmlentities($this->input->post('keterangan_po')),
				'total_harga_beli_po'	=> htmlentities($this->input->post('po_total_harga_beli')),
				'total_harga_jual_po'	=> htmlentities($this->input->post('po_total_harga_jual')),
				'user_id' 	=> $this->session->userdata('user_id')
		);

		$this->db->set($data);
		$this->db->where('id',$this->input->post('id'));
		$save = $this->db->update('tr_po_h');
		if($save){
			$this->db->delete('tr_po_d',array('po_id' => $this->input->post('id')));
			foreach($this->input->post('item') as $detail){
				$data2 = array(
					'po_id' 		=> $this->input->post('id'),
					'po_item_id' 	=> $detail['po_item_id'],
					'po_item_qty' 	=> $detail['po_item_qty'],
					'po_harga_beli_item'=>$detail['po_harga_beli_item'],
					'po_harga_jual_item'=> $detail['po_harga_jual_item']
				);
				$this->db->set($data2);
				$this->db->insert('tr_po_d');
			}
		} else {
			echo json_encode('Could not created data');
		}
			echo json_encode([
				'success' => "created Data Berhasil",
				'kode_po' => $this->input->post('kode_po')
			]);
		} 
		catch ( Exception $e ){
			echo json_encode('Could not created data');
		}

	}
	

	public function delete()
	{

		$this->db->delete('tr_po_h', array('id' =>  $this->input->post('id')));
		$this->db->delete('tr_po_d',array('po_id' => $this->input->post('id')));
		echo json_encode('Data Berhasil dihapus');

	}



	public function cek_po_gr()
	{
		$po = $this->db->query("SELECT tr_gr_d.gr_po_id FROM tr_gr_d INNER JOIN tr_gr_h ON tr_gr_h.id = tr_gr_d.gr_id WHERE tr_gr_d.gr_po_id = '".$this->input->post('id')."'")->result();
		echo json_encode($po);

	}
}
