<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CKategori extends CI_Controller {

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
            'controller'=>'ckategori',
            'redirect'=>'kategori',
            'title'=>'Kategori',
            'parent'=>'referensi'
        );

        $this->parent = 'referensi' ;

		## load model here 
		$this->load->model('MKategori', 'Kategori');
	}

	public function index()	{	

		$data = $this->data;

		$data['list'] = $this->Kategori->getAll();

		$this->load->view('inc/kategori/list', $data);
	}

    public function create() {   

        $data = $this->data;

        $this->load->view('inc/kategori/create', $data);
    }

	public function insert() {
		
        $err = $this->Kategori->insert();

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Menambahkan Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Menambahkan Data');
		}

		redirect($this->data['redirect']);
	}

	public function edit($id) {
		$data = $this->data;

		$data['list_edit'] = $this->Kategori->getByID($id) ;

        $this->load->view('inc/kategori/edit', $data);
	}

	public function update() {
		$err = $this->Kategori->update($this->input->post('id'));

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Merubah Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Merubah Data');
		}	

		redirect($this->data['redirect']);
	}

	public function delete($id) {
		$err = $this->Kategori->delete($id);

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Menghapus Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Menghapus Data, Data Digunakan');
		}	

		redirect($this->data['redirect']);
	}
}
