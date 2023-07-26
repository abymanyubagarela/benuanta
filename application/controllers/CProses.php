<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CProses extends CI_Controller {

	var $data = array();
	function __construct() {
		parent::__construct();
        $this->load->helper('file');
		
		// if (empty($this->session->userdata['auth'])) {
        //     $this->session->set_flashdata('failed', 'Anda Harus Login');

        //     redirect('login');
        // } else {
        //     if($this->session->userdata['auth']->activation == 0 || $this->session->userdata['auth']->activation == '0') {
        //         redirect('profile');
        //     }
        // } 

		$this->data = array(
            'controller'=>'cproses',
            'redirect'=>'proses',
            'title'=>'Proses',
            'parent'=>'referensi'
        );

        $this->parent = 'referensi' ;

		## load model here 
		$this->load->model('MProses', 'Proses');
        $this->load->model('MPartai', 'Partai');
        $this->load->model('MKategori', 'Kategori');
	}

	public function index()	{	

		$data = $this->data;

		$data['list'] = $this->Proses->getAll();

		$this->load->view('inc/proses/list', $data);
	}

    public function create() {   

        $data = $this->data;

        $data['partai'] = $this->Partai->getList();

        $data['kategori'] = $this->Kategori->getList();

        $this->load->view('inc/proses/create', $data);
    }

	public function insert() {
		
        if(!empty($_FILES)) {
            $res = $this->do_upload();
            
            if(!empty($res['error'])) {
                $this->session->set_flashdata('failed', 'Gagal Upload Mohon Ulang');
            }
        }
        
        $err = $this->Proses->insert();

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Menambahkan Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Menambahkan Data');
		}

		redirect($this->data['redirect']);
	}

	public function edit($id) {
		$data = $this->data;

		$data['list_edit'] = $this->Proses->getByID($id) ;

        $this->load->view('inc/proses/edit', $data);
	}

	public function update() {
		$err = $this->Proses->update($this->input->post('id'));

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Merubah Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Merubah Data');
		}	

		redirect($this->data['redirect']);
	}

	public function delete($id) {
		$err = $this->Proses->delete($id);

		if ($err['code'] == '0') {
			$this->session->set_flashdata('success', 'Berhasil Menghapus Data');
		} else {
			$this->session->set_flashdata('failed', 'Gagal Menghapus Data, Data Digunakan');
		}	

		redirect($this->data['redirect']);
	}

    public function do_upload() {
        $filename = str_replace(" ","_", $_FILES['filespj']['name']);
        $config['upload_path']   = './uploads/filespj/';
        $config['allowed_types'] = 'pdf';
        

        $this->load->library('upload');

        // batasi disni untuk file-file spj yang uda di set agar tidak ke replace
        if (is_dir($config['upload_path'].$filename)) {
            // Directory exists
            return '';
        } 


        // delete kalau ada, buat kalau kosong
        $this->delete_directory($config['upload_path'].$filename);
        mkdir($config['upload_path'].$filename);
        $config['upload_path']   = $config['upload_path'].$filename;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('filespj')) {
            // If file upload fails, display errors
            $error = array('error' => $this->upload->display_errors());
            
            return $error;
        } else {
            // If file upload is successful, process the uploaded file
            $data = array('upload_data' => $this->upload->data());
            
            return $data;
        }
    }

    public function delete_directory($directoryPath) {
        // Check if the directory exists
        if (is_dir($directoryPath)) {
            // Delete the directory recursively
            delete_files($directoryPath, TRUE);

            // Check if the directory is empty after deletion
            if (!file_exists($directoryPath) || count(scandir($directoryPath)) == 2) {
                rmdir($directoryPath);
                echo "Directory deleted successfully.";
            }
        } 
    }

    public function procedd($id) {
        $data = $this->data;

        $data['kategori'] = $this->Kategori->getList();

        $data['list_edit'] = $this->Proses->getByID($id) ;

        $filename = $data['list_edit']->filespj;

        $filedir = "./uploads/filespj/".$filename;

        $filenameWithoutExtension = substr($filename, 0, strrpos($filename, '.'));

        $jsonFilePath = $filedir . '/'.strtolower($filenameWithoutExtension).'.json'; // Replace with the path to your JSON file

        // Read the JSON file contents
        $jsonData = file_get_contents($jsonFilePath);

        // Decode the JSON data into a PHP associative array
        $data['list'] = json_decode($jsonData, true);

        $this->load->view('inc/proses/procedd', $data);
    }

    public function details($id) {
        $data = $this->data;

        $data['kategori'] = $this->Kategori->getList();

        $data['list_edit'] = $this->Proses->getByID($id) ;

        $data['list'] = $this->Proses->getListDetail($id);

        $this->load->view('inc/proses/details', $data);
    }

    public function insert_data() {
        
        $err = $this->Proses->insertdetail();

        if ($err['code'] == '0') {
            $this->session->set_flashdata('success', 'Berhasil Menambahkan Data');
        } else {
            $this->session->set_flashdata('failed', 'Gagal Menambahkan Data');
        }

        redirect($this->data['redirect']);
    }

}
