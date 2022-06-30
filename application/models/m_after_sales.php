<?php
class M_after_sales extends CI_Model{

	function update_dtjual($d_change_with,$d_jual_id){
		if ($d_change_with == 2){
			$query = "UPDATE tbl_detail_jual SET d_status_return = -1 WHERE d_jual_id = '$d_jual_id'";		
		}else{            
			$query = "UPDATE tbl_detail_jual SET d_status_return = d_status_return + 1 WHERE d_jual_id = '$d_jual_id'";
		}		
		$this->db->query($query);
    }
    
    function insert_return($arrParam){                       
        $query = "INSERT INTO tbl_after_sales (jual_nofak,barang_id,harga_pokok,harga_jual,qty,stok_retur_good,stok_retur_broken,subtotal,reason,change_with,insert_user,update_user) VALUES"."("."'".$arrParam["d_jual_nofak"]."'".","."'".$arrParam["d_barang_id"]."'".","."'".$arrParam["d_harpok"]."'".","."'".$arrParam["d_harjul"]."'".","."'".$arrParam["d_qty_nominal"]."'".","."'".$arrParam["d_qty_good"]."'".","."'".$arrParam["d_qty_broke"]."'".","."'".$arrParam["d_subtotal"]."'".","."'".$arrParam["d_keterangan"]."'".","."'".$arrParam["d_change_with"]."'".","."'".$arrParam["d_insert_user"]."'".","."'".$arrParam["d_update_user"]."'".")";

        $this->db->query($query);
    }

    function update_stok($arrParam){
        //update stok barang and sum with good_qty
        print_r($arrParam);        
        $query = "UPDATE tbl_barang set barang_stok = barang_stok + ".$arrParam['d_qty_nominal']." where barang_id="."'".$arrParam['d_barang_id']."'";

        $this->db->query($query);
    }
}