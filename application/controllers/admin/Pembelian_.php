<?php
class Pembelian extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
			// $url=base_url();
			$url = 'Administrator';
            redirect($url);
        };
		// $this->load->model('M_kategori');
		$this->load->model('M_barang');
		$this->load->model('M_suplier');
		$this->load->model('M_pembelian');
		$this->load->library('Cart_buying');
	}

	function index(){
		if($this->session->userdata('akses')=='1'){
			$x['sup']=$this->M_suplier->tampil_suplier();
			$this->load->view('admin/v_pembelian',$x);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function get_autocomplete(){		
        if (isset($_GET['term'])) {
			$result = $this->M_barang->search_barang($_GET['term']);			
			// print_r($result);die();
			// $final = $result->row_array();
			// print_r($final);die();
            if (count($result) > 0) {
			foreach ($result as $row)								
				$arr_result[] = $row->barang_nama;				
				// $arr_result[] = $row->barang_id;	
                echo json_encode($arr_result);
            }
        }
	}

	function get_barang(){
		if($this->session->userdata('akses')=='1'){
			$kobar=$this->input->post('kode_brg');
			$x['brg']=$this->M_barang->get_barang_dynamic($kobar);
			$this->load->view('admin/v_detail_barang_beli',$x);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function add_to_cart(){
		// print_r($this->cart);die();
		// echo "12";		
		if($this->session->userdata('akses')=='1'){	
			// echo "1";		
			$nofak=$this->input->post('nofak');
			$tgl=$this->input->post('tgl');
			$suplier=$this->input->post('suplier');
			$harpok = $this->input->post('harpok');
			$harjul = $this->input->post('harjul');
			$harjul_grosir = $this->input->post('harjul_grosir');
			$harjul_grosir_umum = $this->input->post('harjul_grosir_umum');		
			$jumlah = $this->input->post('jumlah');
			$this->session->set_userdata('nofak',$nofak);
			$this->session->set_userdata('tglfak',$tgl);
			$this->session->set_userdata('suplier',$suplier);
			$kobar=$this->input->post('kode_brg');
			$produk=$this->M_barang->get_barang_dynamic($kobar);
			$i=$produk->row_array();		
			$data = array(
				'id'       => $i['barang_id'],
				'name'     => $i['barang_nama'],
				'satuan'   => $i['barang_satuan'],
				'price'    => str_replace(",", "", $harpok),
				'harga'    => str_replace(",", "", $harjul),
				'harjul_grosir'    => str_replace(",", "", $harjul_grosir),
				'harjul_grosir_umum'    => str_replace(",", "", $harjul_grosir_umum),
				'qty'      => str_replace(",", "", $jumlah),
				);
			// if (($harpok == 0) || ($harjul == 0) || ($jumlah == 0)){	
			// 	// echo "ssss";			
			// 	echo '<script language="javascript" type="text/javascript"> 
			// 	alert("Tidak boleh mengandung value 0");   
			// 	window.location = "'.base_url().'admin/Pembelian";             
			// 	</script>';				
			// 	die();
				
			// }

			if (($harjul == 0) || ($jumlah == 0)){	
				// echo "ssss";			
				echo '<script language="javascript" type="text/javascript"> 
				alert("Tidak boleh mengandung value 0");   
				window.location = "'.base_url().'admin/Pembelian";             
				</script>';				
				die();
				
			}

			// print_r($data);die();

			if(!empty($this->cart_buying->total_items())){						
				$count = 0;				
				foreach($this->cart_buying->contents()as $items){					
					$id = $items['id'];										
					$qtyLama=$items['qty'];							
					$rowId=$items['rowid'];
					$kobar=$this->input->post('kode_brg');
					$qty=str_replace(",", "", $this->input->post('jumlah'));					
					if($id==$data['id']){						
						$count++;					
						$up=array(
							'rowid'=>$rowId,
							'qty'=>$qtyLama+$qty
						);						
						$this->cart_buying->update($up);
					}
				}
				if($count==0){
					// echo "masuk sini";
					// echo "1";
					$this->cart_buying->insert($data);
				}
			}else{				
				$this->cart_buying->insert($data);
				// echo "init2";die();				
			}		
			// print_r($this->cart);
			redirect('admin/Pembelian');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function remove(){
		if($this->session->userdata('akses')=='1'){
			$row_id=$this->uri->segment(4);
			$this->cart_buying->update(array(
				'rowid'      => $row_id,
				'qty'     => 0
				));
			redirect('admin/Pembelian');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function simpan_pembelian(){
		if($this->session->userdata('akses')=='1'){
			$nofak=$this->session->userdata('nofak');
			$tglfak=$this->session->userdata('tglfak');
			$suplier=$this->session->userdata('suplier');
			// $nofak = 'v901';
			// $tglfak = date("Y-m-d H:i:s");
			// $suplier='1';
			// echo $tglfak.$suplier;die();
			if(!empty($nofak) && !empty($tglfak) && !empty($suplier)){
				$beli_kode=$this->M_pembelian->get_kobel($tglfak);
				$order_proses=$this->M_pembelian->simpan_pembelian($nofak,$tglfak,$suplier,$beli_kode);
				if($order_proses){
					$this->cart_buying->destroy();
					$this->session->unset_userdata('nofak');
					$this->session->unset_userdata('tglfak');
					$this->session->unset_userdata('suplier');
					echo $this->session->set_flashdata('msg','<label class="label label-success">Pembelian Berhasil di Simpan ke Database</label>');
					redirect('admin/Pembelian');	
				}else{
					redirect('admin/Pembelian');
				}
			}else{
				echo $this->session->set_flashdata('msg','<label class="label label-danger">Pembelian Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
				redirect('admin/Pembelian');
			}
		}else{
			echo "Halaman tidak ditemukan";
		}	
	}
}