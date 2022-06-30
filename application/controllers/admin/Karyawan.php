<?php
class Karyawan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            // $url=base_url();
            $url = 'Administrator';
            redirect($url);
        };
		$this->load->model('M_karyawan');
    }
    
	function index(){
	if($this->session->userdata('akses')=='1'){
		$data['data']=$this->M_karyawan->get_karyawan();
		$this->load->view('admin/v_karyawan',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
    }

    // function retrieve_karyawan(){
    //     if($this->session->userdata('akses')==1){
    //         $this
    //     }
    // }

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

	function edit_karyawan(){
	if($this->session->userdata('akses')=='1'){

        $karyawan_id=$this->input->post('karyawan_id');
		$karyawan_nama=$this->input->post('edit_nama');
		$karyawan_tmpLahir=$this->input->post('edit_tmpLahir');
		$karyawan_tglLahir=$this->input->post('edit_tglLahir');
		$karyawan_jKelamin=$this->input->post('edit_jeniskelamin');
		$karyawan_domisili=$this->input->post('edit_domisili');
		$karyawan_status=$this->input->post('edit_status');
		$karyawan_isActive=$this->input->post('edit_isactive');
		
		if($this->M_karyawan->update_karyawan($karyawan_id,$karyawan_nama,$karyawan_tmpLahir,$karyawan_tglLahir,$karyawan_jKelamin,$karyawan_domisili,$karyawan_status,$karyawan_isActive) == 1){
			echo $this->session->set_flashdata('msg','<label class="label label-success">Pengguna Berhasil diupdate</label>');	
			redirect('admin/Karyawan');
		}else{
			echo $this->session->set_flashdata('msg','<label class="label label-success">Pengguna Gagal diupdate</label>');	
			redirect('admin/Karyawan');
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
}