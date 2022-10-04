<?php
class M_penjualan extends CI_Model{

	function tampil_faktur(){
		$hsl = $this->db->query("SELECT tj.jual_nofak from tbl_jual tj");
		return $hsl;
	}

	function get_detail($nofak=""){				
		$query=$this->db->query("SELECT * from tbl_detail_jual tdj where d_jual_nofak = '$nofak'");		
		return $query->result();
	}
	
	function get_barang_jual($kode){
		$hsl=$this->db->query("SELECT DISTINCT(d_jual_barang_id) FROM tbl_detail_jual WHERE d_jual_barang_id='$kode'");
		return $hsl;
	}

	function hapus_retur($kode){
		$hsl=$this->db->query("DELETE FROM tbl_retur WHERE retur_id='$kode'");
		return $hsl;
	}

	function tampil_retur(){
		$hsl=$this->db->query("SELECT retur_id,DATE_FORMAT(retur_tanggal,'%d/%m/%Y') AS retur_tanggal,retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,(retur_harjul*retur_qty) AS retur_subtotal,retur_keterangan FROM tbl_retur ORDER BY retur_id DESC");
		return $hsl;
	}

	function simpan_retur($kobar,$nabar,$satuan,$harjul,$qty,$keterangan){
		$hsl=$this->db->query("INSERT INTO tbl_retur(retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,retur_keterangan) VALUES ('$kobar','$nabar','$satuan','$harjul','$qty','$keterangan')");
		return $hsl;
	}

	// function simpan_penjualan($nofak,$total,$jml_uang,$jual_belanja,$kembalian,$cashback,$aki_bekas){
	// 	$idadmin=$this->session->userdata('idadmin');
	// 	$this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan,jual_cashback,jual_belanja,jual_aki_bekas,jual_tipe) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','eceran','$cashback','$jual_belanja','$aki_bekas')");
	// 	foreach ($this->cart->contents() as $item) {
	// 		$data=array(
	// 			'd_jual_nofak' 			=>	$nofak,
	// 			'd_jual_barang_id'		=>	$item['id'],
	// 			'd_jual_barang_nama'	=>	$item['name'],
	// 			'd_jual_barang_satuan'	=>	$item['satuan'],
	// 			'd_jual_barang_harpok'	=>	$item['harpok'],
	// 			'd_jual_barang_harjul'	=>	$item['amount'],
	// 			'd_jual_qty'			=>	$item['qty'],
	// 			'd_jual_diskon'			=>	$item['disc'],				
	// 			'd_jual_total'			=>	$item['subtotal'],
	// 			'd_jual_disc_val'   	=>  $item['discVal'],
	// 			'd_status_return'       =>  0				
	// 		);
	// 		$this->db->insert('tbl_detail_jual',$data);
	// 		$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
	// 	}
	// 	return true;
	// }

	function simpan_penjualan($param){		
		$idadmin  	  = $this->session->userdata('idadmin');
		$tipe         = $param[0];
		$nofak    	  = $param[1];
		$total    	  = $param[2];
		$jml_uang 	  = $param[3];
		$jual_belanja = $param[4];
		$kembalian 	  = $param[5];
		$cashback  	  = $param[6];
		$aki_bekas 	  = $param[7];
		$customer     = $param[8];
		$alamat       = $param[9];
		$jual_status  = $param[10];	
		$jual_garansi = $param[11];
		$tipe_pembayaran = $param[12];
		$this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan,jual_cashback,jual_belanja,jual_aki_bekas,jual_tipe,jual_customer,jual_alamat,jual_status_bayar,jual_garansi,jual_tipe_pembayaran) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','eceran','$cashback','$jual_belanja','$aki_bekas','$tipe','$customer','$alamat','$jual_status','$jual_garansi','$tipe_pembayaran')");
		foreach ($this->cart->contents() as $item) {
			$data=array(
				'd_jual_nofak' 			=>	$nofak,
				'd_jual_barang_id'		=>	$item['id'],
				'd_jual_barang_nama'	=>	$item['name'],
				'd_jual_barang_satuan'	=>	$item['satuan'],
				'd_jual_barang_harpok'	=>	$item['harpok'],
				'd_jual_barang_harjul'	=>	$item['amount'],
				'd_jual_qty'			=>	$item['qty'],
				'd_jual_diskon'			=>	$item['disc'],				
				'd_jual_total'			=>	$item['subtotal'],
				'd_jual_disc_val'   	=>  $item['discVal'],
				'd_status_return'       =>  0				
			);
			$this->db->insert('tbl_detail_jual',$data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
		}
		return true;
	}

	
	function get_nofak(){
		$q = $this->db->query("SELECT MAX(RIGHT(jual_nofak,6)) AS kd_max FROM tbl_jual WHERE DATE(jual_tanggal)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
		date_default_timezone_set('UTC');
		// print_r(date('dmy'));
        return date('dmy').$kd;
	}

	//=====================Penjualan grosir================================
	function simpan_penjualan_grosir($nofak,$total,$jml_uang,$kembalian){
		$idadmin=$this->session->userdata('idadmin');
		$this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','grosir')");
		foreach ($this->cart->contents() as $item) {
			$data=array(
				'd_jual_nofak' 			=>	$nofak,
				'd_jual_barang_id'		=>	$item['id'],
				'd_jual_barang_nama'	=>	$item['name'],
				'd_jual_barang_satuan'	=>	$item['satuan'],
				'd_jual_barang_harpok'	=>	$item['harpok'],
				'd_jual_barang_harjul'	=>	$item['amount'],
				'd_jual_qty'			=>	$item['qty'],
				'd_jual_diskon'			=>	$item['disc'],
				'd_jual_total'			=>	$item['subtotal']
			);
			$this->db->insert('tbl_detail_jual',$data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
		}
		return true;
	}

	function cetak_faktur(){
		$nofak=$this->session->userdata('nofak');
		// echo $nofak;
		//$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d/%m/%Y %H:%i:%s') AS jual_tanggal,jual_cashback,jual_belanja,jual_total,jual_jml_uang,jual_kembalian,jual_keterangan,jual_alamat,jual_customer,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,d_jual_disc_val,jual_aki_bekas,jual_garansi FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE jual_nofak='$nofak'");
		
		$hsl=$this->db->query("SELECT jual_tipe_pembayaran,jual_nofak,DATE_FORMAT(jual_tanggal,'%d/%m/%Y %H:%i:%s') AS jual_tanggal,jual_belanja,jual_total,jual_jml_uang,jual_kembalian,jual_keterangan,jual_alamat,jual_customer,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harjul,d_jual_qty,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE jual_nofak='$nofak'");
		
		// print_r( $hsl);
		return $hsl;
	}

	function sum_qty(){
		$nofak=$this->session->userdata('nofak');
		$hsl = $this->db->query("SELECT sum(d_jual_qty) as sumQty from tbl_detail_jual where d_jual_nofak ='$nofak'");		
		return $hsl;
	}
	
}