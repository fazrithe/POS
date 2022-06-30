<?php
class M_sales_audit extends CI_Model{

	function hapus_suplier($kode){
		$hsl=$this->db->query("DELETE FROM tbl_suplier where suplier_id='$kode'");
		return $hsl;
	}

	function update_suplier($kode,$nama,$alamat,$notelp){
		$hsl=$this->db->query("UPDATE tbl_suplier set suplier_nama='$nama',suplier_alamat='$alamat',suplier_notelp='$notelp' where suplier_id='$kode'");
		return $hsl;
	}

	function tampil_suplier(){
		$hsl=$this->db->query("select * from tbl_suplier order by suplier_id desc");
		return $hsl;
	}

	function simpan_suplier($nama,$alamat,$notelp){
		$hsl=$this->db->query("INSERT INTO tbl_suplier(suplier_nama,suplier_alamat,suplier_notelp) VALUES ('$nama','$alamat','$notelp')");
		return $hsl;
    }
    
    function tampil_sales(){
        $hsl=$this->db->query("select a.sales_id,b.karyawan_id,b.karyawan_nama from tbl_sales_master a
        join tbl_karyawan b on a.karyawan_id = b.karyawan_id
        where a.sales_status = 1
        order by b.karyawan_nama");
		return $hsl;
    }

    function faktur_bysales($sales_id){
        $hsl=$this->db->query("select a.jual_nofak,a.jual_belanja,IFNULL(f.setoran,0)as setoran,IFNULL(f.flagging,0)as status_bayar,b.customer_name,a.jual_customer,e.karyawan_nama,e.karyawan_id
        from tbl_jual a
        join tbl_customer b on a.jual_customer = b.customer_id 
        join tbl_sales_mapping c on b.customer_id = c.id_customer
        join tbl_sales_master d on c.id_sales = d.sales_id
        join tbl_karyawan e on d.karyawan_id = e.karyawan_id
        left join tbl_setoran_hutang f on a.jual_nofak = f.nofak 
        where d.sales_id = '$sales_id' and a.jual_tanggal <= NOW()-INTERVAL 1 day and a.jual_status_bayar = 0
        order by b.customer_name,a.jual_nofak,f.flagging");
		return $hsl;
    }

    function sum_data($sales_id){
        $hsl=$this->db->query("select sum(a.jual_belanja) as sum_belanja, sum(IFNULL(f.setoran,0)) as sum_setoran
        from tbl_jual a
        join tbl_customer b on a.jual_customer = b.customer_id 
        join tbl_sales_mapping c on b.customer_id = c.id_customer 
        join tbl_sales_master d on c.id_sales = d.sales_id
        join tbl_karyawan e on d.karyawan_id = e.karyawan_id
        left join tbl_setoran_hutang f on a.jual_nofak = f.nofak
        where d.sales_id = '$sales_id' and a.jual_tanggal <= NOW() - INTERVAL 1 day and a.jual_status_bayar = 0");
        return $hsl;
        //kalau user minta keluarin data untuk status bayar 1 jg, maka minta rule dari mereka interval data keluar tagihan minimum dan maksimum, soalnya kalau data dgn status_bayar 1 bisa jadi data yang dari beberapa tahun silam
    }

    function sum_belanja($sales_id){
        $hsl=$this->db->query("select sum(jual_belanja) as sum_belanja from vw_sum_belanja 
        where sales_id = '$sales_id' and jual_tanggal <= NOW()-INTERVAL 1 day and jual_status_bayar = 0");
        return $hsl;
    }

    function show_init(){
        $hsl=$this->db->query("select a.jual_nofak,a.jual_belanja,IFNULL(f.setoran,0)as setoran,IFNULL(f.flagging,0)as status_bayar,b.customer_name,a.jual_customer,e.karyawan_nama,d.sales_id
        from tbl_jual a
        join tbl_customer b on a.jual_customer = b.customer_id 
        join tbl_sales_mapping c on b.customer_id = c.id_customer
        join tbl_sales_master d on c.id_sales = d.sales_id
        join tbl_karyawan e on d.karyawan_id = e.karyawan_id
        left join tbl_setoran_hutang f on a.jual_nofak = f.nofak      
        order by b.customer_name,a.jual_nofak,f.flagging");
		return $hsl;
    }

    function show_faktur(){
        $hsl=$this->db->query("select a.jual_nofak, b.customer_name,a.jual_tanggal 
        from tbl_jual a
        join tbl_customer b on a.jual_customer = b.customer_id 
        where a.jual_tanggal <= NOW()-INTERVAL 1 day and a.jual_status_bayar = 0;");
        return $hsl->result();
    }

    function faktur_jatuh_tempo(){
        $hsl=$this->db->query("select a.jual_nofak, b.customer_name,a.jual_tanggal 
        from tbl_jual a
        join tbl_customer b on a.jual_customer = b.customer_id 
        where a.jual_tanggal <= NOW()-INTERVAL 1 day and a.jual_status_bayar = 0;");
        return $hsl;
    }
}