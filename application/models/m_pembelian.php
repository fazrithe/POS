<?php
class M_pembelian extends CI_Model{

	function simpan_pembelian($nofak,$tglfak,$suplier,$beli_kode){
		$idadmin=$this->session->userdata('idadmin');
		$this->db->query("INSERT INTO tbl_beli (beli_nofak,beli_tanggal,beli_suplier_id,beli_user_id,beli_kode) VALUES ('$nofak','$tglfak','$suplier','$idadmin','$beli_kode')");
		foreach ($this->cart_buying->contents() as $item) {
			$data=array(
				'd_beli_nofak' 		=>	$nofak,
				'd_beli_barang_id'	=>	$item['id'],
				'd_beli_harga'		=>	$item['price'],
				'd_beli_jumlah'		=>	$item['qty'],
				'd_beli_total'		=>	$item['subtotal'],
				'd_beli_kode'		=>	$beli_kode
			);
			$this->db->insert('tbl_detail_beli',$data);
			// print_r("UPDATE tbl_barang SET barang_stok = barang_stok + ".$item['qty'].",barang_harpok=".$item['price'].",barang_harjul=".$item['harga']." WHERE barang_id="."'".$item['id']."'");die();
			$this->db->query("UPDATE tbl_barang SET barang_stok = barang_stok + ".$item['qty'].",barang_harpok=".$item['price'].",barang_harjul=".$item['harga']." WHERE barang_id="."'".$item['id']."'");
		}
		return true;
	}
	function get_kobel($tglfak){
		$q = $this->db->query("SELECT MAX(RIGHT(beli_kode,6)) AS kd_max FROM tbl_beli WHERE DATE(beli_tanggal)='$tglfak'");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
		}
		$dt = date('dmy',strtotime($tglfak));
        return "BL".date($dt).$kd;
	}
}