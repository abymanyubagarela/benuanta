<?php 
    if ($this->session->userdata('auth')->id_role != '2') {
        $this->load->view('layout/navigation_admin') ;
    } else {
        $this->load->view('layout/navigation_common');
    }
?>