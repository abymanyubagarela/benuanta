<?php  

	class MDashboard extends CI_Model
	{
		public function __construct() {
			parent::__construct();

	        ## declate table name here
	        $this->table_name = 'trx_proses' ;
	        $this->id_perwakilan = 99 ;
	    }

	    ## get all data in table
	    function getAll() {
	    	$this->db->where('is_active','1');

	        $query = $this->db->get('trx_proses');

	        return $query->result();
		}

		
		## get all data in table for list (select)
	    function getBarchart() {
	    	
	    	$this->db->select('trx_proses.total as total, trx_proses.kwi_tot as kwi_tot, master_partai.name as name_partai, master_kategori.name as name_kategori')->from('trx_proses')->join('master_partai','master_partai.id = trx_proses.id_partai')->join('master_kategori','master_kategori.id = trx_proses.id_kategori');
	    	$this->db->where('trx_proses.is_active','1');
	        $query = $this->db->get();

			$partai=$query->result();
			// $items = array();
			// foreach($partai as $obj=>$keys){
			
			// 	$items[] = $keys->name;
			// }

			$data = $partai;
			// Add more objects here...
	
		
		// Function to create the new 'sesuai' key based on 'total' and 'kwi_tot'
		function createSesuaiKey($object) {
			if ($object->total != $object->kwi_tot) {
				$object->sesuai = 0;
			} else {
				$object->sesuai = 1;
			}
			return $object;
		}
		
		// Apply the function to each object in the array
		$data_with_sesuai = array_map('createSesuaiKey', $data);
		
		// Group the data by 'name_partai' and count 'sesuai' and 'tidak sesuai'
		$grouped_data = array();
		foreach ($data_with_sesuai as $object) {
			$name_partai = $object->name_partai;
			$sesuai_value = $object->sesuai;
		
			// Create a new entry for the name_partai if it doesn't exist in the grouped_data array
			if (!isset($grouped_data[$name_partai])) {
				$grouped_data[$name_partai] = array(
					'name_partai' => $name_partai,
					'sesuai' => 0,
					'tidak_sesuai' => 0
				);
			}
		
			// Update 'sesuai' or 'tidak sesuai' count based on the current object's value of 'sesuai'
			if ($sesuai_value == 1) {
				$grouped_data[$name_partai]['sesuai']++;
			} else {
				$grouped_data[$name_partai]['tidak_sesuai']++;
			}
		}
		
		// Convert the grouped_data associative array into a simple indexed array
		$result = array_values($grouped_data);
		
		// Output the grouped data

	        return $result;
		}

		## get data by id in table
	    function getByID($id) {
	        $this->db->where(array('id' => $id));
	        
	        $query = $this->db->get('master_partai');
	        
	        return $query->row();
	    }

	    ## get column name in table
	    function getColumn() {

	        return $this->db->list_fields('master_partai');
	    }

	    ## insert data into table
	    function insert() {
	        $a_input = array();
	       
	        foreach ($_POST as $key => $row) {
	            $a_input[$key] = $row;
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
	        
	        $query = $this->db->get('master_partai');
	        
	        return $query->row();
	    }

	}

?>
