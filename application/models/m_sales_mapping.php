<?php
class M_sales_mapping extends CI_Model{    
    function get_init(){
		$hsl=$this->db->query("select a.id_mapping,a.id_sales,a.id_customer,a.id_area,c.karyawan_nama,d.customer_name,e.area_nama
        from tbl_sales_mapping a
        join tbl_sales_master b on a.id_sales = b.sales_id 
        join tbl_karyawan c on b.karyawan_id = c.karyawan_id
        join tbl_customer d on a.id_customer = d.customer_id
        join tbl_area e on a.id_area = e.id_area where a.map_flag = 1");
		return $hsl;
    }

    // function validasi_insert($param){        
    //     $hsl = $this->db->query("select * from tbl_sales_mapping where id_sales = $param[0] and id_customer = $param[1] and id_area = $param[2]");        
    //     return $hsl;
    // }

    function validasi_insert($param){        
        $hsl = $this->db->query("select * from tbl_sales_mapping where id_customer = $param[1]");        
        return $hsl;
    }
    
    function insert_salesMap($param){
        $hsl = $this->db->query("INSERT INTO tbl_sales_mapping(id_sales,id_customer,id_area,insert_user,update_user,map_flag) values('$param[0]','$param[1]','$param[2]','$param[3]','$param[4]',1)");
        return $hsl;
    }

    function update_map($param){
        $hsl=$this->db->query("UPDATE tbl_sales_mapping SET id_sales='$param[0]', id_customer='$param[1]', id_area='$param[2]',update_datetime='$param[4]',update_user='$param[5]' WHERE id_mapping='$param[3]'");		
		return $hsl;
	}

	function nonaktif_map($id_mapping){
		$hsl=$this->db->query("UPDATE tbl_sales_mapping SET map_flag='0' WHERE id_mapping='$id_mapping'");
		return $hsl;
    }
    
    function aktif_map($id_mapping){
		$hsl=$this->db->query("UPDATE tbl_sales_mapping SET map_flag='1' WHERE id_mapping='$id_mapping'");
		return $hsl;
	}
}