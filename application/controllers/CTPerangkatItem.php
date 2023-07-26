<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTPerangkatItem extends CI_Controller {

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

		## load model here 
		$this->load->model('MTPerangkatItem', 'TPerangkatItem');
		$this->load->model('MTPerangkat', 'TPerangkat');
		$this->load->model('MPerangkat', 'Perangkat');

		$this->data = array(
            'controller'=>'ctperangkatitem',
            'redirect'=>'detail/peminjaman-perangkat-it',
            'title'=>'Peminjaman Perangkat IT Item',
            'parent'=>'peminjaman',
            'perangkat' => $this->Perangkat->getList()
        );

	}

	public function detail($id)	{	
		$data = $this->data;

		$data['list'] = $this->TPerangkatItem->getAll($id);
		
		$data['column'] = $this->TPerangkatItem->getColumn();	

		$data['detail'] = $this->TPerangkat->getByID($id);

		$this->load->view('inc/tperangkatitem/list', $data);
	}

	public function insert($id) {

		$err = $this->TPerangkatItem->insert($id);

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Menambahkan Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Menambahkan Data');
		}

		redirect($this->data['redirect'].'/'.$id);
	}

	public function edit($id) {
		$data = $this->data;

		$data['list_edit'] = $this->TPerangkatItem->getByID($id) ;

	    $this->output->set_content_type('application/json');
	    
	    $this->output->set_output(json_encode($data));

	    return $data;
	}

	public function update($id) {
		$err = $this->TPerangkatItem->update($this->input->post('id'));			

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Merubah Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Merubah Data');
		}	

		redirect($this->data['redirect'].'/'.$id);
	}

	public function delete() {
		$data = $this->data;

		$err = $this->TPerangkatItem->delete($this->input->post('id'));

		/*
		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Menghapus Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Menghapus Data, Data Digunakan');
		}
		*/	

		$this->output->set_output(json_encode($err));

	    return $data;
	}
}
