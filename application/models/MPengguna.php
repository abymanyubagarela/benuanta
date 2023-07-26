<?php  

	class MPengguna extends CI_Model
	{
		public function __construct() {
			parent::__construct();

	        ## declate table name here
	        $this->table_name = 'data_user' ;
	        $this->id_perwakilan = 99 ;
	        $this->id_role = 2 ;
	    }

	    ## get all data in table
	    function getAll() {
	    	$this->db->select('data_user.*, m_unit.name as unit');

	    	$this->db->where('data_user.is_active','1');

	    	$this->db->where('data_user.id_role !=','919');

	    	$this->db->join('m_unit', 'm_unit.id = data_user.id_unit', 'left'); 

	    	// $this->db->limit(1);

	        $query = $this->db->get($this->table_name);

	        return $query->result();
		}

		## get all data in table for list (select)
	    function getList() {
	    	
	    	$this->db->select('data_user.id, data_user.name');
	    	
	    	$this->db->where(array('is_active' => '1'));

	        $query = $this->db->get($this->table_name);

	        return $query->result();
		}

		## get data by id in table
	    function getByID($id) {
	        $this->db->where(array('id' => $id));
	        
	        $query = $this->db->get($this->table_name);
	        
	        return $query->row();
	    }

	    ## get column name in table
	    function getColumn() {

	        return $this->db->list_fields($this->table_name);
	    }

	    ## insert data into table
	    function insert() {
	        $a_input = array();
	       
	        foreach ($_POST as $key => $row) {
	            $a_input[$key] = $row;
	        }

	        $a_input['id_perwakilan']= $this->id_perwakilan;
	        $a_input['id_role']= $this->id_role;
	        $a_input['date_created'] = date('Y-m-d H:m:s');
	        $a_input['is_active']	 = '1';
	        $a_input['password']= md5('12345');

	        $this->db->insert($this->table_name, $a_input);

	        return $this->db->error();	        
	    }

	    ## update data in table
	    function update($id) {
	    	$a_input = array();

	    	$_data = $this->input->post() ;
	    	
	        foreach ($_data as $key => $row) {
	            $a_input[$key] = $row;
	        }

	        $a_input['date_updated'] = date('Y-m-d H:m:s');	    

	        if($a_input['email']) {
	        	$a_input['activation'] = 1;
	        } 

	        if($a_input['password']) {
	        	$a_input['password'] = md5($a_input['password']);
	        } else {
	        	unset($a_input['password']);
	        } 

	        $this->db->where('id', $id);
	        
	        $this->db->update($this->table_name, $a_input);

	        return $this->db->error(1);	        
	    }

	    ## delete data in table
		function delete($id) {
			$a_input = array();

			$a_input['is_active'] = '0';    
			
			$this->db->where('id', $id);

			$this->db->update($this->table_name, $a_input);

			return $this->db->error();	      
		}

		## delete data in table
		function resets($id) {
			$a_input = array();

			$a_input['password'] = md5('12345');

			$this->db->where('id', $id);

			$this->db->update($this->table_name, $a_input);

			return $this->db->error();	      
		}

		## get data by id in table
	    function getByKode($id) {
	        $this->db->where(array('kode' => $id));
	        
	        $query = $this->db->get($this->table_name);
	        
	        return $query->row();
	    }

	    function getLogin() {

			$_data = $this->input->post() ;

			foreach ($_data as $key => $row) {
	            $a_input[$key] = $row;
	        }

	        $this->db->select('
	        	data_user.id_role, 
	        	data_user.id_role, 
	        	data_user.id_perwakilan, 
	        	data_user.id_unit, 
	        	data_user.name, 
	        	data_user.nip, 
	        	data_user.email, 
	        	data_user.phone,
	        	data_user.id,
	        	data_user.activation
	        ');

	        $this->db->where(
	    		array(
	    			'data_user.nip' 	  => $a_input['nip'],
	    			'data_user.password'  => md5($a_input['password']),
	    			'data_user.is_active' => 1
	    		)
	    	);	   

	        $query = $this->db->get($this->table_name);
				        
	        return $query->row();
	    }

	}

?>