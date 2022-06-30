<?php
class Administrator extends CI_Controller{
    function __construct(){
        parent:: __construct();        
        $this->load->model('Mlogin');
    }
    function index(){
        $config = array(
            "webtitle" => $this->config->item('title')
        );
        $this->load->view('admin/v_login',$config);
    }
    function cekuser(){                
        $username=strip_tags(stripslashes($this->input->post('username',TRUE)));
        $password=strip_tags(stripslashes($this->input->post('password',TRUE)));
        $u=$username;
        $p=$password;
        $cadmin=$this->Mlogin->cekadmin($u,$p);
        if($cadmin->num_rows > 0){
         $this->session->set_userdata('masuk',true);
         $this->session->set_userdata('user',$u);
         $xcadmin=$cadmin->row_array();
         if($xcadmin['user_level']=='1')
            $this->session->set_userdata('akses','1');
            $idadmin=$xcadmin['user_id'];
            $user_nama=$xcadmin['user_nama'];
            $this->session->set_userdata('idadmin',$idadmin);
            $this->session->set_userdata('nama',$user_nama);
         if($xcadmin['user_level']=='2'){
             $this->session->set_userdata('akses','2');
             $idadmin=$xcadmin['user_id'];
             $user_nama=$xcadmin['user_nama'];
             $this->session->set_userdata('idadmin',$idadmin);
             $this->session->set_userdata('nama',$user_nama);
         } //Front Office       
        }else{
            redirect('Administrator/gagallogin');
        }       
        // print_r($this->session->userdata);die();
        
        if($this->session->userdata('masuk')==true){
            redirect('Administrator/berhasillogin');
        }else{
            redirect('Administrator/gagallogin');
        }
    }
        function berhasillogin(){
            redirect('Welcome');
        }
        function gagallogin(){            
            $url=base_url('Administrator');
            echo $this->session->set_flashdata('msg','Username Atau Password Salah');
            redirect($url);
        }
        function logout(){            
            $this->session->sess_destroy();
            $url=base_url('Administrator');
            redirect($url);
        }
}