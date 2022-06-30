<?php
class Notification extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            // $url=base_url();
            $url = 'Administrator';
            redirect($url);
        };
        $this->load->model('M_barang');
        $this->load->model('M_sales_audit');
    }
    
	function show_notif(){
        $data = $this->M_barang->notif_stok_min();
        $count = count($data);
        $output = '';
        if ($count > 0){
            foreach($data as $row){
                $output .= '
                    <li>
                        <a href="#">
                            <strong>'.$row->barang_id.'</strong><br/>
                            <small><em>'.$row->barang_nama.' --- '.'<b>'.$row->barang_stok.'</b>'.'</em></small>
                        </a>
                    </li>
                    <li class="divider"></li>
                ';
            }
        }else{
            $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
        }
        
        $data = array(
            'notification'   => $output,
            'unseen_notification' => $count
           );
        echo json_encode($data);
    }

    function show_faktur(){
        $data = $this->M_sales_audit->show_faktur();
        $count = count($data);
        // echo $count;
        $output = '';
        $int = 1;
        if ($count > 0){
            foreach($data as $row){
                $output .= '
                    <li>
                        <a>
                            <strong>'.$row->jual_nofak.'</strong><br/>
                            <small><em>'.$row->customer_name.' - '.$row->jual_tanggal.'</em></small>
                        </a>
                    </li>
                    <li class="divider"></li>
                ';
                if ($int == 7){
                    $cont = base_url()."admin/Faktur_tempo";
                    $output .= '<li>
                        <a style="color:blue;" href="'.$cont.'">
                            <strong><small><em>Load more...</em></small></strong>
                        </a>
                    </li>
                    <li class="divider"></li>';
                break;
                }
                $int++;
            }
        }else{
            $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
        }
        
        $data = array(
            'notification'   => $output,
            'unseen_notification' => $count
           );        
        echo json_encode($data);
    }
}