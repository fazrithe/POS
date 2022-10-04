<?php
class M_laporan extends CI_Model{
	function get_stok_barang(){
		$hsl=$this->db->query("SELECT kategori_id,kategori_nama,barang_nama,barang_stok FROM tbl_kategori JOIN tbl_barang ON kategori_id=barang_kategori_id GROUP BY kategori_id,barang_nama");
		return $hsl;
	}
	function get_data_barang(){
		$hsl=$this->db->query("SELECT kategori_id,barang_id,kategori_nama,barang_nama,barang_satuan,barang_harjul,barang_stok FROM tbl_kategori JOIN tbl_barang ON kategori_id=barang_kategori_id GROUP BY kategori_id,barang_nama");
		return $hsl;
	}

	function get_data_barang1(){
		$hsl=$this->db->query("SELECT * from tbl_barang");
		return $hsl;
	}

	function get_data_pembelian(){
		$hsl=$this->db->query("SELECT tb.beli_nofak,DATE_FORMAT(beli_tanggal,'%d %M %Y')AS beli_tanggal,tdb.d_beli_barang_id,tbr.barang_nama,tbr.barang_satuan,tdb.d_beli_harga,tdb.d_beli_jumlah,tdb.d_beli_total,tdb.d_beli_kode
		FROM tbl_beli tb
		JOIN tbl_detail_beli tdb ON tb.beli_kode=tdb.d_beli_kode 
		JOIN tbl_barang tbr ON tdb.d_beli_barang_id = tbr.barang_id
		ORDER BY beli_tanggal,tb.beli_nofak");
		return $hsl;
	}

	function get_total_pembelian(){
		$hsl=$this->db->query("SELECT sum(d_beli_total)as beli_total FROM tbl_detail_beli");
		return $hsl;
	}

	function get_data_beli_cust($dateFrom,$dateTo){
		$hsl=$this->db->query("SELECT tb.beli_nofak,DATE_FORMAT(beli_tanggal,'%d %M %Y')AS beli_tanggal,tdb.d_beli_barang_id,tbr.barang_nama,tbr.barang_satuan,tdb.d_beli_harga,tdb.d_beli_jumlah,tdb.d_beli_total,tdb.d_beli_kode
		FROM tbl_beli tb
		JOIN tbl_detail_beli tdb ON tb.beli_kode=tdb.d_beli_kode 
		JOIN tbl_barang tbr ON tdb.d_beli_barang_id = tbr.barang_id
		WHERE beli_tanggal BETWEEN '$dateFrom' AND '$dateTo'
		ORDER BY beli_tanggal,tb.beli_nofak");
		return $hsl;
	}

	function get_total_beli_cust($dateFrom,$dateTo){
		$hsl=$this->db->query("SELECT sum(d_beli_total)as beli_total FROM tbl_detail_beli tdb 
		JOIN tbl_beli tb ON tdb.d_beli_kode = tb.beli_kode WHERE tb.beli_tanggal BETWEEN '$dateFrom' AND '$dateTo'");
		return $hsl;
	}

	function get_data_penjualan(){
		$hsl=$this->db->query("SELECT tj.jual_nofak,DATE_FORMAT(tj.jual_tanggal,'%d %M %Y') AS jual_tanggal,tj.jual_total,tdj.d_jual_barang_id,tdj.d_jual_barang_nama,tdj.d_jual_barang_satuan,tdj.d_jual_barang_harpok,tdj.d_jual_barang_harjul,tdj.d_jual_qty,tdj.d_jual_diskon,tdj.d_jual_total,tdj.d_jual_disc_val FROM tbl_jual tj JOIN tbl_detail_jual tdj ON tj.jual_nofak=tdj.d_jual_nofak ORDER BY tj.jual_nofak DESC");
		return $hsl;
	}
	
	function get_total_penjualan(){
		$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,sum(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
		return $hsl;
	}

	function get_data_jual_cust($dtJx1,$dtJx2){
		$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal)BETWEEN '$dtJx1' AND '$dtJx2' ORDER BY jual_nofak DESC");
		return $hsl;
	}

	function get_total_jual_cust($dtJx1,$dtJx2){
		$hsl=$this->db->query("SELECT sum(jual_total)as jual_total, sum(jual_belanja)as grand_total,sum(jual_cashback) as total_cashback FROM tbl_jual WHERE DATE(jual_tanggal) BETWEEN '$dtJx1' AND '$dtJx2'");
		return $hsl;
	}

	function get_data_return(){
		$hsl=$this->db->query("SELECT a.jual_nofak,a.insert_datetime,a.barang_id,b.barang_nama,a.harga_jual,a.qty,a.stok_retur_good,a.stok_retur_broken,a.reason,a.change_with FROM tbl_after_sales a 
		JOIN tbl_barang b ON a.barang_id = b.barang_id");
		return $hsl;
	}

	function get_data_karyawan(){
		$hsl=$this->db->query("SELECT * from tbl_karyawan WHERE karyawan_status = '1'");
		return $hsl;
	}

	function get_top_item(){
		$hsl=$this->db->query("SELECT d_jual_barang_id,d_jual_barang_nama,count(d_jual_barang_id) as rank_item FROM tbl_detail_jual GROUP BY d_jual_barang_id,d_jual_barang_nama ORDER BY rank_item DESC");
		return $hsl;
	}

	function get_data_sales(){
		$hsl=$this->db->query("SELECT a.karyawan_id,b.sales_id,a.karyawan_nama,c.sales_area,c.sales_buyer
		FROM tbl_karyawan a
		JOIN tbl_sales_master b ON a.karyawan_id = b.karyawan_id
		JOIN tbl_sales_detail c ON b.sales_id = c.sales_id
		WHERE b.sales_status = 1");
		return $hsl;
	}

	function get_data_so($bln){
		$hsl=$this->db->query("SELECT * FROM tbl_history_so WHERE DATE_FORMAT(insert_datetime,'%M %Y')='$bln' ");
		return $hsl;
	}

	function get_data_user(){
		$hsl=$this->db->query("SELECT * FROM tbl_user where user_status = '1'");
		return $hsl;
	}

	// function get_data_jual(){
	// 	$hsl=$this->db->query("SELECT jual_nofak, jual_customer, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak");
	// 	return $hsl;
	// }

	function get_data_jual($start_date,$end_date){
		$hsl=$this->db->query("SELECT a.jual_customer, a.jual_nofak, a.jual_tipe_pembayaran, c.customer_name, DATE_FORMAT(a.jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total
		FROM tbl_jual a JOIN tbl_detail_jual b ON a.jual_nofak=b.d_jual_nofak
		JOIN tbl_customer c ON a.jual_customer=c.customer_id
		WHERE a.jual_tanggal BETWEEN '".$start_date."' AND '".$end_date."'");
		return $hsl;
	}

	function get_total_jual($start_date,$end_date){
		$hsl=$this->db->query("SELECT sum(a.jual_total)as jual_total, sum(a.jual_belanja)as grand_total,sum(a.jual_cashback) as total_cashback 
		FROM tbl_jual a JOIN tbl_customer b ON a.jual_customer=b.customer_id
		WHERE a.jual_tanggal BETWEEN '".$start_date."' AND '".$end_date."'");
		return $hsl;
	}

	
	function get_data_jual_day($start_date,$end_date){
		$hsl=$this->db->query("SELECT a.jual_nofak, a.jual_tipe_pembayaran, c.customer_name, DATE_FORMAT(a.jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total
		FROM tbl_jual a JOIN tbl_detail_jual b ON a.jual_nofak=b.d_jual_nofak
		JOIN tbl_customer c ON a.jual_customer=c.customer_id
		WHERE a.jual_tanggal BETWEEN '".$start_date."' AND '".$end_date."'");
		return $hsl;
	}

	function get_total_jual_day($start_date,$end_date){
		$hsl=$this->db->query("SELECT sum(a.jual_total)as jual_total, sum(a.jual_belanja)as grand_total,sum(a.jual_cashback) as total_cashback 
		FROM tbl_jual a JOIN tbl_customer b ON a.jual_customer=b.customer_id
		WHERE a.jual_tanggal BETWEEN '".$start_date."' AND '".$end_date."'");
		return $hsl;
	}

	function get_total_penjualan1(){
		$hsl=$this->db->query("SELECT sum(jual_total)as jual_total, sum(jual_belanja)as grand_total,sum(jual_cashback) as total_cashback FROM tbl_jual");
		return $hsl;
	}

	function get_data_jual_pertanggal($tanggal){
		$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal)='$tanggal' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_data__total_jual_pertanggal($tanggal){
		$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal)='$tanggal' ORDER BY jual_nofak DESC");
		return $hsl;
	}

	function get_data__total_jual_pertanggal1($tanggal){
		$hsl=$this->db->query("SELECT sum(jual_total)as jual_total, sum(jual_belanja)as grand_total,sum(jual_cashback) as total_cashback FROM tbl_jual WHERE DATE(jual_tanggal)='$tanggal'");
		return $hsl;
	}

	function get_bulan_jual(){
		$hsl=$this->db->query("SELECT DISTINCT DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan FROM tbl_jual");
		return $hsl;
	}

	function get_bulan_so(){
		$hsl=$this->db->query("SELECT DISTINCT DATE_FORMAT(insert_datetime,'%M %Y') AS bulan FROM tbl_history_so ths");
		return $hsl;
	}

	function get_tahun_jual(){
		$hsl=$this->db->query("SELECT DISTINCT YEAR(jual_tanggal) AS tahun FROM tbl_jual");
		return $hsl;
	}
	function get_jual_perbulan($bulan){
		$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_total_jual_perbulan($bulan){
		$hsl=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan' ORDER BY jual_nofak DESC");
		return $hsl;
	}

	function get_total_jual_perbulan1($bulan){
		$hsl=$this->db->query("SELECT sum(jual_total)as jual_total, sum(jual_belanja)as grand_total,sum(jual_cashback) as total_cashback FROM tbl_jual WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan'");
		return $hsl;
	}
	function get_jual_pertahun($tahun){
		$hsl=$this->db->query("SELECT jual_nofak,YEAR(jual_tanggal) AS tahun,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE YEAR(jual_tanggal)='$tahun' ORDER BY bulan DESC, jual_tanggal ASC, d_jual_nofak asc,d_jual_barang_id asc");
		return $hsl;
	}
	function get_total_jual_pertahun($tahun){
		$hsl=$this->db->query("SELECT jual_nofak,YEAR(jual_tanggal) AS tahun,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE YEAR(jual_tanggal)='$tahun' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	function get_total_jual_pertahun1($tahun){
		$hsl=$this->db->query("SELECT sum(jual_total)as jual_total, sum(jual_belanja)as grand_total,sum(jual_cashback) as total_cashback FROM tbl_jual WHERE YEAR(jual_tanggal)='$tahun' ORDER BY jual_nofak DESC");
		return $hsl;
	}
	//=========Laporan Laba rugi============
	function get_lap_laba_rugi($bulan){
		$hsl=$this->db->query("SELECT DATE_FORMAT(jual_tanggal,'%d %M %Y %H:%i:%s') as jual_tanggal,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,(d_jual_barang_harjul-d_jual_barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,((d_jual_barang_harjul-d_jual_barang_harpok)*d_jual_qty)-(d_jual_qty*d_jual_diskon) AS untung_bersih FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan'");
		return $hsl;
	}
	function get_total_lap_laba_rugi($bulan){
		$hsl=$this->db->query("SELECT DATE_FORMAT(a.jual_tanggal,'%M %Y') AS bulan,b.d_jual_barang_nama,b.d_jual_barang_satuan,b.d_jual_barang_harpok,b.d_jual_barang_harjul,(b.d_jual_barang_harjul-b.d_jual_barang_harpok) AS keunt,b.d_jual_qty,b.d_jual_diskon,SUM(((b.d_jual_barang_harjul-b.d_jual_barang_harpok)*b.d_jual_qty)-(b.d_jual_qty*b.d_jual_diskon)) AS total 
		FROM tbl_jual a JOIN tbl_detail_jual b ON a.jual_nofak=b.d_jual_nofak
		JOIN tbl_customer c ON a.jual_customer=b.customer_id 
		WHERE DATE_FORMAT(a.jual_tanggal,'%M %Y')='$bulan'");
		return $hsl;
	}
}