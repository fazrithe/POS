<?php
class Authorized extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            // $url=base_url();
            $url = 'Administrator';
            redirect($url);
        };
        
		$this->load->model('M_authorized');
    }
    
	function index(){
        if($this->session->userdata('akses')=='1'){
            $fetched_records=$this->M_authorized->get_oldpassw()->result_array();
            $oldpassw = "";
            foreach($fetched_records as $a){
                $oldpassw = $a['password'];
            }
            // echo $oldpassw;
            $this->session->set_userdata('op',$oldpassw);
            $this->load->view('admin/v_authorized');
        }else{
            echo "Halaman tidak ditemukan";
        }
    }

    function change_password(){
        if($this->session->userdata('akses')=='1'){
            $passw = $this->input->post('newpassw'); 
            $update_date = date("Y-m-d H:i:s");
            $update_user = $this->session->userdata('nama');           
            $data['status'] = 0;
            $data['message'] = "Failed update password";
            if($this->M_authorized->change_password($passw,$update_user,$update_date)==1){
                $data['status'] = 1;
                $data['message'] = "Password has been updated";
            };
            echo json_encode($data);
        }else{
            echo "Halaman tidak ditemukan";
        }
    }

    function tambah_area(){         
        // echo "a";die();       
        if($this->session->userdata('akses')==1){        
            $area_name     = $this->input->post('area_name');
            $area_flagging = $this->input->post('area_flagging');            
            $insert_date   = date("Y-m-d H:i:s");
            $update_date   = date("Y-m-d H:i:s");
            $insert_user   = $this->session->userdata('nama');
            $update_user   = $this->session->userdata('nama');
        };        

        $param = array($area_name,$area_flagging,$insert_date,$update_date,$insert_user,$update_user);            
        
        if($this->M_area->simpan_area($param)==1){
            $data['status'] = 1;
            $data['message'] = "Data area berhasil disimpan";
        }else{
            $data['status'] = 0;
            $data['message'] = "Data area gagal disimpan";
        }        
        echo json_encode($data);
        return;
    }

	function edit_area(){
        if($this->session->userdata('akses')=='1'){

            $area_id     = $this->input->post('area_id');
            $area_name   = $this->input->post('area_name');
            $update_date = date("Y-m-d H:i:s");
            $update_user = $this->session->userdata('nama');

            if($this->M_area->update_area($area_id,$area_name,$update_date,$update_user) == 1){
                echo $this->session->set_flashdata('msg','<label class="label label-success">Pengguna Berhasil diupdate</label>');	
                redirect('admin/Area');
            }else{
                echo $this->session->set_flashdata('msg','<label class="label label-success">Pengguna Gagal diupdate</label>');	
                redirect('admin/Area');
            }
        }else{
            echo "Halaman tidak ditemukan";
        }
	}

	function nonaktifkan(){
        if($this->session->userdata('akses')=='1'){
            $area_id=$this->input->post('area_id');
            $data['status'] = 0;
            $data['message'] = "Gagal hapus data area";
            if($this->M_area->update_status($area_id)==1){
                $data['status'] = 1;
                $data['message'] = "Sukses hapus data area";
            };
            echo json_encode($data);
        }else{
            echo "Halaman tidak ditemukan";
        }
	}
}