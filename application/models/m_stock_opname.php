<?php
class M_stock_opname extends CI_Model{

	function get_item(){
		$hsl=$this->db->query("SELECT barang_stok from tbl_barang");
		$result = $hsl->result_array();
		return $result;
	}

	function list_barang(){
		$hsl=$this->db->query("SELECT barang_id,barang_nama,barang_satuan,barang_stok from tbl_barang");
		// $result = $hsl->result_array();
		return $hsl;
	}

	function validasi_bulan(){
		$hsl=$this->db->query("SELECT MONTH(max(insert_datetime)) as max_month,YEAR(max(insert_datetime)) as max_year from tbl_history_so");
		$result = $hsl->result_array();
		foreach($result as $a){
			return $a;
		}				 
	}

	function result_so(){
		$hsl=$this->db->query("SELECT ths.barang_id, ths.barang_nama, ths.barang_satuan, ths.barang_stok, ths.real_stok,
		ths.different_stok, ths.adjustment_stok,ths.final_stok, ths.insert_datetime, ths.insert_user 
		FROM tbl_history_so ths 
		WHERE year(insert_datetime) = year(sysdate())
		AND month(insert_datetime) = month(sysdate())");
		
		return $hsl;
	}

	function update_adjustment($barang_id,$adj_qty){		
		$this->db->trans_begin();
		$this->db->query("UPDATE tbl_history_so set adjustment_stok = '$adj_qty', final_stok = real_stok + $adj_qty where barang_id = '$barang_id' ORDER BY insert_datetime DESC LIMIT 1");
		$this->db->query("UPDATE tbl_barang a set a.barang_stok = (SELECT b.final_stok FROM tbl_history_so b WHERE b.barang_id = '$barang_id' ORDER BY b.insert_datetime DESC LIMIT 1) WHERE a.barang_id='$barang_id'");
		
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}		
	}

	function simpan_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$stok,$min_stok){
		$user_id=$this->session->userdata('idadmin');
		$hsl=$this->db->query("INSERT INTO tbl_barang (barang_id,barang_nama,barang_satuan,barang_harpok,barang_harjul,barang_stok,barang_min_stok,barang_kategori_id,barang_user_id) VALUES ('$kobar','$nabar','$satuan','$harpok','$harjul','$stok','$min_stok','$kat','$user_id')");
		return $hsl;
	}


	function get_barang($kobar){
		$hsl=$this->db->query("SELECT * FROM tbl_barang where barang_id='$kobar'");
		return $hsl;
	}

	function get_barang_dynamic($param){
		$hsl=$this->db->query("SELECT * FROM tbl_barang where barang_id like'%$param%' OR barang_nama like '%$param%'");
		return $hsl;
	}

	function get_kobar(){
		$q = $this->db->query("SELECT MAX(RIGHT(barang_id,6)) AS kd_max FROM tbl_barang");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        return "BR".$kd;
	}

}