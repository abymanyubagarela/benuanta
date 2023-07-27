<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CDashboard extends CI_Controller {

	var $data = array();
	function __construct() {
		parent::__construct();
		
	

		$this->data = array(
            'controller'=>'cpartai',
            'redirect'=>'partai',
            'title'=>'Dashboard',
            'parent'=>'referensi'
        );

      
		## load model here 
		$this->load->model('MDashboard', 'Dashboard');
        $this->load->model('MVendor', 'Vendor');
	}

	public function index()	{	

		$data = $this->data;

		

		$data['list'] = $this->Dashboard->getAll();
		$data['barChart'] = json_encode($this->Dashboard->getBarchart());


        // get table vendor
        $data['vendor'] = $this->Vendor->getAll();

        // print_r($data);die();
		$this->load->view('inc/dashboard/index', $data);
	}

	public function test(){
	
		dd($this->Dashboard->getBarchart());
	}





}
