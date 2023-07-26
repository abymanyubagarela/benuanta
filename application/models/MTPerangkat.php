<?php  

	class MTperangkat extends CI_Model
	{
		public function __construct() {
			parent::__construct();

	        ## declate table name here
	        $this->table_name = 'tr_peminjaman_perangkat' ;
	        $this->id_perwakilan = 99 ;
	        $this->id_peminjam = $this->session->userdata['auth']->id ;
	        $this->role = $this->session->userdata['auth']->id_role ;
	    }

	    ## get all data in table
	    function getAll() {
	    	$this->db->select('
	    		tr_peminjaman_perangkat.*, 
	    		data_user.name as peminjam
	    	');

	    	
	    	$this->db->join('data_user', 'data_user.id = tr_peminjaman_perangkat.id_peminjam', 'left'); 
	    	
	    	$this->db->where('tr_peminjaman_perangkat.is_active','1');

	    	if($this->role != 1) {
				$this->db->where('tr_peminjaman_perangkat.id_peminjam',$this->id_peminjam);	    		
	    	}

	    	$this->db->where_in('tr_peminjaman_perangkat.status', array(1,2,3));

            $this->db->order_by("tr_peminjaman_perangkat.id", "desc");

	        $query = $this->db->get($this->table_name);

	        return $query->result();
		}

		## get all data in table
	    function getPengembalian() {
	    	$this->db->select('
	    		tr_peminjaman_perangkat.*, 
	    		data_user.name as peminjam
	    	');

	    	
	    	$this->db->join('data_user', 'data_user.id = tr_peminjaman_perangkat.id_peminjam', 'left'); 
	    	
	    	$this->db->where('tr_peminjaman_perangkat.is_active','1');

	    	if($this->role != 1) {
				$this->db->where('tr_peminjaman_perangkat.id_peminjam',$this->id_peminjam);	    		
	    	}

	    	$this->db->where_in('tr_peminjaman_perangkat.status', array(4,5));

            $this->db->order_by("tr_peminjaman_perangkat.id", "desc");

	        $query = $this->db->get($this->table_name);

	        return $query->result();
		}

		## get all data in table for list (select)
	    function getList() {
	    	
	    	$this->db->select('tr_peminjaman_perangkat.id, tr_peminjaman_perangkat.name');
	    	
	    	$this->db->where(array('is_active' => '1'));

	        $query = $this->db->get($this->table_name);

	        return $query->result();
		}

		## get data by id in table
	    function getByID($id) {

	    	$this->db->select('
	    		tr_peminjaman_perangkat.*, 
	    		data_user.name as peminjam,
                data_user.nip as nip,
                data_user.fullnip as fullnip,
                m_jabatan.name as jabatan
	    	');

	    	$this->db->where('tr_peminjaman_perangkat.is_active','1');

	    	$this->db->join('data_user', 'data_user.id = tr_peminjaman_perangkat.id_peminjam', 'left'); 

            $this->db->join('m_jabatan', 'm_jabatan.id = data_user.id_jabatan', 'left'); 

	        $this->db->where(array('tr_peminjaman_perangkat.id' => $id));
	        
	        $query = $this->db->get($this->table_name);
	        
	        return $query->row();
	    }

	    ## get column name in table
	    function getColumn() {

	        return $this->db->list_fields($this->table_name);
	    }

	    ## insert data into table
	    function insert($filename = null) {
	        $a_input = array();
	       
	        foreach ($_POST as $key => $row) {
	            $a_input[$key] = $row;
	        }

	        $a_input['date_created'] = date('Y-m-d H:m:s');
	        $a_input['created_by'] = $this->session->userdata['auth']->id;
	        $a_input['is_active']	 = '1';
	        $a_input['id_perwakilan']= $this->id_perwakilan;
	        $a_input['id_peminjam']= $this->id_peminjam;
	        $a_input['nota']= $filename;

	        $this->db->insert($this->table_name, $a_input);

	        return $this->db->error();	        
	    }

	    ## update data in table
	    function update($id, $filename=null) {
	    	$_data = $this->input->post() ;

	        foreach ($_data as $key => $row) {
	            $a_input[$key] = $row;
	        }

	        $a_input['date_updated'] = date('Y-m-d H:m:s');	   

	        if($filename) {
	        	$a_input['nota'] = $filename;
	        }     

	        if($a_input['status'] > 1) {
	        	$a_input['handled_by'] = $this->session->userdata['auth']->id;
	        }

	        // if($a_input['tanggal_peminjaman_selesai'] == null ) {
	        // 	$a_input['is_temporary'] = 0;
	        // }

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
	        
	        $query = $this->db->get($this->table_name);
	        
	        return $query->row();
	    }

        function getByStatus($status) {
            $this->db->select('id');

            $this->db->where('is_active','1');
            
            $this->db->where('status', $status);

            if($this->role == 2) {
                $this->db->where('id_peminjam', $this->id_peminjam);
            }

            $query = $this->db->get($this->table_name);
            
            return $query->result();
        }

	    public function mailtoborrower() {
	    	
	    }

	    public function mailtostaff() {
	    	
	    }

	}

?>