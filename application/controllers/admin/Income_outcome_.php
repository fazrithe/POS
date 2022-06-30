<?php
class Income_outcome extends CI_Controller{
	function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            // $url=base_url();
            $url = 'Administrator';
            redirect($url);
        };
        $this->load->model('M_customer');
        $this->load->model('M_Income_outcome');
        $this->load->model('M_setoran_hutang');
    }
    
	function index(){
        if($this->session->userdata('akses')=='1'){
            $data['data']=$this->M_setoran_hutang->show_all();
            // $data['detail']=$this->M_setoran_hutang->expand_data();
            $this->load->view('admin/v_income_outcome',$data);
        }else{
            echo "Halaman tidak ditemukan";
        }
    }

    function store(){
        if(!empty($this->input->post('submit'))){
            echo "<pre>";
            
            $dataStore = $_POST;
            // for ($i = 0; $i < count($dataStore['tgl']); $i++){
            //     print_r($dataStore['tgl'][$i]);
            //     print_r($dataStore['io'][$i]);
            //     print_r($dataStore['description'][$i]);
            //     print_r($dataStore['nominal'][$i]);
            //     // break;                
            //     echo "</br>";
            // }
            $insert_user   = $this->session->userdata('nama');

            if($this->M_Income_outcome->simpan_history($dataStore,$insert_user)==1){
                echo $this->session->set_flashdata('msg','<label class="label label-success">Data berhasil diinput</label>');			
		        redirect('admin/Income_outcome');
            }else{
                echo $this->session->set_flashdata('msg','<label class="label label-danger">Data gagal diinput</label>');			
		        redirect('admin/Income_outcome');
            }  
            // print_r($dataStore['tgl'][0]);
            // print_r(count($dataStore['tgl']));
            // exit();

            // foreach($dataStore as $rangeData=>$val){
            //     if ($rangeData == "submit"){                    
            //         continue;
            //     }
            //     // print_r($rangeData);
            //     print_r($val[0]);
            //     echo "</br>";
                                
                
            //     // print_r($dataStore[$rangeData]);
            //     // print_r($val);
            //     // foreach($rangeData as $detailData){
            //     //     print_r($detailData);
            //     // }
            //     // break;
            // }
            // exit();        
        }          
    }

    function setor_uang(){
        if($this->session->userdata('akses')=='1'){
            $custid   = $this->input->post('custid');
            $nofak    = $this->input->post('nofak');
            // $customer = $this->input->post('customer');
            $hutang   = $this->input->post('hutang');
            // $total    = $this->input->post('total');
            $setoran  = $this->input->post('setoran');
            $flagging = 0;
            $sisa_hutang = $hutang - $setoran;
            // $tmpVal   = $hutang - $total;
            // echo $hutang; die();
            $insert_date = date("Y-m-d H:i:s");
            $update_date = date("Y-m-d H:i:s");
            $insert_user = $this->session->userdata('nama');
            $update_user = $this->session->userdata('nama');
            $tmpVal      = $setoran - $hutang;
            $fetched_records = $this->M_setoran_hutang->get_mapping($custid)->result_array();
            $id_mapping = 0;

            if (count($fetched_records) > 0){
                foreach($fetched_records as $a){                
                    $id_mapping = $a['id_mapping'];                    
                }      
            }
            if ($tmpVal == 0){
                $flagging = 1;
            }
            
            $param = array($custid,$id_mapping,$nofak,$setoran,$flagging,$insert_date,$update_date,$insert_user,$update_user,$sisa_hutang);

            $data['status'] = 0;
            $data['message'] = "Data gagal disimpan!";
            // echo $tmpVal;die();
            if ($tmpVal == 0){
                if($this->M_setoran_hutang->f_hutang_lunas($nofak,$custid,$setoran,$param)){
                    $data['status'] = 1;
                    $data['message'] = "Setoran berhasil disimpan";
                }

            }else{
                if($this->M_setoran_hutang->f_hutang_exist($custid,$setoran,$param)){
                    $data['status'] = 1;
                    $data['message'] = "Setoran berhasil disimpan";
                }
            }
            echo json_encode($data);
            return;

        }else{
            echo "Halaman tidak ditemukan";
        }
    }

    function tambah_customer(){                 
        if($this->session->userdata('akses')==1){        
            $customer_name     = $this->input->post('customer_name');
            $customer_limit    = $this->input->post('customer_limit'); 
            $customer_hutang   = $this->input->post('customer_hutang');
            $customer_alamat   = $this->input->post('customer_alamat');
            $customer_telepon  = $this->input->post('customer_telepon');
            $customer_flagging = $this->input->post('customer_flagging');                        
            $insert_date       = date("Y-m-d H:i:s");
            $update_date       = date("Y-m-d H:i:s");
            $insert_user       = $this->session->userdata('nama');
            $update_user       = $this->session->userdata('nama');
        };        

        $param = array($customer_name,$customer_limit,$customer_hutang,$customer_alamat,$customer_telepon,$customer_flagging,$insert_date,$update_date,$insert_user,$update_user);            
        
        if($this->M_customer->simpan_customer($param)==1){
            $data['status'] = 1;
            $data['message'] = "Data area berhasil disimpan";
        }else{
            $data['status'] = 0;
            $data['message'] = "Data area gagal disimpan";
        }        
        echo json_encode($data);
        return;
    }

    function edit_customer(){
        // echo "a";die();
        if($this->session->userdata('akses') == '1'){
            $custId      = $this->input->post('custId');
            $custName    = $this->input->post('custName');
            $custLimit   = $this->input->post('custLimit');
            $custHutang  = $this->input->post('custHutang');
            $custAlamat  = $this->input->post('custAlamat');
            $custTlp     = $this->input->post('custTlp');
            $update_date = date("Y-m-d H:i:s");
            $update_user = $this->session->userdata('nama');

            $param = array($custId,$custName,$custLimit,$custHutang,$custAlamat,$custTlp,$update_date,$update_user);

            if($this->M_customer->update_customer($param)==1){
                $data['status'] = 1;
                $data['message'] = "Data customer berhasil diupdate";
            }else{
                $data['status'] = 0;
                $data['message'] = "Data customer gagal diupdate";
            }        
            echo json_encode($data);
            return;
        }
    }

    function data_detail(){
        if($this->session->userdata('akses')=='1'){
            $nofak=$this->input->post('nofak');
            // echo $nofak;die();
            // $data['status'] = 0;
            // $data['message'] = "Gagal hapus data customer";
            
            
            $fetched_records = $this->M_setoran_hutang->data_detail($nofak)->result_array();
            // $data['detail'] = $fetched_records;
            $setoran = "";
            $nofak  = "";
            $tanggal = "";
            $sisa_hutang = "";
            $flagging = "";
            $arr = [];
            foreach($fetched_records as $a){ 
                $newArr = [];
                $id = $a['id_setoran'];               
                $nofak = $a['nofak'];
                $setoran = $a['setoran'];
                $tanggal = $a['insert_datetime'];
                $sisa_hutang = $a['sisa_hutang'];
                $flagging = $a['flagging'];  
                
                if ($sisa_hutang == ""){
                    $sisa_hutang = 0;
                };
                if ($flagging == 0){
                    $flagging = "Belum Lunas";
                }else{
                    $flagging = "Lunas";
                };
                array_push($newArr,$id);
                array_push($newArr,$nofak);
                array_push($newArr,number_format($setoran));
                array_push($newArr,$tanggal);
                array_push($newArr,number_format($sisa_hutang));
                array_push($newArr,$flagging);
                array_push($arr,$newArr);
            // $data['nofak'] = $nofak;
            // $data['setoran'] = $setoran;
            // $data['tanggal'] = $tanggal;
            // $data['sisa_hutang'] = $sisa_hutang;
            // $data['flagging'] = $flagging;
            }
            $data['detail'] = $arr;
            // print_r($arr);die();
            
            
            echo json_encode($data);            
        }else{
            echo "Halaman tidak ditemukan";
        }
    }

	function nonaktifkan(){
        if($this->session->userdata('akses')=='1'){
            $customer_id=$this->input->post('customer_id');
            $data['status'] = 0;
            $data['message'] = "Gagal hapus data customer";
            
            
            $fetched_records = $this->M_customer->validasi_delete($customer_id)->result_array();
            $hutang = 0;
            $customer_name = "";                        
            foreach($fetched_records as $a){
                $hutang = $a['customer_hutang'];
                $customer_name = $a['customer_name'];
            }            

            if ($hutang == 0){
                if($this->M_customer->update_status($customer_id)==1){
                    $data['status'] = 1;
                    $data['message'] = "Sukses hapus data customer";
                };                
            }else{
                $data['status'] = -1;
                $data['message'] = "Gagal hapus data customer, $customer_name masih memiliki hutang";
            }
            echo json_encode($data);            
        }else{
            echo "Halaman tidak ditemukan";
        }
	}
}