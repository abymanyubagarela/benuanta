<?php  

	class MEmail extends CI_Model
	{
		public function __construct() {
			parent::__construct();
	    }

	    
	    function sendEmail() {
	    	$config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'subbagumumti.jakarta@gmail.com',
                'smtp_pass' => 'DkiJakarta123',
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1'
            );

            $this->load->library('email', $config);
            
            $this->email->from('subbagumumti.jakarta@gmail.com', 'DkiJakarta123');

            $this->email->to('abymanyubagarela@gmail.com');
            $this->email->subject('tes');
            $this->email->message('msf');
            $this->email->set_newline("tes\r\n");

            $result = $this->email->send();
            // $this->email->print_debugger();
		}

	}

?>