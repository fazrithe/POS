<?php
class Kategori extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
			// $url=base_url();
			$url = 'Administrator';
            redirect($url);
        };
		$this->load->model('M_kategori');
	}
	function index(){
	if($this->session->userdata('akses')=='1'){
		$data['data']=$this->M_kategori->tampil_kategori();
		$this->load->view('admin/v_kategori',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function tambah_kategori(){
	if($this->session->userdata('akses')=='1'){
		$kat=$this->input->post('kategori');
		$this->M_kategori->simpan_kategori($kat);
		redirect('admin/Kategori');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function edit_kategori(){
	if($this->session->userdata('akses')=='1'){
		$kode=$this->input->post('kode');
		$kat=$this->input->post('kategori');
		$this->M_kategori->update_kategori($kode,$kat);
		redirect('admin/Kategori');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function hapus_kategori(){
	if($this->session->userdata('akses')=='1'){
		$kode=$this->input->post('kode');
		$this->M_kategori->hapus_kategori($kode);
		redirect('admin/Kategori');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
}