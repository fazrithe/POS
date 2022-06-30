<?php
class Stock_minimum extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            // $url=base_url();
            $url = 'Administrator';
            redirect($url);
        };
		$this->load->model('M_barang');
    }

    function index(){
		if($this->session->userdata('akses')=='1'){			
			$this->load->view('admin/v_stock_minimum');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
    
	function retrieve_data(){
        $data = $this->M_barang->stok_minimum();
        echo json_encode($data);
    }
}