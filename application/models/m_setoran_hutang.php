<?php
class M_setoran_hutang extends CI_Model{
	function get_customer($param=""){
		$hsl=$this->db->query("SELECT * FROM tbl_customer WHERE customer_flagging = 1 and customer_name like'%$param%'");
		return $hsl;
	}

	function get_custname_id($param=""){
		$hsl=$this->db->query("SELECT * FROM tbl_customer WHERE customer_flagging = 1 and (customer_name like'%$param%' or customer_id like '%$param%')");
		return $hsl;
	}

	function get_direct_name($param=""){
		$hsl=$this->db->query("SELECT * FROM tbl_customer WHERE customer_flagging = 1 and customer_name = '$param'");
		return $hsl;
	}

	function get_direct_id($param){
		if ($param == ""){
			$param = -1;
		}
		$hsl=$this->db->query("SELECT * FROM tbl_customer WHERE customer_flagging = 1 and customer_id = '$param'");
		return $hsl;
	}

	function simpan_customer($param){
        $customer_name     = $param[0];
        $customer_limit    = $param[1];
        $customer_hutang   = $param[2];
        $customer_alamat   = $param[3];
        $customer_telepon  = $param[4];
        $customer_flagging = $param[5];
        $insert_date       = $param[6];
        $update_date       = $param[7];
        $insert_user       = $param[8];
        $update_user       = $param[9];
        
        $hsl=$this->db->query("INSERT INTO tbl_customer(customer_name,customer_limit,customer_hutang,customer_alamat,customer_telepon,customer_flagging,insert_datetime,update_datetime,insert_user,update_user) VALUES ('$customer_name','$customer_limit','$customer_hutang','$customer_alamat','$customer_telepon','$customer_flagging','$insert_date','$update_date','$insert_user','$update_user')");
		return $hsl;
	}

	function update_customer($param){
        $hsl=$this->db->query("UPDATE tbl_customer SET customer_name='$param[1]', customer_limit='$param[2]', customer_hutang='$param[3]',customer_alamat='$param[4]',customer_telepon='$param[5]',update_datetime='$param[6]',update_user='$param[7]' WHERE customer_id='$param[0]'");
		return $hsl;
	}

	function update_status($customer_id){
		$hsl=$this->db->query("UPDATE tbl_customer SET customer_flagging='0' WHERE customer_id='$customer_id'");
		return $hsl;
	}

	function validasi_delete($customer_id){
		$hsl=$this->db->query("SELECT * from tbl_customer where customer_id = '$customer_id'");			
		return $hsl;
	}

	function search_customer($param){
		// $this->db->where('customer_flagging', 1);
		// $this->db->like('customer_name', $param);
		// $this->db->or_like('customer_id', $param);
        // $this->db->order_by('customer_name', 'ASC');
        // $this->db->limit(10);
		// return $this->db->get('tbl_customer')->result();
		$hsl = $this->db->query("select * from tbl_customer where customer_flagging=1 and (customer_name like '%$param%' or customer_id like '%$param%') order by customer_name limit 10");
		return $hsl;
	}
    
    // function show_all(){
    //     $hsl = $this->db->query("select a.jual_nofak, b.customer_id, b.customer_name, b.customer_alamat,a.jual_belanja,a.jual_tanggal,c.setoran,a.jual_status_bayar,c.sisa_hutang from tbl_jual a
    //     join tbl_customer b on a.jual_customer = b.customer_id
    //     left join tbl_setoran_hutang c on a.jual_nofak = c.nofak
    //     where jual_status_bayar = 0");
    //     return $hsl;
    // }

    function show_all(){
        $hsl = $this->db->query("select a.jual_nofak, b.customer_id,b.customer_name,b.customer_alamat,a.jual_belanja,a.jual_tanggal,sum(IFNULL(c.setoran,0)) as total_setoran,a.jual_status_bayar,(a.jual_belanja - sum(IFNULL(c.setoran,0))) as total_hutang
        from tbl_jual a
        join tbl_customer b on a.jual_customer = b.customer_id
        left join tbl_setoran_hutang c on a.jual_nofak = c.nofak         
        group by a.jual_nofak
        order by a.jual_nofak,b.customer_name");
		return $hsl;
		// where a.jual_status_bayar = 0
    }

    function jual_uplunas($nofak){
        $this->db->query("UPDATE tbl_jual set jual_status_bayar = 1 where jual_nofak = '$nofak'");
        
        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    function cust_uphutang($custid,$setoran,$var_a,$hutang){
        $this->db->query("UPDATE tbl_customer set customer_hutang = customer_hutang - $setoran where customer_id = '$custid'");
        
        if($var_a === FALSE && $hutang == 0){
            $this->db->trans_rollback();
			return false;
        }else if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    function get_mapping($custid){
        $hsl=$this->db->query("SELECT id_mapping from tbl_sales_mapping where id_customer = '$custid'");
        return $hsl;
    }

    function insert_setoran($param,$var_b){
        $this->db->query("INSERT INTO tbl_setoran_hutang(id_mapping,nofak,setoran,flagging,insert_datetime,update_datetime,insert_user,update_user) VALUES ('$param[1]','$param[2]','$param[3]','$param[4]','$param[5]','$param[6]','$param[7]','$param[8]','$param[9]')");
        
        if ($var_b === FALSE){
            $this->db->trans_rollback();
			return false;
        }else if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    function f_hutang_lunas($nofak,$custid,$setoran,$param){
        $this->db->query("UPDATE tbl_jual set jual_status_bayar = 1 where jual_nofak = '$nofak'");
        
        $this->db->query("UPDATE tbl_customer set customer_hutang = customer_hutang - $setoran where customer_id = '$custid'");
        
        $this->db->query("INSERT INTO tbl_setoran_hutang(id_mapping,nofak,setoran,flagging,insert_datetime,update_datetime,insert_user,update_user,sisa_hutang) VALUES ('$param[1]','$param[2]','$param[3]','$param[4]','$param[5]','$param[6]','$param[7]','$param[8]','$param[9]')");

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    function f_hutang_exist($custid,$setoran,$param){
        $this->db->query("UPDATE tbl_customer set customer_hutang = customer_hutang - $setoran where customer_id = '$custid'");

        $this->db->query("INSERT INTO tbl_setoran_hutang(id_mapping,nofak,setoran,flagging,insert_datetime,update_datetime,insert_user,update_user,sisa_hutang) VALUES ('$param[1]','$param[2]','$param[3]','$param[4]','$param[5]','$param[6]','$param[7]','$param[8]','$param[9]')");

        if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
    }

    function data_detail($nofak){
        $hsl=$this->db->query("SELECT id_setoran,nofak,setoran,insert_datetime,sisa_hutang,flagging from tbl_setoran_hutang where nofak = '$nofak'");
        return $hsl;
    }
}