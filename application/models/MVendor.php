<?php  

	class MVendor extends CI_Model
	{
		public function __construct() {
			parent::__construct();

	        ## declate table name here
	        $this->table_name = 'master_store' ;
	        $this->id_perwakilan = 99 ;
	    }

	    ## get all data in table
	    function getAll() {
	    	$this->db->where('is_active','1');

	        $query = $this->db->get('master_store');

	        return $query->result();
		}

		## get all data in table for list (select)
	    function getList() {
	    	
	    	$this->db->select('master_store.id, master_store.merk as name');
	    	
	    	$this->db->where(array('is_active' => '1'));

	        $query = $this->db->get('master_store');

	        return $query->result();
		}

		## get data by id in table
	    function getByID($id) {
	        $this->db->where(array('id' => $id));
	        
	        $query = $this->db->get('master_store');
	        
	        return $query->row();
	    }

	    ## get column name in table
	    function getColumn() {

	        return $this->db->list_fields('master_store');
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
	        
	        $query = $this->db->get('master_store');
	        
	        return $query->row();
	    }

	}

?>