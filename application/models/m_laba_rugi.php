<?php
class M_laba_rugi extends CI_Model{

	function get_data_jual($param=""){   
        
        if ($param < 13){
            $tahun = date("Y");
            $hsl=$this->db->query("select sum(jual_total)as total_jual from tbl_jual where year(jual_tanggal) = ".$tahun." and month(jual_tanggal) = ".$param."");
        }else{
            $hsl=$this->db->query("select sum(jual_total)as total_jual from tbl_jual where year(jual_tanggal) = ".$param."");
        }    
        
        $result = $hsl->result_array();
		foreach($result as $a){
			return $a['total_jual'];
		}
	}

    function get_data_jual_customer($param=""){   
        
        if ($param < 13){
            $tahun = date("Y");
            $hsl=$this->db->query("select jual_customer, sum(jual_total)as total_jual from tbl_jual where year(jual_tanggal) = ".$tahun." and month(jual_tanggal) = ".$param." group by jual_customer");
        }else{
            $hsl=$this->db->query("select jual_customer, sum(jual_total)as total_jual from tbl_jual where year(jual_tanggal) = ".$param." group by jual_customer");
        }    
        
        return $hsl->result_array();
		// foreach($result as $a){
		// 	return $a['total_jual'];
		// }
	}

    function get_data_beli($param=""){   
        
        if ($param < 13){
            $tahun = date("Y");
            $hsl=$this->db->query("select sum(d_beli_total) as total_beli from tbl_detail_beli tdb join tbl_beli tb on tdb.d_beli_kode = tb.beli_kode where year(tb.beli_tanggal) = ".$tahun." and month(tb.beli_tanggal) = ".$param."");
        }else{
            $hsl=$this->db->query("select sum(d_beli_total) as total_beli from tbl_detail_beli tdb join tbl_beli tb on tdb.d_beli_kode = tb.beli_kode where year(tb.beli_tanggal) = ".$param."");
        }    
        
        $result = $hsl->result_array();
		foreach($result as $a){
			return $a['total_beli'];
		}
	}

    function get_data_income($param=""){   
        
        if ($param < 13){
            $tahun = date("Y");
            $hsl=$this->db->query("select sum(nominal)as total_income from tbl_income_outcome where YEAR (tanggal) = ".$tahun." and month(tanggal) = ".$param." and isIncome = 1;");
        }else{
            $hsl=$this->db->query("select sum(nominal)as total_income from tbl_income_outcome where year(tanggal) = ".$param." and isIncome = 1;");
        }    
        
        $result = $hsl->result_array();
		foreach($result as $a){
			return $a['total_income'];
		}
	}

    function get_data_outcome($param=""){   
        
        if ($param < 13){
            $tahun = date("Y");
            $hsl=$this->db->query("select sum(nominal)as total_income from tbl_income_outcome where YEAR (tanggal) = ".$tahun." and month(tanggal) = ".$param." and isIncome = 2;");
        }else{
            $hsl=$this->db->query("select sum(nominal)as total_income from tbl_income_outcome where year(tanggal) = ".$param." and isIncome = 2;");
        }    
        
        $result = $hsl->result_array();
		foreach($result as $a){
			return $a['total_income'];
		}
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
}