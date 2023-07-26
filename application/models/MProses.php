<?php  

	class MProses extends CI_Model
	{
		public function __construct() {
			parent::__construct();

	        ## declate table name here
	        $this->table_name = 'trx_proses' ;
	        $this->id_perwakilan = 99 ;
	    }

	    ## get all data in table
	    function getAll() {

            $this->db->select('
                master_partai.name as partai, 
                master_kategori.name as kategori,
                trx_proses.total,
                trx_proses.kwi_tot,
                trx_proses.id,
                trx_proses.is_proceed,
            ');

            $this->db->join('master_partai', 'master_partai.id = trx_proses.id_partai', 'left'); 

            $this->db->join('master_kategori', 'master_kategori.id = trx_proses.id_kategori', 'left'); 

            $this->db->where('trx_proses.is_active','1');
            
            $query = $this->db->get('trx_proses');

            return $query->result();
		}

		## get all data in table for list (select)
	    function getList() {
	    	
	    	$this->db->select('trx_proses.id, trx_proses.merk as name');
	    	
	    	$this->db->where(array('is_active' => '1'));

	        $query = $this->db->get('trx_proses');

	        return $query->result();
		}

		## get data by id in table
	    function getByID($id) {
	        $this->db->where(array('id' => $id));
	        
	        $query = $this->db->get('trx_proses');
	        
	        return $query->row();
	    }

	    ## get column name in table
	    function getColumn() {

	        return $this->db->list_fields('trx_proses');
	    }

	    ## insert data into table
	    function insert() {
	        $a_input = array();
	       
	        foreach ($_POST as $key => $row) {
	            $a_input[$key] = $row;
	        }

            if(!empty( $_FILES)) {
                $a_input['filespj'] = str_replace(" ","_", $_FILES['filespj']['name']);
            }

	        $a_input['is_active']   = '1';
            // $a_input['date_created'] = date('Y-m-d H:m:s');
	        // $a_input['id_perwakilan']= $this->id_perwakilan;

	        $this->db->insert($this->table_name, $a_input);

	        return $this->db->error();	        
	    }

	    ## update data in table
	    function update($id) {
	    	$_data = $this->input->post() ;
	    	
	        foreach ($_data as $key => $row) {
	            $a_input[$key] = $row;
	        }

	        $this->db->where('id', $id);
	        
	        $this->db->update($this->table_name, $a_input);

	        return $this->db->error(1);	        
	    }

	    ## delete data in table
		function delete($id) {
			$a_input['is_active'] = '0';    
			
			$this->db->where('id', $id);

			$this->db->update($this->table_name, $a_input);

			return $this->db->error();	      
		}

		## get data by id in table
	    function getByKode($id) {
	        $this->db->where(array('kode' => $id));
	        
	        $query = $this->db->get('trx_proses');
	        
	        return $query->row();
	    }


         ## insert data into table
        function insertdetail() {
            $a_input = array();

            $detail_input = array();

            $process_input = array();            
           
            foreach ($_POST as $key => $row) {
                $a_input[$key] = $row;
            }


            $totalSum = 0;

            // insert ke trx_detail
            $this->db->delete('trx_detail', array('id_trx' => $_POST['id_trx']));

            foreach ($a_input['data'] as $row) {
                $totalSum += $row['total'];
                $detail_input['id_trx'] = $_POST['id_trx'];
                $detail_input['tokok'] = $row['namaToko'];
                $detail_input['total'] = $row['total'];
                $detail_input['ispkp'] = $row['isPKP'];
                $this->db->insert("trx_detail", $detail_input);
            }

            // update ke trx process
            $process_input['is_proceed'] = 1;
            $process_input['kwi_tot'] = $totalSum;
            $this->db->where('id', $_POST['id_trx']);
            $this->db->update($this->table_name, $process_input);

            
            return $this->db->error();          
        }

        function getListDetail($id) {
            $this->db->where(array('id_trx' => $id));
                      
            $query = $this->db->get('trx_detail');

            return $query->result();
        }

	}

?>