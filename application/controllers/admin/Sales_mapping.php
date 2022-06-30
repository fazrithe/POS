<?php
class Sales_mapping extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            // $url=base_url();
            $url = 'Administrator';
            redirect($url);
        };
        $this->load->model('M_sales_mapping');
        $this->load->model('M_sales');
        $this->load->model('M_customer');
        $this->load->model('M_area');
    }
    
	function index(){
        if($this->session->userdata('akses')=='1'){
            $data['data']=$this->M_sales_mapping->get_init();
            $this->load->view('admin/v_sales_mapping',$data);
        }else{
            echo "Halaman tidak ditemukan";
        }
    }

    function get_sales(){        
        $searchTerm = $this->input->post('searchTerm');
        $fetched_records = $this->M_sales->get_sales($searchTerm);        
        $sales = $fetched_records->result_array();

        // Initialize Array with fetched data
		$data = array();
		foreach($sales as $arrSales){
		    $data[] = array("id"=>$arrSales['sales_id'], "text"=>$arrSales['karyawan_nama']);
		}
        echo json_encode($data);        
    }

    function get_customer(){        
        $searchTerm = $this->input->post('searchTerm');        
        $fetched_records = $this->M_customer->get_customer($searchTerm); 
        
        $cust = $fetched_records->result_array();

        // Initialize Array with fetched data
		$data = array();
		foreach($cust as $arrCust){
		    $data[] = array("id"=>$arrCust['customer_id'], "text"=>$arrCust['customer_name'],"limit"=>$arrCust['customer_limit'],"hutang"=>$arrCust['customer_hutang']);
        }                
        
        echo json_encode($data);
    }

    function get_area(){
        $searchTerm = $this->input->post('searchTerm');
        $fetched_records = $this->M_area->get_area($searchTerm); 
        
        $area = $fetched_records->result_array();

        // Initialize Array with fetched data
		$data = array();
		foreach($area as $arrArea){
		    $data[] = array("id"=>$arrArea['id_area'], "text"=>$arrArea['area_nama']);
		}
        echo json_encode($data);
    }

    function insert_map(){
        if($this->session->userdata('akses')==1){
            $selSales    =  $this->input->post('selSales');
            $selCust     =  $this->input->post('selCust');
            $selArea     =  $this->input->post('selArea');
            $insert_user = $this->session->userdata('nama');
            $update_user = $this->session->userdata('nama');
            
            $param    = array($selSales,$selCust,$selArea,$insert_user,$update_user);            

            //default = if data already stored in db, we no need to insert
            $data['status'] = 0;
            $data['message'] = "Data customer sudah ada di database";
            // if not exist in db do insert
            $fetched_records = $this->M_sales_mapping->validasi_insert($param)->result_array();

            $map_flag = "";
            $id_mapping = "";
            
            foreach($fetched_records as $a){                
                $map_flag = $a['map_flag'];
                $id_mapping = $a['id_mapping'];
            }                            
            
            if(count($fetched_records) == 0){
                if($this->M_sales_mapping->insert_salesMap($param)==1){
                    $data['status'] = 1;
                    $data['message'] = "Data sudah disimpan";
                }else {
                    $data['status'] = -1;
                    $data['message'] = "Data gagal disimpan, kesalahan koneksi, hubungi sistem administrator";
                }
            }else if(count($fetched_records >= 1) && $map_flag == 0){
                if($this->M_sales_mapping->aktif_map($id_mapping) == 1){
                    $data['status'] = 2;
                    $data['message'] = "Data sudah disimpan";
                }else{
                    $data['status'] = 3;
                    $data['message'] = "Data gagal disimpan, kesalahan koneksi, hubungi sistem administrator";
                }
            }
            echo json_encode($data);
            return;
        }else{
            echo "Halaman tidak ditemukan";
        }
    }

    function edit_data(){
        if($this->session->userdata('akses') == '1'){
            $mappingId = $this->input->post('mappingId');
            $salesId = $this->input->post('salesId');
            $custId = $this->input->post('custId');
            $areaId = $this->input->post('areaId');
            $update_date = date("Y-m-d H:i:s");
            $update_user = $this->session->userdata('nama');

            $param = array($salesId,$custId,$areaId,$mappingId,$update_date,$update_user);
            
            $data['status'] = 0;
            $data['message'] = "Gagal edit, data customer sudah ada di database";

            $fetched_records = $this->M_sales_mapping->validasi_insert($param)->result_array();
            if(count($fetched_records)==0){
                if($this->M_sales_mapping->update_map($param)==1){
                    $data['status'] = 1;
                    $data['message'] = "Data sudah disimpan";
                }else{
                    $data['status'] = -1;
                    $data['message'] = "Data gagal disimpan, kesalahan koneksi, hubungi sistem administrator";
                }
            }
            echo json_encode($data);
            return;

        }else{
            echo "Halaman tidak ditemukan";
        }
    }

	function nonaktifkan(){
        if($this->session->userdata('akses')=='1'){
            $mappingId=$this->input->post('mappingId');
            $data['status'] = 0;
            $data['message'] = "Gagal hapus data mapping";
            if($this->M_sales_mapping->nonaktif_map($mappingId)==1){
                $data['status'] = 1;
                $data['message'] = "Sukses hapus data mapping";
            };
            echo json_encode($data);
        }else{
            echo "Halaman tidak ditemukan";
        }
	}
}