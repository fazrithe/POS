<?php
class M_Income_outcome extends CI_Model{

	function simpan_history($dataStore,$insert_user){        
        $flag = 0;
        for ($i = 0; $i < count($dataStore['tgl']); $i++){
            $tanggal = $dataStore['tgl'][$i];
            $io = $dataStore['io'][$i];
            $description = $dataStore['description'][$i];
            $nominal = str_replace(",","",$dataStore['nominal'][$i]);
            // print_r($dataStore['tgl'][$i]);
            // print_r($dataStore['io'][$i]);
            // print_r($dataStore['description'][$i]);
            // print_r($dataStore['nominal'][$i]);
            // break;                
            // echo "</br>";
            $hsl=$this->db->query("INSERT INTO tbl_income_outcome(tanggal,isIncome,keterangan,nominal,insert_user,update_user) VALUES ('$tanggal','$io','$description','$nominal','$insert_user','$insert_user')");

            if (!$hsl){
                $flag++;
            }    
        }

        if ($flag > 0){
            return false;
        }

        return true;

        
        // $hsl=$this->db->query("INSERT INTO tbl_area(area_nama,area_flagging,insert_datetime,update_datetime,insert_user,update_user) VALUES ('$area_name','$area_flagging','$insert_date','$update_date','$insert_user','$update_user')");
		// return $hsl;
	}

}