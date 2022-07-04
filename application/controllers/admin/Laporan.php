<?php
class Laporan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
			// $url=base_url();
			$url = 'Administrator';
            redirect($url);
        };
		$this->load->model('M_kategori');
		$this->load->model('M_barang');
		$this->load->model('M_suplier');
		$this->load->model('M_pembelian');
		$this->load->model('M_penjualan');
		$this->load->model('M_customer');
		$this->load->model('M_laporan');
		$this->load->library('Excel');
		$this->load->library('pdf');
	}
	function index(){
	if($this->session->userdata('akses')=='1'){
		$data['data']=$this->M_barang->tampil_barang();
		$data['kat']=$this->M_kategori->tampil_kategori();
		$data['jual_bln']=$this->M_laporan->get_bulan_jual();
		$data['so_bln']=$this->M_laporan->get_bulan_so();
		$data['jual_thn']=$this->M_laporan->get_tahun_jual();
		$this->load->view('admin/v_laporan',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function lap_so_perbulan_xls(){
		$bln = $this->input->post('bln');
		$x['data'] = $this->M_laporan->get_data_so($bln);
		$this->load->view('admin/laporan/v_lSo_xls',$x);		
	}

	function lap_so_perbulan_pdf(){
		$bln = $this->input->post('bln');
		$x['data'] = $this->M_laporan->get_data_so($bln);
		$this->load->view('admin/laporan/v_lSo_pdf',$x);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_so.pdf",array("Attachment"=>0));
	}

	function lap_rankItem_xls(){
		$x['data'] = $this->M_laporan->get_top_item();
		$this->load->view('admin/laporan/v_lTop_xls',$x);
	}

	function lap_rankItem_pdf(){
		$x['data'] = $this->M_laporan->get_top_item();
		$this->load->view('admin/laporan/v_lTop_pdf',$x);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_top_item.pdf",array("Attachment"=>0));
	}

	function lap_pembelian_xls(){
		$x['data'] = $this->M_laporan->get_data_pembelian();
		// var_dump($x['data']);
		// $x['data'] = array();
		// $y['data'] = array();
		// $x['tes'] = "10000";
		// $x['isi'] = ;
		$cek = array();
		$a = array();
		// print_r($x['data']);
		foreach($x['data']->result_array() as $list){
			// print_r($list);
			$a['beli_nofak'] = $list['beli_nofak'];
			$a['beli_tanggal'] = $list['beli_tanggal'];
			$a['d_beli_barang_id'] = $list['d_beli_barang_id'];
			$a['barang_nama'] = $list['barang_nama'];
			$a['barang_satuan'] = $list['barang_satuan'];
			$a['d_beli_harga'] = $list['d_beli_harga'];
			$a['d_beli_jumlah'] = $list['d_beli_jumlah'];
			$a['d_beli_total'] = number_format($list['d_beli_total']);		
			// print_r($a);	
			// $list[]
			$cek[] = $a;
		// 	// echo number_format($list['d_beli_total'])."\n";
		}
		// print_r($cek);
		$x['isi'] = $cek;
		// $x['isi'] = $
		// print_r($x['isi']);
		// foreach($x['isi']->result_array()as $list){
		// 	print_r($list);
		// }
		// print_r($x['isi']);
		// exit(71);
		$x['jml']  = $this->M_laporan->get_total_pembelian();
		$this->load->view('admin/laporan/v_lap_beli_xls',$x);
	}

	function faktur_penjualan(){
		// $x['data'] = $this->M_laporan->get_data_pembelian();
		// $x['jml']  = $this->M_laporan->get_total_pembelian();
		
		$cust_id = $this->session->userdata('temp_id');
		$customer_id = $this->session->userdata('sess_ccustid');
		$custname = $this->M_customer->get_id_customer($customer_id);
		$x['data']=$this->M_penjualan->cetak_faktur();
		//$x['sum_qty'] = $this->M_penjualan->sum_qty();
		$x['cust_info'] = $this->M_customer->get_direct_id($cust_id);
		$x['cust_name'] = $custname->customer_name;
		
		$this->load->view('admin/laporan/v_faktur_jual',$x);			
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		//$customePaper = array(0,0,600,490);
		// $this->dompdf->setPaper($customePaper); 
		// $this->dompdf->setPaper('A4','portrait');
		$this->dompdf->render();
		$nofak = $this->session->userdata('pdf_nofak');
		$filename = "f-".$nofak.".pdf";
		$this->dompdf->stream($filename,array("Attachment"=>0));
	}

	function lap_pembelian_pdf(){
		$x['data'] = $this->M_laporan->get_data_pembelian();
		$x['jml']  = $this->M_laporan->get_total_pembelian();
		$this->load->view('admin/laporan/v_lap_beli_pdf',$x);	
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_beli.pdf",array("Attachment"=>0));
	}

	function lap_beli_xls_cust(){		
		$dateFrom=$this->input->post('dateFrom');
		$dateTo = $this->input->post('dateTo');		
		$x['data']=$this->M_laporan->get_data_beli_cust($dateFrom,$dateTo);		
		$x['jml']=$this->M_laporan->get_total_beli_cust($dateFrom,$dateTo);		
		$this->load->view('admin/laporan/v_lBeli_custX',$x);
	}

	function lap_beli_pdf_cust(){
		// $tanggal=$this->input->post('tgl');
		$dateFrom=$this->input->post('dateFrom');
		$dateTo = $this->input->post('dateTo');		
		$x['data']=$this->M_laporan->get_data_beli_cust($dateFrom,$dateTo);		
		$x['jml']=$this->M_laporan->get_total_beli_cust($dateFrom,$dateTo);		
		$this->load->view('admin/laporan/v_lBeli_custP',$x);	
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_beli_range_date.pdf",array("Attachment"=>0));		
	}

	function lap_dtUser_xls(){
		$x['data'] = $this->M_laporan->get_data_user();				
		$this->load->view('admin/laporan/v_lUser_xls',$x);
	}

	function lap_dtUser_pdf(){
		$x['data'] = $this->M_laporan->get_data_user();				
		$this->load->view('admin/laporan/v_lUser_pdf',$x);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_user.pdf",array("Attachment"=>0));
	}

	function lap_dtKaryawan_xls(){
		$x['data'] = $this->M_laporan->get_data_karyawan();				
		$this->load->view('admin/laporan/v_lKaryawan_xls',$x);
	}

	function lap_dtKaryawan_pdf(){
		$x['data'] = $this->M_laporan->get_data_karyawan();				
		$this->load->view('admin/laporan/v_lKaryawan_pdf',$x);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_karyawan.pdf",array("Attachment"=>0));
	}

	function lap_dtSales_xls(){
		$x['data'] = $this->M_laporan->get_data_sales();				
		$this->load->view('admin/laporan/v_lSales_xls',$x);
	}

	function lap_dtSales_pdf(){
		$x['data'] = $this->M_laporan->get_data_sales();				
		$this->load->view('admin/laporan/v_lSales_pdf',$x);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_sales.pdf",array("Attachment"=>0));
	}

	function lap_return_xls(){
		$x['data'] = $this->M_laporan->get_data_return();				
		$this->load->view('admin/laporan/v_lReturn_xls',$x);		
	}

	function lap_return_pdf(){
		$x['data'] = $this->M_laporan->get_data_return();
		// $x['jml']  = $this->M_laporan->get_total_return();
		$this->load->view('admin/laporan/v_lReturn_pdf',$x);	
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_return.pdf",array("Attachment"=>0));
	}

	function lap_jual_xls(){
		$start_date = $this->input->post('start_date');
		$end_date	= $this->input->post('end_date');
		$x['data'] = $this->M_laporan->get_data_jual($start_date,$end_date);
		$x['jml']  = $this->M_laporan->get_total_jual($start_date,$end_date);
		$x['start_date'] = $start_date;
		$x['end_date'] = $end_date;
		$this->load->view('admin/laporan/v_lJual_xls',$x);		
	}

	function lap_jual_pdf(){
		$start_date = $this->input->post('start_date');
		$end_date	= $this->input->post('end_date');
		$x['data'] = $this->M_laporan->get_data_jual($start_date,$end_date);
		$x['jml']  = $this->M_laporan->get_total_jual($start_date,$end_date);
		$x['start_date'] = $start_date;
		$x['end_date'] = $end_date;
		$this->load->view('admin/laporan/v_lJual_pdf',$x);	
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_jual.pdf",array("Attachment"=>0));
	}

	// function lap_jual_xls(){
	// 	$x['data'] = $this->M_laporan->get_data_jual();
	// 	$x['jml']  = $this->M_laporan->get_total_jual();
	// 	$this->load->view('admin/laporan/v_lJual_xls',$x);		
	// }

	// function lap_jual_pdf(){
	// 	$x['data'] = $this->M_laporan->get_data_jual();
	// 	$x['jml']  = $this->M_laporan->get_total_jual();
	// 	$this->load->view('admin/laporan/v_lJual_pdf',$x);	
	// 	$html = $this->output->get_output();
	// 	$this->load->library('pdf');
	// 	$this->dompdf->loadHTML($html);
	// 	$this->dompdf->setPaper('A4','landscape');
	// 	$this->dompdf->render();
	// 	$this->dompdf->stream("lap_jual.pdf",array("Attachment"=>0));
	// }

	function lap_jual_xls_cust(){		
		$dtJx1=$this->input->post('dtJx1');
		$dtJx2 = $this->input->post('dtJx2');			
		$x['data']=$this->M_laporan->get_data_jual_cust($dtJx1,$dtJx2);		
		$x['jml']=$this->M_laporan->get_total_jual_cust($dtJx1,$dtJx2);		
		$this->load->view('admin/laporan/v_lJual_custX',$x);
	}

	function lap_jual_pdf_cust(){
		$dtJp1=$this->input->post('dtJp1');
		$dtJp2 = $this->input->post('dtJp2');		
		$x['data']=$this->M_laporan->get_data_jual_cust($dtJp1,$dtJp2);		
		$x['jml']=$this->M_laporan->get_total_jual_cust($dtJp1,$dtJp2);		
		$this->load->view('admin/laporan/v_lJual_custP',$x);	
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_jual_range_date.pdf",array("Attachment"=>0));		
	}

	function lap_stok_barang(){
		$x['data']=$this->M_laporan->get_stok_barang();
		$this->load->view('admin/laporan/v_lap_stok_barang',$x);
	}
	function lap_data_barang_xls(){		
		$x['data']=$this->M_laporan->get_data_barang1();
		$this->load->view('admin/laporan/v_lap_barang_xls',$x);
	}
	function lap_data_barang(){
		$x['data']=$this->M_laporan->get_data_barang1();
		$this->load->view('admin/laporan/v_lBarang_pdf',$x);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_barang.pdf",array("Attachment"=>0));		
	}
	function lap_data_penjualan(){
		$x['data']=$this->M_laporan->get_data_penjualan();
		$x['jml']=$this->M_laporan->get_total_penjualan1();
		$this->load->view('admin/laporan/v_lap_penjualan',$x);
	}
	function lap_penjualan_pertanggal(){
		$tanggal=$this->input->post('tgl');
		$x['jml']=$this->M_laporan->get_data__total_jual_pertanggal1($tanggal);
		$x['data']=$this->M_laporan->get_data_jual_pertanggal($tanggal);		
		$this->load->view('admin/laporan/v_lap_jual_pertanggal',$x);
	}
	function lap_penjualan_perbulan(){
		$bulan=$this->input->post('bln');
		$x['jml']=$this->M_laporan->get_total_jual_perbulan1($bulan);
		$x['data']=$this->M_laporan->get_jual_perbulan($bulan);
		$this->load->view('admin/laporan/v_lap_jual_perbulan',$x);
	}	
	function lap_penjualan_pertahun(){
		$tahun=$this->input->post('thn');
		$x['jml']=$this->M_laporan->get_total_jual_pertahun1($tahun);
		$x['data']=$this->M_laporan->get_jual_pertahun($tahun);
		$this->load->view('admin/laporan/v_lap_jual_pertahun',$x);
	}
	function lap_laba_rugi(){
		$bulan=$this->input->post('bln');
		$x['jml']=$this->M_laporan->get_total_lap_laba_rugi($bulan);
		$x['data']=$this->M_laporan->get_lap_laba_rugi($bulan);
		$this->load->view('admin/laporan/v_lap_laba_rugi',$x);
	}
}