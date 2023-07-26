<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTPerangkat extends CI_Controller {

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
		$this->load->model('MTperangkat', 'Tperangkat');
        $this->load->model('MTPerangkatItem', 'TPerangkatItem');
		$this->load->model('MPerangkat', 'Perangkat');
        $this->load->model('MLaporan', 'Laporan');

		$this->data = array(
            'controller'=>'ctperangkat',
            'redirect'=>'peminjaman-perangkat-it',
            'title'=>'Peminjaman Perangkat IT',
            'parent'=>'peminjaman',
        );

	}

	public function index()	{	

        // $this->generate_report(array('id'=>2)); 
        // die();
		$data = $this->data;

		$data['list'] = $this->Tperangkat->getAll();
		
		$data['column'] = $this->Tperangkat->getColumn();	

		$this->load->view('inc/tperangkat/list', $data);
	}

	public function pengembalian() {	
		$data = $this->data;

		$data['parent'] = 'pengembalian';

		$data['list'] = $this->Tperangkat->getPengembalian();
		
		$data['column'] = $this->Tperangkat->getColumn();	

		$this->load->view('inc/tperangkat/list_pengembalian', $data);
	}

	public function insert() {
		$filename = null;

		if($_FILES['nota']['size'] > 0) {
			$filename = $this->do_upload();
		}

		$err = $this->Tperangkat->insert($filename);

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Menambahkan Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Menambahkan Data');
		}

		redirect($this->data['redirect']);
	}

	public function edit($id) {
		$data = $this->data;

		$data['list_edit'] = $this->Tperangkat->getByID($id) ;

		$data['list_edit']->tanggal_peminjaman_mulai = date("Y-m-d", strtotime($data['list_edit']->tanggal_peminjaman_mulai));

		$data['list_edit']->tanggal_peminjaman_selesai = date("Y-m-d", strtotime($data['list_edit']->tanggal_peminjaman_selesai));

	    $this->output->set_content_type('application/json');
	    
	    $this->output->set_output(json_encode($data));

	    return $data;
	}

	public function update() {
		$filename = null;
		
		if($_FILES['nota']['size'] > 0) {
			$filename = $this->do_upload();
		}

		$err = $this->Tperangkat->update($this->input->post('id'),$filename);	

        if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Merubah Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Merubah Data');
		}	


        $this->generate_report($this->input->post()); 

		redirect($this->data['redirect']);
	}

	public function update_pengembalian() {
		$filename = null;
		
		$err = $this->Tperangkat->update($this->input->post('id'),$filename);			

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Merubah Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Merubah Data');
		}	

        $this->generate_report($this->input->post()); 

		redirect($this->data['redirect'].'/pengembalian');
	}

	public function delete($id) {
		$err = $this->Tperangkat->delete($id);

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Menghapus Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Menghapus Data, Data Digunakan');
		}	

		redirect($this->data['redirect']);
	}

	public function do_upload() {
		$config['upload_path']          = './uploads';
        $config['allowed_types']        = 'pdf|png|jpeg|jpg';
        $config['max_size']     		= '10000';
        $config['file_name']     		= date('dmyhis');

        $this->load->library('upload', $config);

        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('nota')){
                $error = array('error' => $this->upload->display_errors());

                $this->session->set_flashdata('failed', 'Gagal menggunggah dokumen.'. $this->upload->display_errors());

                redirect($this->data['redirect']);
        } else {
                $data = array('upload_data' => $this->upload->data());

                return $this->upload->data('file_name');
        }
	}

    public function generate_report($data) {
        $detail = $this->Tperangkat->getByID($data['id']);
        $item = $this->TPerangkatItem->getByPeminjaman($data['id']);
        
        // print_r($detail);die()  ;

        if($detail->status == 4) {
            if($detail->is_temporary == 0) {
                $this->Laporan->mbast($detail,$item);    
            } else {
                $this->Laporan->mpinjam($detail,$item);    
            }
        }

        // print_r($detail);die()  ;
        if($detail->status == 5) {
            $this->Laporan->mkembali($detail,$item);    
        }
        
    }
}
