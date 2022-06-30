<?php
class Barang extends CI_Controller{
	function __construct(){
		parent::__construct();		
		if($this->session->userdata('masuk') !=TRUE){			
			// $url=base_url();
			$url = 'Administrator';
            redirect($url);
        };
		$this->load->model('M_kategori');
		$this->load->model('M_barang');
		$this->load->model('M_penjualan');
		// $this->load->library('Barcode');
		$this->load->model('M_authorized');
	}
	function index(){
		// echo base_url();die();
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->M_barang->tampil_barang();
			$data['kat']=$this->M_kategori->tampil_kategori();
			$data['kat2']=$this->M_kategori->tampil_kategori();

			$this->load->view('admin/v_barang',$data);
		}else{
    	    echo "Halaman tidak ditemukan";
    	}
	}
	function tambah_barang(){
	if($this->session->userdata('akses')=='1'){
		$kobar=$this->M_barang->get_kobar();
		$nabar=$this->input->post('nabar');
		$kat=$this->input->post('kategori');
		$satuan=$this->input->post('satuan');
		$harpok=str_replace(',', '', $this->input->post('harpok'));
		$harjul=str_replace(',', '', $this->input->post('harjul'));		
		$harjul_grosir=str_replace(',', '', $this->input->post('harjul_grosir'));
		$harjul_grosir_umum=str_replace(',', '', $this->input->post('harjul_grosir_umum'));
		$diskon_1=str_replace(',', '', $this->input->post('diskon_1'));
		$diskon_2=str_replace(',', '', $this->input->post('diskon_2'));
		$diskon_3=str_replace(',', '', $this->input->post('diskon_3'));
		$stok=$this->input->post('stok');
		$min_stok=$this->input->post('min_stok');
		if ($diskon_1 == ""){
			$diskon_1 = 0;
		};
		if ($diskon_2 == ""){
			$diskon_2 = 0;
		};
		if ($diskon_3 == ""){
			$diskon_3 = 0;
		};
		if ($harjul == ""){
			$harjul = 0;
		}
		if ($harjul_grosir == ""){
			$harjul_grosir = 0;
		}
		if ($harjul_grosir_umum == ""){
			$harjul_grosir_umum = 0;
		}

		$this->M_barang->simpan_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$stok,$min_stok,$diskon_1,$diskon_2,$diskon_3,$harjul_grosir,$harjul_grosir_umum);
		echo $this->session->set_flashdata('msg','<label class="label label-success">Data barang Berhasil ditambahkan</label>');			
		redirect('admin/Barang');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function edit_barang(){
		if($this->session->userdata('akses')=='1'){
			// $fetched_records=$this->M_authorized->get_oldpassw()->result_array();
			// $oldpassw = "";
			
    	    // foreach($fetched_records as $a){
    	    //     $oldpassw = $a['password'];
			// }			
			// $passw = $this->input->post('passw');
			// // echo $oldpassw."--".$passw;die();
			// if ($passw != $oldpassw){				
			// 	echo "Your password is wrong, the data failed to update!!";
			// 	$barang_url = base_url()."admin/Barang";
			// 	echo "<script>setTimeout(\"location.href ='$barang_url';\",1500);</script>";				
			// }else{
				$kobar=$this->input->post('kobar');
				$nabar=$this->input->post('nabar');
				$kat=$this->input->post('kategori');
				$satuan=$this->input->post('satuan');				
				$harpok=str_replace(',', '', $this->input->post('harpok'));
				$harjul=str_replace(',', '', $this->input->post('harjul'));
				$harjul_grosir=str_replace(',', '', $this->input->post('harjul_grosir'));
				$harjul_grosir_umum=str_replace(',', '', $this->input->post('harjul_grosir_umum'));
				$diskon_1=str_replace(',', '', $this->input->post('diskon_1'));
				$diskon_2=str_replace(',', '', $this->input->post('diskon_2'));
				$diskon_3=str_replace(',', '', $this->input->post('diskon_3'));
				if ($diskon_1 == ""){
					$diskon_1 = 0;
				};
				if ($diskon_2 == ""){
					$diskon_2 = 0;
				};
				if ($diskon_3 == ""){
					$diskon_3 = 0;
				};
				if ($harjul == ""){
					$harjul = 0;
				};
				if ($harjul_grosir == ""){
					$harjul_grosir = 0;
				};
				if ($harjul_grosir_umum == ""){
					$harjul_grosir_umum = 0;
				};
				$stok=$this->input->post('stok');
				$min_stok=$this->input->post('min_stok');
				$this->M_barang->update_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$stok,$min_stok,$diskon_1,$diskon_2,$diskon_3,$harjul_grosir,$harjul_grosir_umum);
				echo "Success update data!";
				$barang_url = base_url()."admin/Barang";
				echo "<script>setTimeout(\"location.href ='$barang_url';\",1500);</script>";				
			// }		
		}else{
    	    echo "Halaman tidak ditemukan";
    	}
	}
	function hapus_barang(){
		if($this->session->userdata('akses')=='1'){
			$kode=$this->input->post('kobar');	
			$result['rows'] = $this->M_penjualan->get_barang_jual($kode);			
							
			if($result['rows']->num_rows() > 0){
				// echo "masuk sini 1";
				$data['status'] = 0;
				$data['message'] = "Data tidak bisa dihapus, data sudah digunakan di modul penjualan";
				echo json_encode($data);			
				return;
			}else{					
				// print_r($this->M_barang->hapus_barang($kode));die();	
				if ($this->M_barang->hapus_barang($kode) == 1){
					$data['status'] = 1;
					$data['message'] = "Data sudah dihapus";								
				}else{
					$data['status'] = 2;
					$data['message'] = "Data gagal dihapus";				
				}			
				echo json_encode($data);			
				return;
			}
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
}