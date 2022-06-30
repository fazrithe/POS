<?php
class M_barang extends CI_Model{

	function hapus_barang($kode){
		$hsl=$this->db->query("DELETE FROM tbl_barang where barang_id='$kode'");
		return $hsl;
	}

	function update_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$stok,$min_stok,$diskon_1,$diskon_2,$diskon_3,$harjul_grosir,$harjul_grosir_umum){
		$user_id=$this->session->userdata('idadmin');
		$hsl=$this->db->query("UPDATE tbl_barang SET barang_nama='$nabar',barang_satuan='$satuan',barang_harpok='$harpok',barang_harjul='$harjul',barang_stok='$stok',barang_min_stok='$min_stok',barang_tgl_last_update=NOW(),barang_kategori_id='$kat',barang_user_id='$user_id', diskon_1='$diskon_1', diskon_2='$diskon_2', diskon_3='$diskon_3', barang_harjul_grosir='$harjul_grosir', barang_harjul_grosir_umum='$harjul_grosir_umum' WHERE barang_id='$kobar'");
		return $hsl;
	}

	function tampil_barang(){
		$hsl=$this->db->query("SELECT barang_id,barang_nama,barang_satuan,barang_harpok,barang_harjul,barang_harjul_grosir,barang_harjul_grosir_umum,barang_stok,barang_min_stok,barang_kategori_id,kategori_nama,diskon_1,diskon_2,diskon_3 FROM tbl_barang JOIN tbl_kategori ON barang_kategori_id=kategori_id");
		return $hsl;
	}

	function simpan_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$stok,$min_stok,$diskon_1,$diskon_2,$diskon_3,$harjul_grosir,$harjul_grosir_umum){
		$user_id=$this->session->userdata('idadmin');
		$hsl=$this->db->query("INSERT INTO tbl_barang (barang_id,barang_nama,barang_satuan,barang_harpok,barang_harjul,barang_stok,barang_min_stok,barang_kategori_id,barang_user_id,diskon_1,diskon_2,diskon_3,barang_harjul_grosir,barang_harjul_grosir_umum) VALUES ('$kobar','$nabar','$satuan','$harpok','$harjul','$stok','$min_stok','$kat','$user_id','$diskon_1','$diskon_2','$diskon_3','$harjul_grosir',
		'$harjul_grosir_umum')");
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
	
	function get_barang_dynamic1($param,$tipe){
		$hsl=$this->db->query("SELECT barang_id,barang_nama,barang_satuan,barang_harpok,barang_harjul,barang_harjul_grosir,barang_harjul_grosir_umum,barang_stok,barang_min_stok,barang_tgl_input,barang_tgl_last_update,barang_kategori_id,barang_user_id,diskon_1,diskon_2,diskon_3, '$tipe' as tipe_harjul FROM tbl_barang where barang_id like'%$param%' OR barang_nama like '%$param%'");
        // print_r($hsl);die();
		return $hsl;
	}

	function search_barang($param){
		$this->db->like('barang_nama', $param);
		$this->db->or_like('barang_id', $param);
        $this->db->order_by('barang_nama', 'ASC');
        $this->db->limit(10);
        return $this->db->get('tbl_barang')->result();
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

	function stok_minimum(){
		$query = $this->db->query("SELECT * FROM tbl_barang where barang_stok < barang_min_stok");
		return $query->result();
	}

	function notif_stok_min(){
		$query = $this->db->query("SELECT * FROM tbl_barang where barang_stok < barang_min_stok limit 5");
		return $query->result();
	}

}