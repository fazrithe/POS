<?php
class M_sales extends CI_Model{
	function get_sales($param=""){
		$hsl=$this->db->query("select b.sales_id,a.karyawan_id,a.karyawan_nama,b.sales_status,a.karyawan_status
		from tbl_karyawan a
		join tbl_sales_master b
		on a.karyawan_id = b.karyawan_id
		where b.sales_status !=0 and a.karyawan_status != 0 and a.karyawan_nama like '%$param%'");
		return $hsl;
	}

	function get_sales_(){
		$hsl=$this->db->query("SELECT c.sales_id,b.karyawan_id,b.karyawan_nama,a.sales_area,a.sales_buyer,c.sales_status,b.karyawan_status
        FROM tbl_sales_detail a
        JOIN tbl_sales_master c ON a.sales_id = c.sales_id
        JOIN tbl_karyawan b ON c.karyawan_id = b.karyawan_id
        WHERE c.sales_status = 1 AND karyawan_status = 1;");
		return $hsl;
	}

	function validasi_sales($sales_id){
		$hsl=$this->db->query("SELECT count(sales_id) as count_sales from tbl_sales_master where sales_id='$sales_id'");
		$result = $hsl->result_array();
		foreach($result as $a){
			return $a['count_sales'];
		}				 
	}

	function countById($karyawan_id){
		$hsl=$this->db->query("SELECT count(karyawan_id) as count_sales from tbl_sales_master where karyawan_id='$karyawan_id'");
		$result = $hsl->result_array();
		foreach($result as $a){
			return $a['count_sales'];
		}				 
	}

	function get_status($karyawan_id){
		$hsl=$this->db->query("SELECT sales_status from tbl_sales_master where karyawan_id='$karyawan_id'");
		$result = $hsl->result_array();
		foreach($result as $a){
			return $a['sales_status'];
		}				 
	}

	function insert_sales($karyawan_id){
		$hsl=$this->db->query("INSERT INTO tbl_sales_master(karyawan_id,sales_status) VALUES ('$karyawan_id',1)");
		return $hsl;
	}

	function simpan_sales_master($sales_id,$karyawan_id,$sales_isActive){
		$hsl=$this->db->query("INSERT INTO tbl_sales_master(sales_id,karyawan_id,sales_status) VALUES ('$sales_id','$karyawan_id','$sales_isActive')");
		return $hsl;
	}

	function simpan_sales_detail($sales_id,$sales_area,$sales_konsumen){
		$hsl=$this->db->query("INSERT INTO tbl_sales_detail(sales_id,sales_area,sales_buyer) VALUES ('$sales_id','$sales_area','$sales_konsumen')");
		return $hsl;
	}
    
	function simpan_karyawan($param){
        $karyawan_nama         = $param[0];
        $karyawan_tmpLahir     = $param[1];
        $karyawan_tglLahir     = $param[2];
        $karyawan_jenisKelamin = $param[3];            
        $karyawan_domisili     = $param[4];            
        $karyawan_status       = $param[5];            
        $karyawan_isActive     = $param[6];
        
        $hsl=$this->db->query("INSERT INTO tbl_karyawan(karyawan_nama,karyawan_tempatlahir,karyawan_tgllahir,karyawan_domisili,karyawan_marrital,karyawan_status,karyawan_gender) VALUES ('$karyawan_nama','$karyawan_tmpLahir','$karyawan_tglLahir','$karyawan_domisili','$karyawan_status','$karyawan_isActive','$karyawan_jenisKelamin')");
		return $hsl;
	}

	function update_sales_mst($karyawan_id){
		$hsl=$this->db->query("UPDATE tbl_sales_master SET sales_status=1 where karyawan_id='$karyawan_id'");
		return $hsl;
	}

	function update_sales_master($karyawan_id,$sales_id,$sales_isactive){
		$hsl=$this->db->query("UPDATE tbl_sales_master SET karyawan_id = '$karyawan_id',sales_status='$sales_isactive' where sales_id='$sales_id'");
		return $hsl;
	}

	function update_sales_detail($sales_mapping_id,$sales_area,$sales_buyer){
		$hsl=$this->db->query("UPDATE tbl_sales_detail SET sales_area='$sales_area', sales_buyer='$sales_buyer' WHERE sales_mapping_id='$sales_mapping_id'");
		return $hsl;
	}

	function update_pengguna_nopass($kode,$nama,$username,$level){
		$hsl=$this->db->query("UPDATE tbl_karyawan SET user_nama='$nama',user_username='$username',user_level='$level' WHERE user_id='$kode'");
		return $hsl;
	}
	function update_pengguna($kode,$nama,$username,$password,$level){
		$hsl=$this->db->query("UPDATE tbl_karyawan SET user_nama='$nama',user_username='$username',user_password=md5('$password'),user_level='$level' WHERE user_id='$kode'");
		return $hsl;
	}
	function update_status($karyawan_id){
		$hsl=$this->db->query("UPDATE tbl_sales_master SET sales_status='0' WHERE karyawan_id='$karyawan_id'");
		return $hsl;
	}
}