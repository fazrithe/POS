<?php
class Welcome extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){			
			// $url=base_url();
			$url = 'Administrator';
            redirect($url);
        };
	}
	
	function index(){
		$config = array(
            "webtitle" => $this->config->item('title')
        );
		$this->load->view('admin/v_index',$config);
	}
}