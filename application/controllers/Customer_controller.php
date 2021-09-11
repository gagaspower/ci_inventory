<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_controller extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->db->select('ms_customer.*');
		$this->db->from('ms_customer');
		$data = array(
				'judul' => 'Customer',
				'items' => $this->db->get()->result_array()
		);
		$this->load->view('customer/index',$data);
		

	}
	

	public function create()
	{

		$this->db->select('RIGHT(ms_customer.kode_customer,5) as kode_customer', FALSE);
		$this->db->order_by('kode_customer','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('ms_customer');
			if($query->num_rows() <> 0){      
				 $data = $query->row_array();
				 $kode = intval($data['kode_customer']) + 1; 
			}
			else{      
				 $kode = 1;  
			}
		$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);  

		$data = array(
			'judul' 	=> 'Tambah Customer',
			'kode_customer' 	=> 'CST'.$batas
		);
		$this->load->view('customer/create',$data);
	 }
	 

	public function store()
	{

			$data = array(
				'kode_customer' 	=> htmlentities($this->input->post('kode_customer')),
				'nama_customer' 	=> htmlentities($this->input->post('nama_customer')),
				'alamat_customer'	=> htmlentities($this->input->post('alamat_customer')),
				'tlp_customer' 		=> htmlentities($this->input->post('tlp_customer'))
		);

		$this->db->set($data);
		$save = $this->db->insert('ms_customer');
		$this->session->set_flashdata('msg','success');
		redirect('customer');


	}



	public function edit()
	{
			$result = $this->db->get_where('ms_customer',array('id' => $this->uri->segment('3')))->row_array();
			$data = array(
					'id' 			=> $result['id'],
					'kode_customer' => $result['kode_customer'],
					'nama_customer' => $result['nama_customer'],
					'alamat_customer'=> $result['alamat_customer'],
					'tlp_customer' 	=> $result['tlp_customer'],
					'judul' 		=> 'Edit Customer'

			);
			$this->load->view('customer/edit',$data);
	}
    

    public function update()
    {
		// $get_periode_id = $this->db->query("SELECT id FROM ms_periode WHERE bulan_periode = '".getBulan(substr($this->input->post('tgl_trx'),5,2))."' AND tahun_periode='".substr($this->input->post('tgl_trx'),0,4)."'")->row();

		$array = array(
			'kode_customer' 	=> htmlentities($this->input->post('kode_customer')),
			'nama_customer' 	=> htmlentities($this->input->post('nama_customer')),
			'alamat_customer'	=> htmlentities($this->input->post('alamat_customer')),
			'tlp_customer' 		=> htmlentities($this->input->post('tlp_customer'))
		);

	
		$this->db->set($array);
		$this->db->where('id',$this->input->post('id'));
		$save = $this->db->update('ms_customer');
		$this->session->set_flashdata('msg','success');
		redirect(base_url().'customer/edit/'.$this->input->post('id'));
	}
	

	public function delete()
	{
		$this->db->delete('ms_customer', array('id' =>  $this->uri->segment('3')));
		$this->session->set_flashdata('msg','success');
		redirect('customer');  
	}
}
