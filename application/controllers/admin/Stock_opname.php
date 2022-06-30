<?php
class Stock_opname extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            // $url=base_url();
            $url = 'Administrator';
            redirect($url);
        };
        // $this->load->model('M_kategori');
        // $this->load->model('M_barang');
        // $this->load->model('M_penjualan');
        $this->load->model('M_stock_opname');
        $this->load->library('Barcode');
        $this->load->library('Excel');
    }

    function index()
    {
        if ($this->session->userdata('akses') == '1') {
            $this->load->view('admin/v_stock_opname');
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    function download_so()
    {
        if ($this->session->userdata('akses') == '1') {
            $data['data'] = $this->M_stock_opname->list_barang();
            $this->load->view('admin/v_so_excel', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
    }

    function upload_so()
    {
        $item = $this->M_stock_opname->get_item();
        if ($this->session->userdata('akses') == '1') {
            $result = $this->M_stock_opname->validasi_bulan();            
            if ((date('Y') >= $result['max_year']) && ((int)(date('m')) > $result['max_month'])) {                
                $path = 'upload_so/';
                require_once APPPATH . '/third_party/PHPExcel-1.8/Classes/PHPExcel.php';
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xls|xlsx|csv';
                $config['remove_spaces'] = TRUE;
                $config['max_size'] = '100000';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                // print_r("ss".$this->upload->do_upload('uploadFile'));die();
                if (!$this->upload->do_upload('uploadFile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }
                // print_r($error);die();

                if (empty($error)) {
                    // echo "masuk sini3";
                    if (!empty($data['upload_data']['file_name'])) {
                        $import_xls_file = $data['upload_data']['file_name'];
                    } else {
                        $import_xls_file = 0;
                    }
                    $inputFileName = $path . $import_xls_file;                    
                    try {
                        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFileName);
                        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                        $flag = true;
                        $i = 0;
                        
                        // print_r($allDataInSheet);die();
                        // print("<pre>".print_r($allDataInSheet,true)."</pre>");

                        // for($i=0)
                        foreach ($allDataInSheet as $value) {
                            if ($flag) {
                                $flag = false;
                                continue;
                            }                            
                            if ($i>1){
                                // print("<pre>".print_r($value).$i."</pre>");
                                $barang_stok = $item[$i]['barang_stok'];

                                $inserdata[$i]['barang_stok'] = $barang_stok;
                                $inserdata[$i]['barang_id'] = $value['B'];
                                $inserdata[$i]['barang_nama'] = $value['C'];
                                $inserdata[$i]['barang_satuan'] = $value['D'];
                                $inserdata[$i]['real_stok'] = $value['E'];
                                $inserdata[$i]['different_stok'] = $value['E'] - $barang_stok;
                                $inserdata[$i]['insert_user'] = $this->session->userdata('user');
                                $inserdata[$i]['update_user'] = $this->session->userdata('user');                                
                            }
                            $i++;                            
                        }

                        // die();
                        // print_r($inserdata);die();
                        // $data = $this->M_stock_opname->result_so();                                                              
                        $result = $this->db->insert_batch('tbl_history_so', $inserdata);
                        if ($result) {

                            // $this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');
                            // echo 'a';die();                            
                            echo '<script language="javascript">' .
                                'alert("Success! PROSES IMPORT BERHASIL, Data berhasil diimport!");' .
                                'setTimeout(function(){ window.location.href = "result_so"; }, 2000);' .
                                '</script>';
                            // echo "3";die();
                            return;
                        } else {
                            $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> ' . $this->upload->display_errors() . '</div>');
                        }
                    } catch (Exception $e) {
                        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' . $e->getMessage());
                    }
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> ' . $error['error'] . '</div>');
                }
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> Stock opname bulan ini sudah pernah dilakukan</div>');
            }
            redirect('admin/Stock_opname');
        }
    }

    function result_so()
    {
        if ($this->session->userdata('akses') == '1') {
            $data['data'] = $this->M_stock_opname->result_so();
            $this->load->view('admin/v_so_result', $data);
        } else {
            echo "Halaman tidak ditemukan";
        }
    }
}
