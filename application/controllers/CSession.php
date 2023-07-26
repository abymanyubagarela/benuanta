<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CSession extends CI_Controller {

	var $data = array();

	function __construct() {
		parent::__construct();
		
		$this->load->model('MPengguna', 'User');
        $this->load->model('Munit', 'Unit');
        $this->load->model('MJabatan', 'Jabatan');

        $this->data = array(
            'controller'=>'csession',
            'redirect'=>'login',
            'parent'=>'dashboard',
            'unit'=>$this->Unit->getList(),
            'jabatan'=>$this->Jabatan->getList(),
        );

	}

	public function index()	{	

		$data = $this->data;


		$this->load->view('inc/session/index', $data);
	}

	public function profile()	{	

		$data = $this->data;
		// print_r($this->session->userdata('auth')->id);die();
        $data['profile'] = $this->User->getByID($this->session->userdata('auth')->id);

		$this->load->view('inc/session/profile', $data);
	}

	public function update() {
		$err = $this->User->update($this->input->post('id'));
		
		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Merubah Data Silahkan Logout Terlebih Dahulu');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Merubah Data');
		}	

		redirect('profile');
	}

	public function login()	{	

		$data = $this->data;

		$exist = $this->User->getLogin();

        if (empty($exist)) {				
			
			$this->session->set_flashdata('failed', 'User Not Found');
			
			redirect($this->data['controller']);	

		} else {
			$this->session->set_userdata('auth', $exist);		
			
			$this->session->set_flashdata('success', 'Selamat Datang');
			
			redirect('welcome');		
		}

		$this->load->view('inc/session/index', $data);
	}

	public function logout()	{	

		$this->session->sess_destroy();

		redirect($this->data['redirect']);		
	}

}
