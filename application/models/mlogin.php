<?php
class Mlogin extends CI_Model{
    function cekadmin($u,$p){
        $hasil=$this->db->query("select*from tbl_user where user_status = 1 and user_username='$u'and user_password=md5('$p')");
        return $hasil;
    }
  
}
