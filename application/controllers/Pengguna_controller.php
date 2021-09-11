<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_controller extends CI_Controller {


	 function __construct(){
		parent::__construct();
	
		if($this->session->userdata('login') !== TRUE){
			redirect(base_url("admin/login"));
		}
	}

	public function index()
	{
		$this->db->select('ms_user.*,ms_role.nama_role');
		$this->db->from('ms_user');
		$this->db->join('ms_role', 'ms_role.id = ms_user.role_id');
		$data = array(
				'judul' => 'Pengguna',
				'users' => $this->db->get()->result_array()
		);
		$this->load->view('pengguna/index',$data);
		

	}
	

	public function create()
	{
		$data = array(
			'judul' 	=> 'Tambah pengguna',
			'roles' 	=>  $this->db->get('ms_role')->result_array()
		);
		$this->load->view('pengguna/create',$data);
	 }
	 

	public function store()
	{

		$query = $this->db->get_where('ms_user',array('username' => htmlentities($this->input->post('username'))))->row_array();
		if($query > 0){
			$this->session->set_flashdata('msg','cek_username');
			redirect('pengguna/tambah');
		}else{
			$data = array(
				'nama' => htmlentities($this->input->post('nama')),
				'role_id' => $this->input->post('role_id'),
				'username' => htmlentities($this->input->post('username')),
				'password' => md5($this->input->post('password'))
		);

		$this->db->set($data);
		$save = $this->db->insert('ms_user');
		$this->session->set_flashdata('msg','success');
		redirect('pengguna');
		}

	}



	public function edit()
	{
			$result = $this->db->get_where('ms_user',array('id' => $this->uri->segment('3')))->row_array();
			$data = array(
					'id' 		=> $result['id'],
					'nama' 		=> $result['nama'],
					'role_id' 	=> $result['role_id'],
					'username' 	=> $result['username'],
					'roles' 	=> $this->db->get('ms_role'),
					'judul' 	=> 'Edit pengguna'
			);
			$this->load->view('pengguna/edit',$data);
	}
    

    public function update()
    {
		if(!empty($this->input->post('password'))){
			$array = array(
				'nama' => htmlentities($this->input->post('nama')),
				'role_id' => $this->input->post('role_id'),
				'username' => htmlentities($this->input->post('username')),
				'password' => md5($this->input->post('password'))
			);
		}else{
			$array = array(
				'nama' => htmlentities($this->input->post('nama')),
				'role_id' => $this->input->post('role_id'),
				'username' => htmlentities($this->input->post('username'))

			);
		}

	
		$this->db->set($array);
		$this->db->where('id',$this->input->post('id'));
		$save = $this->db->update('ms_user');
		$this->session->set_flashdata('msg','success');
		redirect(base_url().'pengguna/edit/'.$this->input->post('id'));
	}
	

	public function delete()
	{
		$this->db->delete('ms_user', array('id' =>  $this->uri->segment('3')));
		$this->session->set_flashdata('msg','success');
		redirect('pengguna');  
	}
}
