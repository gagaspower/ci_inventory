<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {



	public function index()
	{

		$this->load->view('login');

    }


    public function cek()
    {
        $username =  htmlentities($this->input->post('username'));
        $password =  htmlentities(md5($this->input->post('password')));
		$result = $this->db->get_where('ms_user',array('username' => $username, 'password' => $password ))->row_array();
		if($result > 0){
			$data = array(
				'user_id' => $result['id'],
				'nama' 	  => $result['nama'],
				'role' 	  => $result['role_id'],
				'login'  => TRUE
			);
			$this->session->set_userdata($data);
			
			redirect('dashboard');

		}else{
			$this->session->set_flashdata('msg','error');
			redirect(base_url());
		}
       
    }
	

 	public function logout()
	{
		$user_data = $this->session->all_userdata();
			foreach ($user_data as $key => $value) {
				if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
					$this->session->unset_userdata($key);
				}
			}
		$this->session->sess_destroy();
		redirect(base_url());
	}


	
}
