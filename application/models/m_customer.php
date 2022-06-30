<?php
class M_customer extends CI_Model{

	function get_customer_all(){
		$hsl=$this->db->query("SELECT * FROM tbl_customer");
		return $hsl;
	}

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
	
	function insert_credit(){
		$id = $this->session->userdata('sess_cid');
		$hutang = $this->session->userdata('newhutang');
		$hsl=$this->db->query("UPDATE tbl_customer set customer_hutang = '$hutang' where customer_id = '$id'");
		return $hsl;
	}

	function get_customer_search($str)
    {
        $this->db->select('customer_id, customer_name as text');
        $this->db->like('customer_name', $str);
        $query = $this->db->get('tbl_customer');
        return $query->result();
    }

	function get_alamat_customer($id){
		$this->db->select('customer_alamat','customer_name');
		$this->db->where('customer_id', $id);
        $query = $this->db->get('tbl_customer');
		return $query->row();
	}

	function get_id_customer($id){
		$this->db->select('customer_name');
		$this->db->where('customer_id', $id);
        $query = $this->db->get('tbl_customer');
		return $query->row();
	}
}