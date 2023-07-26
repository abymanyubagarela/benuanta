<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CVendor extends CI_Controller {

	var $data = array();
	function __construct() {
		parent::__construct();
		
		// if (empty($this->session->userdata['auth'])) {
        //     $this->session->set_flashdata('failed', 'Anda Harus Login');

        //     redirect('login');
        // } else {
        //     if($this->session->userdata['auth']->activation == 0 || $this->session->userdata['auth']->activation == '0') {
        //         redirect('profile');
        //     }
        // } 

		$this->data = array(
            'controller'=>'cvendor',
            'redirect'=>'store',
            'title'=>'Vendor',
            'parent'=>'referensi'
        );

        $this->parent = 'referensi' ;

		## load model here 
		$this->load->model('MVendor', 'Vendor');
	}

	public function index()	{	

		$data = $this->data;

		$data['list'] = $this->Vendor->getAll();

		$this->load->view('inc/vendor/list', $data);
	}

    public function create() {   

        $data = $this->data;

        $this->load->view('inc/vendor/create', $data);
    }

	public function insert() {
		
        $err = $this->Vendor->insert();

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Menambahkan Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Menambahkan Data');
		}

		redirect($this->data['redirect']);
	}

	public function edit($id) {
		$data = $this->data;

		$data['list_edit'] = $this->Vendor->getByID($id) ;

        $this->load->view('inc/vendor/edit', $data);
	}

	public function update() {
		$err = $this->Vendor->update($this->input->post('id'));

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Merubah Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Merubah Data');
		}	

		redirect($this->data['redirect']);
	}

	public function delete($id) {
		$err = $this->Vendor->delete($id);

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Menghapus Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Menghapus Data, Data Digunakan');
		}	

		redirect($this->data['redirect']);
	}
}
