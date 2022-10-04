<?php
class Cron extends CI_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('M_kategori');
		$this->load->model('M_barang');
		$this->load->model('M_suplier');
		$this->load->model('M_pembelian');
		$this->load->model('M_penjualan');
		$this->load->model('M_customer');
		$this->load->model('M_laporan');
	}
	
	function lap_penjualan(){
        $email_to = 'cyberfazri@gmail.com';
		$start_date = date("Y-m-d");
		$end_date	= date("Y-m-d", strtotime('+1 days'));
		$data = $this->M_laporan->get_data_jual($start_date,$end_date);
		$jml  = $this->M_laporan->get_total_jual($start_date,$end_date);
		$message = '<!DOCTYPE html>
		<html><b><h4>Laporan Penjualan '.$start_date.' s/d '.$end_date.'</h4></b>
		<table width="100%" border="1">
			<thead>
				<tr style="font-weight:bold;">
					<th>No.</th>
		
					<th>Faktur</th>
		
					<th>Nama Customer</th>
		
					<th>Tanggal</th>
		
					<th>Kode Barang</th>
		
					<th>Nama Barang</th>
		
					<th>Satuan</th>
		
					<th>Harga Jual (Rp)</th>
		
					<th>Qty</th>
		
					<th>Diskon</th>
		
					<th>Tipe Pembayaran</th>
		
					<th>Subtotal (Rp)</th>
								
				</tr>
			</thead>
			<tbody>';
				$i=1; foreach($data->result_array() as $list) {
						 $this->db->select('customer_name');
						 $this->db->where('customer_id',$list['jual_customer']);
						 $this->db->from('tbl_customer');
						 $customer = $this->db->get();   
						 $custname = $customer->row(); 
				
				
			$message .='<tr>
					<td align="center">'.$i.'</td>
		
					<td>'.$list['jual_nofak'].'</td>
		
					<td>'.$list['customer_name'].'</td>
		
					<td>'.$list['jual_tanggal'].'</td>
		
					<td>'.$list['d_jual_barang_id'].'</td>
		
					<td>'.$list['d_jual_barang_nama'].'</td>
		
					<td>'.$list['d_jual_barang_satuan'].'</td>
		
					<td>'.$list['d_jual_barang_harjul'].'</td>
		
					<td>'.$list['d_jual_qty'].'</td>
					
					<td>'.$list['d_jual_diskon'].'</td>
		
					<td>'.$list['jual_tipe_pembayaran'].'</td>
		
					<td>'.$list['d_jual_total'].'</td>
		
				</tr>';
				$i++;
				}
				$b=$jml->row_array();
			$message .= '<tr>
				<td colspan="11" align="right"><b>Total (Rp)</b></td>
				<td align="right"><b>'.$b['jual_total'].'</b></td>
			</tr>
	
			<tr>
				<td colspan="11" align="right"><b>Cashback (Rp)</b></td>
				<td align="right"><b>'.$b['total_cashback'].'</b></td>
			</tr>
	
			<tr>
				<td colspan="11" align="right"><b>Grand Total (Rp)</b></td>
				<td align="right"><b>'.$b['grand_total'].'</b></td>
			</tr>';
			$message .='</tbody>
		</table>';
		$email = "admin@temanngoding.com";
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://mail.temanngoding.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = $email;
        $config['smtp_pass'] = 'teman@123';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not
        $this->email->initialize($config);
        $this->email->from("admin@temanngoding.com", 'Admin');
        $this->email->to($email_to);
        $this->email->subject("Laporan Penjualan");
        $this->email->message($message);
        $this->email->send();
        $return['status'] = "1";
        $return['msg'] = "Successfully sent email";
        redirect('/Administrator');
 
	}
}