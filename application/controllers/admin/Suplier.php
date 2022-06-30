<?php
class Suplier extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
			// $url=base_url();
			$url = 'Administrator';
            redirect($url);
        };
		$this->load->model('M_suplier');
	}
	function index(){
	if($this->session->userdata('akses')=='1'){
		$data['data']=$this->M_suplier->tampil_suplier();
		$this->load->view('admin/v_suplier',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function tambah_suplier(){
	if($this->session->userdata('akses')=='1'){
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$notelp=$this->input->post('notelp');
		$this->M_suplier->simpan_suplier($nama,$alamat,$notelp);
		redirect('admin/Suplier');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function edit_suplier(){
	if($this->session->userdata('akses')=='1'){
		$kode=$this->input->post('kode');
		$nama=$this->input->post('nama');
		$alamat=$this->input->post('alamat');
		$notelp=$this->input->post('notelp');
		$this->M_suplier->update_suplier($kode,$nama,$alamat,$notelp);
		redirect('admin/Suplier');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function hapus_suplier(){
	if($this->session->userdata('akses')=='1'){
		$kode=$this->input->post('kode');
		$this->M_suplier->hapus_suplier($kode);
		redirect('admin/Suplier');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
}