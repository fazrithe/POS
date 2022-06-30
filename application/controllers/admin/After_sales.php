<?php
class After_sales extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
			// $url=base_url();
			$url = 'Administrator';
            redirect($url);
        };
		$this->load->model('M_kategori');
		$this->load->model('M_barang');
		$this->load->model('M_suplier');
        $this->load->model('M_pembelian');
		$this->load->model('M_penjualan');
		$this->load->model('M_after_sales');
	}

	function index(){
		if($this->session->userdata('akses')=='1'){
            // $x['sup']=$this->M_suplier->tampil_suplier();
            $x['faktur']=$this->M_penjualan->tampil_faktur();
			$this->load->view('admin/v_after_sales',$x);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	
	function proses_retur(){
		if($this->session->userdata('akses') == '1'){			
			if ($this->input->post('d_status') != -1){
				$d_jual_id = $this->input->post('d_jual_id');
				$d_jual_nofak = $this->input->post('d_jual_nofak');
				$d_barang_id = $this->input->post('d_barang_id');				
				$d_qty_nominal = $this->input->post('d_qty_nominal');
				$d_qty_good = $this->input->post('d_qty_good');
				$d_qty_broke = $this->input->post('d_qty_broke');
				$d_keterangan = $this->input->post('d_keterangan');			
				$d_change_with = $this->input->post('d_change_with');
				$d_harjul = $this->input->post('d_harjul');
				$d_harpok = $this->input->post('d_harpok');				
				$d_insert_user = $this->session->userdata('nama');
				$d_subtotal = $d_qty_nominal;			

				if ($d_qty_nominal == ""){
					$d_qty_nominal = 0;
				};
				if ($d_qty_good == ""){
					$d_qty_good = 0;
				};
				if ($d_qty_broke == ""){
					$d_qty_broke = 0;
				};
				if ($d_harjul == ""){
					$d_harjul = 0;
				};
				if($d_harpok == ""){
					$d_harpok = 0;
				};

				
				if($d_change_with == 1){
					$d_subtotal = $d_qty_nominal * $d_harjul;				
				}

				$arrParam = array(
					// 'd_jual_id' => $d_jual_id,
					'd_jual_nofak' => $d_jual_nofak,
					'd_barang_id' => $d_barang_id,
					'd_harpok' => $d_harpok,
					'd_harjul' => $d_harjul,
					'd_qty_nominal' => $d_qty_nominal,
					'd_qty_good' => $d_qty_good,
					'd_qty_broke' => $d_qty_broke,
					'd_subtotal' => $d_subtotal,
					'd_keterangan' => $d_keterangan,
					'd_change_with' => $d_change_with,								
					'd_insert_user' => $d_insert_user,				
					'd_update_user' => $d_insert_user				
				);
				
				if($d_change_with == 2){					
					$this->M_after_sales->update_stok($arrParam); 
				}				

				$this->M_after_sales->update_dtjual($d_change_with,$d_jual_id);							
				$this->M_after_sales->insert_return($arrParam);										

				echo json_encode(array("status_code"=>200,"message"=>"Data inserted successfully!"));
			}else{
				echo json_encode(array("status_code"=>400,"message"=>"Invalid transaction caused already return by cash!"));
			}			
		}
	}
    
    function tampil_faktur(){
		$nofak = $this->input->post('noFak');	
		$data = $this->M_penjualan->get_detail($nofak);	 
		// print_r($data);die();
		$i=1;
		foreach($data as $row){					
			echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td>".$row->d_jual_nofak."</td>";
			echo "<td>".$row->d_jual_barang_id."</td>";
			echo "<td>".$row->d_jual_barang_nama."</td>";
			echo "<td>".$row->d_jual_barang_satuan."</td>";
			echo "<td>".$row->d_jual_barang_harpok."</td>";
			echo "<td>".$row->d_jual_barang_harjul."</td>";
			echo "<td>".$row->d_jual_qty."</td>";
			echo "<td>".$row->d_jual_diskon."</td>";			
			echo "<td>".$row->d_jual_total."</td>";
				echo "<td align='center'><button type='button' style=''class='btn btn-success btn-sm update' data-toggle='modal' data-keyboard='false' data-backdrop='static' data-target='#insert_retur'
				data-d_jual_id=".$row->d_jual_id."
				data-d_jual_nofak=".$row->d_jual_nofak."
				data-d_jual_barang_id=".$row->d_jual_barang_id."
				data-d_jual_barang_nama=".str_replace(' ','_',$row->d_jual_barang_nama)."
				data-d_jual_barang_satuan=".$row->d_jual_barang_satuan."
				data-d_jual_barang_harpok=".$row->d_jual_barang_harpok."
				data-d_jual_barang_harjul=".$row->d_jual_barang_harjul."
				data-d_jual_qty=".$row->d_jual_qty."
				data-d_jual_diskon=".$row->d_jual_diskon."				
				data-d_jual_total=".$row->d_jual_total."
				data-d_jual_status=".$row->d_status_return."
				>Edit</button></td>";
			echo "</tr>";
			$i++;
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
		if($this->session->userdata('akses')=='1'){			
			$nofak=$this->input->post('nofak');
			$tgl=$this->input->post('tgl');
			$suplier=$this->input->post('suplier');
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
				'price'    => $this->input->post('harpok'),
				'harga'    => $this->input->post('harjul'),
				'qty'      => $this->input->post('jumlah')
				);
				// print_r($data);die();
			// print_r($this->cart->contents());die();
			if(!empty($this->cart->total_items())){				
				$count = 0;				
				foreach($this->cart->contents()as $items){					
					$id = $items['id'];										
					$qtyLama=$items['qty'];
					$rowId=$items['rowid'];
					$kobar=$this->input->post('kode_brg');
					$qty=$this->input->post('jumlah');
					if($id==$data['id']){						
						$count++;					
						$up=array(
							'rowid'=>$rowId,
							'qty'=>$qtyLama+$qty
						);						
						$this->cart->update($up);
					}
				}
				if($count==0){
					$this->cart->insert($data);
				}
			}else{
				$this->cart->insert($data);
			}		
			redirect('admin/Pembelian');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function remove(){
		if($this->session->userdata('akses')=='1'){
			$row_id=$this->uri->segment(4);
			$this->cart->update(array(
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
			if(!empty($nofak) && !empty($tglfak) && !empty($suplier)){
				$beli_kode=$this->M_pembelian->get_kobel();
				$order_proses=$this->M_pembelian->simpan_pembelian($nofak,$tglfak,$suplier,$beli_kode);
				if($order_proses){
					$this->cart->destroy();
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