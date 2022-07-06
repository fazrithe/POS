<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    public function index() {
        $data['title'] = 'Backup database';
        $data['description'] = 'Menyimpan dan mendownload file sql database secara otomatis';
        $this->load->view('admin/v_backup', $data);
    }

    public function backup_database() {
        date_default_timezone_set("Asia/Jakarta");
        $this->load->dbutil();
        $conf = [
            'format' => 'zip',
            'filename' => 'backup_db.sql'
        ];
    
        $backup = $this->dbutil->backup($conf);
        $db_name = 'backup_db' . date("d-m-Y_H-i-s") . '.zip';
        $save = APPPATH . 'database_backup/' . $db_name;
    
        $this->load->helper('file');
        write_file($save, $backup);
    
        $this->load->helper('download');
        force_download($db_name, $backup);
    }

    public function restore_database() {
        
        $this->load->helper('file');
        // $this->load->model('sismas_m');
        $config['upload_path']="./assets/database/";
        $config['allowed_types']="jpg|png|gif|jpeg|bmp|sql|x-sql";
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        $data = $this->upload->do_upload("datafile");
        if(!$this->upload->do_upload("datafile")){
            $isi_file = file_get_contents($data);
            $string_query = rtrim( $isi_file, "\n;" );
            $array_query = explode(";", $string_query);
            foreach($array_query as $query)
            {
              $this->db->query($query);
            }
        }
    }
}