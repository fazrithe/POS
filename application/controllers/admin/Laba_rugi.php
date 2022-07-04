<?php
class Laba_rugi extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
			// $url=base_url();
			$url = 'Administrator';
            redirect($url);
        };
		// $this->load->model('M_kategori');
        $this->load->model('M_laba_rugi');
	}

	function index(){
	    if($this->session->userdata('akses')=='1'){	    	
	    	$this->load->view('admin/v_laba_rugi');
	    }else{
            echo "Halaman tidak ditemukan";
        }
    }

    function get_data(){
        if($this->session->userdata('akses')=='1'){
            $filter=$this->input->post('filter');
            $result_jual=$this->M_laba_rugi->get_data_jual($filter);
            $result_beli=$this->M_laba_rugi->get_data_beli($filter);
            $result_income=$this->M_laba_rugi->get_data_income($filter);
            $result_outcome=$this->M_laba_rugi->get_data_outcome($filter);
            
            if (is_null($result_jual)){
                $result_jual = 0;
            }

            if (is_null($result_beli)){
                $result_beli = 0;
            }

            if (is_null($result_beli)){
                $result_beli = 0;
            }

            if (is_null($result_income)){
                $result_income = 0;
            }
            
            if (is_null($result_outcome)){
                $result_outcome = 0;
            }

            $data[0] = $result_jual;
            $data[1] = $result_beli * -1;
            $data[2] = $result_income;
            $data[3] = $result_outcome * -1;

            $no=1;
            $total = 0;

            for ($i=0; $i<count($data); $i++){
                $total+=$data[$i];
                $descript = "";
                if ($i==0){
                    $descript = "Total Penjualan";
                }else if ($i==1){
                    $descript = "Total Pembelian";
                }else if ($i==2){
                    $descript = "Pendapatan Lain-lain";
                }else if ($i==3){
                    $descript = "Pengeluaran";
                }              
                echo"<tr>";
                echo "<td>".$no."</td>";
                echo "<td style='font-size:13px;'>".$descript."</td>";
                if ($data[$i] < 0) {
                    $data[$i] = $data[$i]*-1;
                    echo "<td style='color:#FF0000;font-size:14px;text-align:right;'>".number_format($data[$i])."</td>";
                }else{
                    echo "<td style='color:#008000;font-size:14px;text-align:right;'>".number_format($data[$i])."</td>";
                }
                $no++;
            }
            echo "<tr>";
            echo "<td colspan='2' style='text-align:center; font-size:14px'><b>Total</b></td>";

            if ($total > 0) {            
                echo "<td colspan='2' style='color:#008000;text-align:right; font-size:14px'><b>".number_format($total)."</b></td>";
            }else{
                echo "<td colspan='2' style='color:#FF0000;text-align:right; font-size:14px'><b>".number_format($total)."</b></td>";
            }
            // echo "<td colspan='2' style='text-align:right; font-size:14px'><b>".number_format($total)."</b></td>";
        }else{
            echo "Halaman tidak ditemukan";
        } 
    }

    function get_data_customer(){
        if($this->session->userdata('akses')=='1'){
            $filter=$this->input->post('filter');
            $result_jual=$this->M_laba_rugi->get_data_jual_customer($filter);
            $result_beli=$this->M_laba_rugi->get_data_beli($filter);
            $result_income=$this->M_laba_rugi->get_data_income($filter);
            $result_outcome=$this->M_laba_rugi->get_data_outcome($filter);

            $no=1;
            $total = 0;

            foreach($result_jual as $value){  
                $data = $this->db->get_where('tbl_customer', array('customer_id'=>$value['jual_customer']))->row();
                if(!empty($data)){
                echo"<tr>";
                echo "<td>".$no."</td>";
                echo "<td style='font-size:13px;'>".$data->customer_name."</td>";
                echo "<td style='color:#008000;font-size:14px;text-align:right;'>".number_format($value['total_jual'])."</td>";
                echo "<tr>";   
                $no++;
                }
            }

        }else{
            echo "Halaman tidak ditemukan";
        } 
    }
}