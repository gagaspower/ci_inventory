<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suplier_controller extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->db->select('ms_suplier.*');
		$this->db->from('ms_suplier');
		$data = array(
				'judul' => 'Suplier',
				'items' => $this->db->get()->result_array()
		);
		$this->load->view('suplier/index',$data);
		

	}
	

	public function create()
	{

		$this->db->select('RIGHT(ms_suplier.kode_suplier,5) as kode_suplier', FALSE);
		$this->db->order_by('kode_suplier','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('ms_suplier');
			if($query->num_rows() <> 0){      
				 $data = $query->row_array();
				 $kode = intval($data['kode_suplier']) + 1; 
			}
			else{      
				 $kode = 1;  
			}
		$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);  

		$data = array(
			'judul' 	=> 'Tambah Suplier',
			'kode_suplier' 	=> 'SPR'.$batas
		);
		$this->load->view('suplier/create',$data);
	 }
	 

	public function store()
	{

			$data = array(
				'kode_suplier' 		=> htmlentities($this->input->post('kode_suplier')),
				'nama_suplier' 		=> htmlentities($this->input->post('nama_suplier')),
				'alamat_suplier'	=> htmlentities($this->input->post('alamat_suplier')),
				'tlp_suplier' 		=> htmlentities($this->input->post('tlp_suplier'))
		);

		$this->db->set($data);
		$save = $this->db->insert('ms_suplier');
		$this->session->set_flashdata('msg','success');
		redirect('suplier');


	}



	public function edit()
	{
			$result = $this->db->get_where('ms_suplier',array('id' => $this->uri->segment('3')))->row_array();
			$data = array(
					'id' 			=> $result['id'],
					'kode_suplier' 	=> $result['kode_suplier'],
					'nama_suplier' 	=> $result['nama_suplier'],
					'alamat_suplier'=> $result['alamat_suplier'],
					'tlp_suplier' 	=> $result['tlp_suplier'],
					'judul' 		=> 'Edit Suplier'

			);
			$this->load->view('suplier/edit',$data);
	}
    

    public function update()
    {
		// $get_periode_id = $this->db->query("SELECT id FROM ms_periode WHERE bulan_periode = '".getBulan(substr($this->input->post('tgl_trx'),5,2))."' AND tahun_periode='".substr($this->input->post('tgl_trx'),0,4)."'")->row();

		$array = array(
			'kode_suplier' 		=> htmlentities($this->input->post('kode_suplier')),
			'nama_suplier' 		=> htmlentities($this->input->post('nama_suplier')),
			'alamat_suplier'	=> htmlentities($this->input->post('alamat_suplier')),
			'tlp_suplier' 		=> htmlentities($this->input->post('tlp_suplier'))
		);

	
		$this->db->set($array);
		$this->db->where('id',$this->input->post('id'));
		$save = $this->db->update('ms_suplier');
		$this->session->set_flashdata('msg','success');
		redirect(base_url().'suplier/edit/'.$this->input->post('id'));
	}
	

	public function delete()
	{
		$this->db->delete('ms_suplier', array('id' =>  $this->uri->segment('3')));
		$this->session->set_flashdata('msg','success');
		redirect('suplier');  
	}
}
