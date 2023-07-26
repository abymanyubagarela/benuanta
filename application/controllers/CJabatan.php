<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CJabatan extends CI_Controller {

	var $data = array();
	function __construct() {
		parent::__construct();
		
		if (empty($this->session->userdata['auth'])) {
            $this->session->set_flashdata('failed', 'Anda Harus Login');

            redirect('login');
        } else {
            if($this->session->userdata['auth']->activation == 0 || $this->session->userdata['auth']->activation == '0') {
                redirect('profile');
            }
        } 

		$this->data = array(
            'controller'=>'cjabatan',
            'redirect'=>'jabatan',
            'title'=>'Jabatan',
            'parent'=>'referensi'
        );

		## load model here 
		$this->load->model('MJabatan', 'Jabatan');
	}

	public function index()	{	

		$data = $this->data;

		$data['list'] = $this->Jabatan->getAll();
		$data['column'] = $this->Jabatan->getColumn();	

		$this->load->view('inc/jabatan/list', $data);
	}

	public function insert() {
		
		$err = $this->Jabatan->insert();

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Menambahkan Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Menambahkan Data');
		}

		redirect($this->data['redirect']);
	}

	public function edit($id) {
		$data = $this->data;

		$data['list_edit'] = $this->Jabatan->getByID($id) ;

	    $this->output->set_content_type('application/json');
	    
	    $this->output->set_output(json_encode($data));

	    return $data;
	}

	public function update() {
		$err = $this->Jabatan->update($this->input->post('id'));

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Merubah Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Merubah Data');
		}	

		redirect($this->data['redirect']);
	}

	public function delete($id) {
		$err = $this->Jabatan->delete($id);

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Menghapus Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Menghapus Data, Data Digunakan');
		}	

		redirect($this->data['redirect']);
	}
}
