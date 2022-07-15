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
        
        $url = base_url('admin/Backup/restore_database');
        include_once APPPATH . "./libraries/google-api-php-client/src/Google/client.php";
        include_once APPPATH . "./libraries/google-api-php-client/src/Google/Service/Drive.php";
       
    }
}