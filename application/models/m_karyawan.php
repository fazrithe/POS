<?php
class M_karyawan extends CI_Model{
	function get_karyawan($param=""){
		$hsl=$this->db->query("SELECT * FROM tbl_karyawan WHERE karyawan_status = 1 and karyawan_nama like'%$param%'");
		return $hsl;
	}

	function get_sales($param=""){
		$fetched_records=$this->db->query("SELECT * FROM tbl_karyawan WHERE karyawan_status = 1 and karyawan_nama like'%$param%'");
		$sales = $fetched_records->result_array();		
		
		 // Initialize Array with fetched data
		 $data = array();
		 foreach($sales as $arrSales){
			$data[] = array("id"=>$arrSales['karyawan_id'], "text"=>$arrSales['karyawan_nama']);
		 }
		 return $data;
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

	function update_karyawan($karyawan_id,$karyawan_nama,$karyawan_tmpLahir,$karyawan_tglLahir,$karyawan_jKelamin,$karyawan_domisili,$karyawan_status,$karyawan_isActive){
		$hsl=$this->db->query("UPDATE tbl_karyawan SET karyawan_nama='$karyawan_nama', karyawan_tgllahir='$karyawan_tglLahir', karyawan_tempatlahir='$karyawan_tmpLahir',karyawan_gender='$karyawan_jKelamin',karyawan_domisili='$karyawan_domisili',karyawan_marrital='$karyawan_status',karyawan_status='$karyawan_isActive' WHERE karyawan_id='$karyawan_id'");
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
		$hsl=$this->db->query("UPDATE tbl_karyawan SET karyawan_status='0' WHERE karyawan_id='$karyawan_id'");
		return $hsl;
	}
}