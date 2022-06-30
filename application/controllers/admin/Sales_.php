<?php
class Sales extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            // $url=base_url();
            $url = 'Administrator';
            redirect($url);
        };
        $this->load->model('M_sales');
        $this->load->model('M_karyawan');
    }

    function getKaryawan(){
        $searchTerm = $this->input->post('searchTerm');
        $data = $this->M_karyawan->get_sales($searchTerm);        
        echo json_encode($data);
    }

    function tambah_sales(){                
        if($this->session->userdata('akses')==1){        
            $karyawan_id         = $this->input->post('karyawan_id');
            $sales_area          = $this->input->post('sales_area');
            $sales_konsumen      = $this->input->post('sales_konsumen');
            $sales_isActive      = $this->input->post('sales_isActive');  
            $sales_id            = $this->input->post('karyawan_id');        
        };            
        
        $return = false;
        
        if($this->cek_sales($karyawan_id) > 0){
            if($this->M_sales->simpan_sales_detail($sales_id,$sales_area,$sales_konsumen) == 1){                
                $return = true;
            }
        }else{
            if(($this->M_sales->simpan_sales_master($sales_id,$karyawan_id,$sales_isActive) == 1) && ($this->M_sales->simpan_sales_detail($sales_id,$sales_area,$sales_konsumen) == 1)){
                $return = true;                
            }else{
                $return = false;
            }        
        }

        // $data['status'] = 0;
        $data['message'] = "Data gagal disimpan";

        if($return){
            // $data['status'] = 1;
            $data['message'] = "Data berhasil disimpan";
        }
        echo json_encode($data);
        return;
    }

    function cek_sales($karyawan_id){
        if($this->session->userdata('akses')==1){            
            $result = $this->M_sales->validasi_sales($karyawan_id);   
            return $result;
        }
    }
    
	function index(){
        if($this->session->userdata('akses')=='1'){
            $data['data']=$this->M_sales->get_sales();
            $this->load->view('admin/v_sales',$data);
            // $this->load->view('admin/coba');
        }else{
            echo "Halaman tidak ditemukan";
        }
    }

    function tambah_karyawan(){                
        if($this->session->userdata('akses')==1){        
            $karyawan_nama         = $this->input->post('karyawan_nama');
            $karyawan_tmpLahir     = $this->input->post('karyawan_tmpLahir');
            $karyawan_tglLahir     = $this->input->post('karyawan_tglLahir');
            $karyawan_jenisKelamin = $this->input->post('karyawan_jenisKelamin');
            $karyawan_domisili     = $this->input->post('karyawan_domisili');
            $karyawan_status       = $this->input->post('karyawan_status');
            $karyawan_isActive     = $this->input->post('karyawan_isActive');
        };        
        $param = array($karyawan_nama,$karyawan_tmpLahir,$karyawan_tglLahir,$karyawan_jenisKelamin,$karyawan_domisili,$karyawan_status,$karyawan_isActive);            
        
        if($this->M_karyawan->simpan_karyawan($param)==1){
            $data['status'] = 1;
            $data['message'] = "Data karyawan berhasil disimpan";
        }else{
            $data['status'] = 0;
            $data['message'] = "Data karyawan gagal disimpan";
        }
        // print_r($data);
        echo json_encode($data);
        return;
    }

    function edit_sales(){
        if($this->session->userdata('akses')=='1'){
            $karyawan_id = $this->input->post('sss');
            $sales_id = $this->input->post('sales_id');
            $sales_area = $this->input->post('edit_area');
            $sales_buyer = $this->input->post('edit_buyer');
            $sales_isactive = $this->input->post('edit_isactive');
            $sales_mapping_id = $this->input->post('sales_mapping_id');
            // echo $this->M_sales->update_sales_master($karyawan_id,$sales_id,$sales_isactive)."1st";
            // echo $this->M_sales->update_sales_detail($sales_mapping_id,$sales_area,$sales_buyer)."2nd";
            // echo $sales_id."-".$karyawan_id."-".$edit_area."-".$edit_buyer."-".$edit_isactive."-".$sales_mapping_id;
            if(($this->M_sales->update_sales_master($karyawan_id,$sales_id,$sales_isactive) == 1) && ($this->M_sales->update_sales_detail($sales_mapping_id,$sales_area,$sales_buyer) == 1)){
                echo $this->session->set_flashdata('msg','<label class="label label-success">Pengguna Berhasil diupdate</label>');	
                redirect('admin/Sales');
            }else{
                echo $this->session->set_flashdata('msg','<label class="label label-success">Pengguna Gagal diupdate</label>');	
                redirect('admin/Sales');
            }
        }else{
            echo "Halaman tidak ditemukan";
        }        
    }

	function nonaktifkan(){
	if($this->session->userdata('akses')=='1'){
		$karyawan_id=$this->input->post('karyawan_id');
		$data['status'] = 0;
		$data['message'] = "Gagal hapus data karyawan";
		if($this->M_karyawan->update_status($karyawan_id)==1){
			$data['status'] = 1;
			$data['message'] = "Sukses hapus data karyawan";
		};
		echo json_encode($data);
	}else{
        echo "Halaman tidak ditemukan";
    }
    }
    
    function searchEngine(){
        if($this->session->userdata('akses')=='1'){                                
            $search = $this->input->post("search");
            $url='http://10.1.35.40:8382/api/searchElastic';                                             
            $ch = curl_init();                         
            curl_setopt($ch,CURLOPT_URL,$url); 
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,"{ \"search\":\"$search\"}");                                              
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch,CURLOPT_POSTFIELDS,$search);                                              
            $data = curl_exec($ch);
            curl_close($ch);
            // print_r($output);die();
            // $data["status"] = $output.status;
            // $data["detail"] = $output["data"];
            
            echo json_encode($data);
        }else{
            echo "Halaman tidak ditemukan";
        }
    }
}
