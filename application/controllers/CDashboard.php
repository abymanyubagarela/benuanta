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
        $this->load->model('MProses', 'Proses');
	}

	public function index()	{	

		$data = $this->data;

		

		$data['list'] = $this->Dashboard->getAll();
		$data['barChart'] = json_encode($this->Dashboard->getBarchart());


        // get table vendor
        $data['vendor'] = $this->Vendor->getAll();

        
        $originalData = $this->Proses->getAll();
        
        $newData = array();

        // Iterasi pada data awal
        foreach ($originalData as $item) {
            $partai = $item->partai;
            $total = $item->total;
            $kwi_tot = $item->kwi_tot;

            // Inisialisasi data baru jika partai belum ada di $newData
            if (!isset($newData[$partai])) {
                $newData[$partai] = array(
                    'partai' => $partai,
                    'total_spj' => 0,
                    'sesuai' => 0,
                    'tidaksesuai' => 0
                );
            }

            // Hitung total SPJ berdasarkan partai
            $newData[$partai]['total_spj'] += $total;

            // Hitung sesuai dan tidak sesuai berdasarkan kondisi total=kwi_tot
            if ($total == $kwi_tot) {
                $newData[$partai]['sesuai']++;
            } else {
                $newData[$partai]['tidaksesuai']++;
            }
        }

        // Hasil akhir dalam bentuk array
        $data['rekap'] = array_values($newData);

        // print_r($result);die();

		$this->load->view('inc/dashboard/index', $data);
	}

	public function test(){
	
		dd($this->Dashboard->getBarchart());
	}





}
