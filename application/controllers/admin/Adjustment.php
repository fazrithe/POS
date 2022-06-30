<?php
class Adjustment extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url="Administrator";
            redirect($url);
        };
        $this->load->model('M_stock_opname');
    }

    function index(){
        if($this->session->userdata('akses')=='1'){
            $data['data']=$this->M_stock_opname->result_so();
            $this->load->view('admin/v_adjustment',$data);
        }else{
            echo "Halaman tidak ditemukan";
        }
    }

    function proses_adjustment(){
        if($this->session->userdata('akses')=='1'){
            $mapAdjustment = $this->input->post('json');                    
            $false = 0;
            for($i=0;$i<count($mapAdjustment);$i++){       
                $barang_id = $mapAdjustment[$i]['barang_id'];
                $qty = $mapAdjustment[$i]['qty'];
                if($this->M_stock_opname->update_adjustment($barang_id,$qty)!=1){
                    $false++;
                }
            }
            if ($false > 0){
                $data['status'] = 0;
                $data['message'] = "Proses adjustment gagal!";
                echo json_encode($data);
            }else{
                $data['status'] = 1;
                $data['message'] = "Proses adjustment berhasil!";
                echo json_encode($data);
            }
        }
    }

    
}