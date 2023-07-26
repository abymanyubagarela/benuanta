<?php  

	class MTPerangkatItem extends CI_Model
	{
		public function __construct() {
			parent::__construct();

	        ## declate table name here
	        $this->table_name = 'tr_peminjaman_perangkat_item' ;
	        $this->id_perwakilan = 99 ;
	        $this->id_peminjam = $this->session->userdata['auth']->id ;
	    }

	    ## get all data in table
	    function getAll($id) {
	    	$this->db->select('
	    		tr_peminjaman_perangkat_item.*, 
	    		data_user.name as peminjam,
	    		m_perangkat.name as perangkat
	    	');

	    	$this->db->where('tr_peminjaman_perangkat_item.is_active','1');

	    	$this->db->join('data_user', 'data_user.id = tr_peminjaman_perangkat_item.id_peminjaman', 'left'); 

	    	$this->db->join('m_perangkat', 'm_perangkat.id = tr_peminjaman_perangkat_item.id_perangkat', 'left'); 

            $this->db->where('tr_peminjaman_perangkat_item.id_peminjaman', $id);


	        $query = $this->db->get($this->table_name);

	        return $query->result();
		}

		## get all data in table for list (select)
	    function getList() {
	    	
	    	$this->db->select('tr_peminjaman_perangkat_item.id, tr_peminjaman_perangkat_item.name');
	    	
	    	$this->db->where(array('is_active' => '1'));

	        $query = $this->db->get($this->table_name);

	        return $query->result();
		}

		## get data by id in table
	    function getByID($id) {

	    	$this->db->select('
	    		tr_peminjaman_perangkat_item.*, 
	    		data_user.name as peminjam,
	    		m_perangkat.name as perangkat
	    	');

	    	$this->db->where('tr_peminjaman_perangkat_item.is_active','1');

	    	$this->db->join('data_user', 'data_user.id = tr_peminjaman_perangkat_item.id_peminjaman', 'left'); 

	    	$this->db->join('m_perangkat', 'm_perangkat.id = tr_peminjaman_perangkat_item.id_perangkat', 'left'); 

	        $this->db->where(array('tr_peminjaman_perangkat_item.id' => $id));
	        
	        $query = $this->db->get($this->table_name);
	        
	        return $query->row();
	    }

	    ## get column name in table
	    function getColumn() {

	        return $this->db->list_fields($this->table_name);
	    }

	    ## insert data into table
	    function insert($id) {
	        $a_input = array();
	       
	        foreach ($_POST as $key => $row) {
	            $a_input[$key] = $row;
	        }

	        $a_input['date_created'] = date('Y-m-d H:m:s');
	        $a_input['created_by'] = $this->session->userdata['auth']->id;
	        $a_input['is_active']	 = '1';
	        $a_input['id_perwakilan']= $this->id_perwakilan;
	        $a_input['id_peminjaman']= $id;

	        
            $a_input['bmn'] = str_replace(' ', '', $a_input['bmn']);
            
            $splitbmn = explode(";",$a_input['bmn']);

            // print_r($splitbmn);die()    ;

            $count = 0;

            foreach ($splitbmn as $key => $item) {
                if(!empty($item)) {
                    $count++;
                }
            }
            
	        $a_input['jumlah'] = $count;

            // print_r($a_input['jumlah']);die()   ;

	        $this->db->insert($this->table_name, $a_input);

	        return $this->db->error();	        
	    }

	    ## update data in table
	    function update($id) {
	    	$_data = $this->input->post() ;

	        foreach ($_data as $key => $row) {
	            $a_input[$key] = $row;
	        }

	        $a_input['date_updated'] = date('Y-m-d H:m:s');	   

            $a_input['bmn'] = str_replace(' ', '', $a_input['bmn']);
            
            $splitbmn = explode(";",$a_input['bmn']);

            // print_r($splitbmn);die()    ;

            $count = 0;
            
            foreach ($splitbmn as $key => $item) {
                if(!empty($item)) {
                    $count++;
                }
            }
            
            $a_input['jumlah'] = $count;
	        
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


        ####### REPORT #######
        function getByPeminjaman($id_peminjaman) {
            $this->db->select('
                m_perangkat.name as perangkat,
                tr_peminjaman_perangkat_item.merk,
                tr_peminjaman_perangkat_item.bmn,
                tr_peminjaman_perangkat_item.jumlah,                
            ');

            $this->db->join('m_perangkat', 'm_perangkat.id = tr_peminjaman_perangkat_item.id_perangkat', 'left'); 

            $this->db->where('tr_peminjaman_perangkat_item.id_peminjaman', $id_peminjaman);

            $this->db->where('tr_peminjaman_perangkat_item.is_active','1');

            $this->db->order_by('tr_peminjaman_perangkat_item.jumlah');

            $query = $this->db->get($this->table_name);

            return $query->result();
        }

	}

?>