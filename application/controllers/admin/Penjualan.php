<?php
class Penjualan extends CI_Controller{
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
		$this->load->model('M_penjualan');
		$this->load->model('M_customer');
		$this->load->library('Cart');
	}
	function index(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		//$data['data']=$this->M_barang->tampil_barang();
		//$this->load->view('admin/v_penjualan',$data);
		$customer['customer'] = $this->db->get('tbl_customer')->result();
		$this->load->view('admin/v_penjualan',$customer);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function get_barang(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$kobar=$this->input->post('kobar');
		$tipe  = $this->input->post('tipe'); 
		//echo $kobar;die();
		$x['brg']=$this->M_barang->get_barang_dynamic1($kobar,$tipe);
		//$x['brg']=$this->M_barang->get_barang_dynamic($kobar);
		$this->load->view('admin/v_detail_barang_jual',$x);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function add_to_cart(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){		

			// $pLimit = $this->input->post('hid_limit');
			// $pHutang = $this->input->post('hid_hutang');
			// echo $this->session->userdata('sess_cname')."<br>";
			// $sumHutang = 0;

			$kobar=$this->input->post('kode_brg');		
			$harjul=str_replace(',','',$this->input->post('harjul'));
			$qty = str_replace(',','',$this->input->post('qty'));
			// $disc = str_replace(',','',$this->input->post('diskon'));		
			$disc = 0;		
			// $tempHarga = ($harjul - ($disc/100 * $harjul)) * $qty;		 
			// $diskonVal = $disc*(str_replace(",", "", $harjul)*$qty)/100;
			$diskonVal = 0;

			// $arrContent = $this->cart->contents();
			// $sum = 0;
			// echo $sumHutang."<br>".$pLimit."<br>".$pHutang."<br>";

			// if (($pLimit != "")){				
			// 	$postLimit = str_replace(',','',$pLimit);
			// 	$postHutang = str_replace(',','',$pHutang);		
			// 	$sumHutang = $sum + $postHutang +$tempHarga;
			// 	echo $sumHutang;
			// }else{
			// 	$postLimit = 0;
			// 	$postHutang = 0;
			// }		
			// foreach($arrContent as $x){
			// 	$sum += $x['subtotal'];
			// 	// print("<pre>".print_r($sum += $x['subtotal'],true)."</pre>");
			// }			
			// echo "aa".$sumHutang;				
			// print("<pre>".print_r($sum."--".$postHutang."--".$postLimit,true)."</pre>");
			// if ($sumHutang > $postLimit && $postLimit != 0){				
			// 	echo $this->session->set_flashdata('msg','<label class="label label-danger">Limit tidak mencukupi </label>');
			// 	redirect('admin/Penjualan');
			// }else if($sumHutang <= $postLimit || $postLimit = 0 || $postLimit = ""){
				// die();
				$produk=$this->M_barang->get_barang_dynamic($kobar);
				$i=$produk->row_array();
				$data = array(
					'id'       => $i['barang_id'],
					'name'     => $i['barang_nama'],
					'satuan'   => $i['barang_satuan'],
					'harpok'   => $i['barang_harpok'],	
					// 'price'    => str_replace(",", "", $this->input->post('harjul'))-(($this->input->post('diskon')*str_replace(",", "", $this->input->post('harjul')))/100),
					'price'    => str_replace(",", "", $this->input->post('harjul'))-(($this->input->post('diskon')*str_replace(",", "", $this->input->post('harjul')))/100),
					// 'disc'     => str_replace(",", "", $this->input->post('diskon')),
					'disc'     => 0,
					// 'discVal'  => $diskonVal,
					'discVal'  => 0,
					'qty'      => str_replace(",", "", $this->input->post('qty')),
					'amount'	  => str_replace(",", "", $this->input->post('harjul'))
					);		
					// print_r($data);die();
					// $this->cart->contents();die();
				if(!empty($this->cart->total_items())){
					$count = 0;
																		
					foreach ($this->cart->contents() as $items){
						$id=$items['id'];
						$qtylama=$items['qty'];			
						$rowid=$items['rowid'];
						$kobar=$this->input->post('kode_brg');
						$qty=$this->input->post('qty');
						if($id==$data['id']){
							$count++;
							$up=array(
								'rowid'=> $rowid,
								'qty'=>$qtylama+$qty
								);					
							if($up['qty']<=$i['barang_stok']){
								$this->cart->update($up);
							}else{
								echo $this->session->set_flashdata('msg','<label class="label label-danger">Stok barang tidak mencukupi </label>');
								redirect('admin/Penjualan');
							}
						}
					}
					if ($count==0){		
						$this->cart->insert($data);
					}
				}else{
					$this->cart->insert($data);
				}
				redirect('admin/Penjualan');
			
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function remove(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$row_id=$this->uri->segment(4);
		$this->cart->update(array(
               'rowid'      => $row_id,
               'qty'     => 0
            ));
		redirect('admin/Penjualan');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function insertData($param){		
		// print_r($param);die();
		$order_proses=$this->M_penjualan->simpan_penjualan($param);	
		
		if ($param[0] == "H"){			
			$insert_credit = $this->M_customer->insert_credit();
		}		
				
		if(($order_proses) || ($insert_credit)){
			$this->cart->destroy();	
			// $this->session->unset_userdata('sess_cid');
			$this->session->unset_userdata('sess_cname');
			$this->session->unset_userdata('sess_climit');
			$this->session->unset_userdata('sess_chutang');
			$this->session->unset_userdata('sess_csisa');
			$this->session->unset_userdata('sess_calamat');
			$this->session->unset_userdata('newhutang');	
			$this->session->unset_userdata('sess_tipe');	
			$this->session->unset_userdata('sess_tipe_pembayaran');		
			$this->load->view('admin/alert/alert_sukses');	
		}else{
			redirect('admin/Penjualan');
		}
	}

	function simpan_penjualan(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){

			// echo count($this->cart->contents());die();

			if (count($this->cart->contents()) == 0){
				echo $this->session->set_flashdata('msg','<label class="label label-danger">Harap input data belanja anda</label>');
				redirect('admin/Penjualan');
			}else{
				$finLimit  = $this->input->post('fin_limit');
				$finHutang = $this->input->post('fin_hutang');				
				// $finSisa   = $this->input->post('fin_sisa');			
				$finAlamat = $this->input->post('fin_alamat'); 	
				// echo $finAlamat;die();					

				$customer  = $this->input->post('fin_customer');
				$new_customer  = $this->input->post('fin_new_customer');

				$tipe_pembayaran = $this->input->post('tipe_pembayaran');
				$this->session->set_userdata('sess_tipe_pembayaran', $tipe_pembayaran);
				// if($this->session->userdata('sess_cname')==""){
				// 	$customer = "ssNONAMEee";
				// }
				if($customer == 0){
					$post['customer_name']   	= $new_customer;
					$post['customer_limit']   	= 0;
					$post['customer_hutang']   	= 0;
					$post['customer_alamat']   	= $finAlamat;
					$post['customer_telepon']   = '-';
					$post['customer_flagging'] 	= 1;
					$post['insert_datetime']  	= date('Y-m-d H:i:s');
					$post['update_datetime']  	= date('Y-m-d H:i:s');
					$post['insert_user']       	= $this->session->userdata('nama');
					$post['update_user']       	= $this->session->userdata('nama');
					$this->db->insert('tbl_customer', $post);
					$insert_id_cust = $this->db->insert_id();
				}else{
					$insert_id_cust = $customer;
				}
				$this->session->set_userdata('sess_ccustid',$insert_id_cust);
				$param     = array();
				
				$total=$this->input->post('total');

				$cashback = $this->input->post('cashback2');				
				$aki_bekas = $this->input->post('aki_bekas2');
				$garansi   = $this->input->post('garansi');

				$jual_belanja = $this->input->post('total_bel2');

				$jml_uang=str_replace(",", "", $this->input->post('jml_uang'));
				
							
				$kembalian = $this->input->post('kembalian2');
				
				if ($kembalian==""){
					$kembalian = 0;
				}
				if ($cashback == "") {
					$cashback = 0;
				}
				if ($aki_bekas == ""){
					$aki_bekas = 0;
				}

				$jual_tipe = "C";
				$jual_status_bayar = '1';		

				if ($finLimit!="" || $finLimit!=0){
					$customer  = $this->input->post('fin_customer');
					$finLimit  = str_replace(",","",$this->input->post('fin_limit'));
					$finHutang = str_replace(",","",$this->input->post('fin_hutang'));
					$finSisa   = str_replace(",","",$this->input->post('fin_sisa'));	
					$finAlamat = $this->input->post('fin_alamat');		
					$tmpHutang = $finHutang + $jual_belanja;
					$jual_status_bayar = '0';
					$this->session->set_userdata('newhutang',$tmpHutang);							
					if ($tmpHutang <= $finLimit){		
						$jual_tipe = "H";
						$nofak=$this->M_penjualan->get_nofak();	
						$this->session->set_userdata('nofak',$nofak);							
						array_push($param,$jual_tipe,$nofak,$total,$jml_uang,$jual_belanja,$kembalian,$cashback,$aki_bekas,$insert_id_cust,$finAlamat,$jual_status_bayar,$garansi,$tipe_pembayaran);
						$this->insertData($param);
					}else{
						echo $this->session->set_flashdata('msg','<label class="label label-danger">Limit Customer tidak mencukupi</label>');
						redirect('admin/Penjualan');
					}
				}else{											
					if(!empty($total) && !empty($jml_uang)){			
						if($jml_uang < $jual_belanja){
							echo $this->session->set_flashdata('msg','<label class="label label-danger">Jumlah Uang yang anda masukan Kurang</label>');
							redirect('admin/Penjualan');
						}else{
							$jual_tipe = "C";
							$nofak=$this->M_penjualan->get_nofak();
							$this->session->set_userdata('nofak',$nofak);
							// echo $finAlamat;die();
							array_push($param,$jual_tipe,$nofak,$total,$jml_uang,$jual_belanja,$kembalian,$cashback,$aki_bekas,$insert_id_cust,$finAlamat,$jual_status_bayar,$garansi,$tipe_pembayaran);
							// print_r($param);die();
							$this->insertData($param);
						}
					}else{
						echo $this->session->set_flashdata('msg','<label class="label label-danger">Penjualan Gagal di Simpan, Mohon xPeriksa Kembali Semua Inputan Anda!</label>');
						redirect('admin/Penjualan');
					}				
				}
			}
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function cetak_faktur(){
		$cust_id = $this->session->userdata('temp_id');
		$x['data']=$this->M_penjualan->cetak_faktur();
		$x['sum_qty'] = $this->M_penjualan->sum_qty();
		$x['cust_info'] = $this->M_customer->get_direct_id($cust_id);		
		// print_r($x['cust_info']);die();
		// echo $
		// $x['get']
		// print_r($x);die();		
		// print_r ($x['data']); die();
		$this->load->view('admin/laporan/v_faktur',$x);
		$this->session->unset_userdata('nofak');
		$this->session->unset_userdata('temp_id');
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

	function get_autocust(){
		if (isset($_GET['term'])) {			
			$result = $this->M_customer->search_customer($_GET['term'])->result_array();						
            if (count($result) > 0) {
			foreach ($result as $row)								
				$arr_result[] = $row['customer_name'];	
				// $string = 'usernameTest';
				// echo preg_replace("/(?!^).(?!$)/", "*", $string); 				
                echo json_encode($arr_result);
            }
        }
	}

	function get_autocust_(){
		if (isset($_GET['term'])) {			
			$result = $this->M_customer->search_customer($_GET['term'])->result_array();						
            if (count($result) > 0) {
			foreach ($result as $row)								
				$arr_result[] = $row['customer_name'].'-'.$row['customer_id'];	
				// $string = 'usernameTest';
				// echo preg_replace("/(?!^).(?!$)/", "*", $string); 				
                echo json_encode($arr_result);
            }
        }
	}

	function get_customer(){        
		// $custid = $this->input->post('custid');  				    
        // $y = $this->M_customer->get_custname_id($custid);         
		// $a = $y->row_array();
		$this->session->unset_userdata('sess_cid');
		$this->session->unset_userdata('sess_cname');
		$this->session->unset_userdata('sess_climit');
		$this->session->unset_userdata('sess_chutang');
		$this->session->unset_userdata('sess_csisa');
		$this->session->unset_userdata('sess_calamat');
		$this->session->unset_userdata('newhutang');

		// echo $this->session->userdata('sess_cname');		
		// print("<pre>".print_r($a,true)."</pre>");
		$this->cart->destroy();
        echo json_encode("sukses");
	}
	
	function set_tipe(){
		$tipe = $this->input->post('tipe_jual');
		$this->session->set_userdata('sess_tipe',$tipe);			
	}

	function get_cust_byname(){
		$cust_id = $this->input->post('cust_id');
		$arr = $this->M_customer->get_direct_name($cust_id);
		$result = $arr->row_array();							
		if (count($result) > 0){
			$sisa = $result['customer_limit'] - $result['customer_hutang'];

			$this->session->set_userdata('sess_cid',$result['customer_id']);
			$this->session->set_userdata('sess_cname',$result['customer_name']);
			$this->session->set_userdata('sess_climit',number_format($result['customer_limit']));
			$this->session->set_userdata('sess_chutang',number_format($result['customer_hutang']));
			$this->session->set_userdata('sess_csisa',number_format($sisa));
			$this->session->set_userdata('sess_calamat',$result['customer_alamat']);
		}else {			
			$this->session->set_userdata('sess_cid',"");
			$this->session->set_userdata('sess_cname',$cust_id);
			$this->session->set_userdata('sess_climit',"");
			$this->session->set_userdata('sess_chutang',"");
			$this->session->set_userdata('sess_csisa',"");
			$this->session->set_userdata('sess_calamat',"");
		}
		// print("<pre>".print_r($this->session->userdata('sess_cname'),true)."</pre>");
		echo json_encode($result);
	}
	
	function get_barang_(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$kobar=$this->input->post('kode_brg');
			// echo $kobar;die();
			$x['brg']=$this->M_barang->get_barang_dynamic($kobar);
			$this->load->view('admin/v_detail_barang_jual',$x);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function session_alamat(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$alamat=$this->input->post('alamat');
			$this->session->set_userdata('sess_calamat',$alamat);
			echo json_encode($alamat);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function get_data_customer()
    {
        $q = $this->input->get('q');
        echo json_encode($this->M_customer->get_customer_search($q));
    }

	function get_alamat_customer(){
		$id = $this->input->post('id');		
		$this->session->set_userdata('sess_ccustid',$id);
		if($id == 0){
			echo 0;
		}else{
		$result = $this->M_customer->get_alamat_customer($id);
		$this->session->set_userdata('sess_calamat',$result->customer_alamat);
		// $this->session->set_userdata('sess_cname',$result->customer_name);
		// $this->session->set_userdata('sess_ccustid',$id);
	
			echo $result->customer_alamat;
		}

	}

	function get_nama_customer(){
		$name = $this->input->post('name');		
		$this->session->set_userdata('sess_cname',$name);
		echo $name;
	}

}