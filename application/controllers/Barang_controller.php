<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_controller extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->db->select('ms_barang.*');
		$this->db->from('ms_barang');
		$data = array(
				'judul' => 'Item',
				'items' => $this->db->get()->result_array()
		);
		$this->load->view('item/index',$data);
		

	}
	

	public function create()
	{

		$this->db->select('RIGHT(ms_barang.kode_barang,5) as kode_barang', FALSE);
		$this->db->order_by('kode_barang','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('ms_barang');
			if($query->num_rows() <> 0){      
				 $data = $query->row_array();
				 $kode = intval($data['kode_barang']) + 1; 
			}
			else{      
				 $kode = 1;  
			}
		$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);  

		$data = array(
			'judul' 	=> 'Tambah Item',
			'kode_barang' 	=> 'BRG'.$batas
		);
		$this->load->view('item/create',$data);
	 }
	 

	public function store()
	{

			$data = array(
				'kode_barang' 		=> htmlentities($this->input->post('kode_barang')),
				'nama_barang' 		=> htmlentities($this->input->post('nama_item')),
				'harga_beli'		=> htmlentities($this->input->post('harga_beli')),
				'harga_jual' 		=> htmlentities($this->input->post('harga_jual'))
		);

		$this->db->set($data);
		$save = $this->db->insert('ms_barang');
		$this->session->set_flashdata('msg','success');
		redirect('item');


	}



	public function edit()
	{
			$result = $this->db->get_where('ms_barang',array('id' => $this->uri->segment('3')))->row_array();
			$data = array(
					'id' 			=> $result['id'],
					'kode_barang' 	=> $result['kode_barang'],
					'nama_barang' 	=> $result['nama_barang'],
					'harga_beli' 	=> $result['harga_beli'],
					'harga_jual' 	=> $result['harga_jual'],
					'judul' 		=> 'Edit Item'

			);
			$this->load->view('item/edit',$data);
	}
    

    public function update()
    {
		// $get_periode_id = $this->db->query("SELECT id FROM ms_periode WHERE bulan_periode = '".getBulan(substr($this->input->post('tgl_trx'),5,2))."' AND tahun_periode='".substr($this->input->post('tgl_trx'),0,4)."'")->row();

		$array = array(
			'kode_barang' 		=> htmlentities($this->input->post('kode_barang')),
			'nama_barang' 		=> htmlentities($this->input->post('nama_item')),
			'harga_beli'		=> htmlentities($this->input->post('harga_beli')),
			'harga_jual' 		=> htmlentities($this->input->post('harga_jual'))
		);

	
		$this->db->set($array);
		$this->db->where('id',$this->input->post('id'));
		$save = $this->db->update('ms_barang');
		$this->session->set_flashdata('msg','success');
		redirect(base_url().'item/edit/'.$this->input->post('id'));
	}
	

	public function delete()
	{
		$this->db->delete('ms_barang', array('id' =>  $this->uri->segment('3')));
		$this->session->set_flashdata('msg','success');
		redirect('item');  
	}
}
