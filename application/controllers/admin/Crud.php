<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	public $validation_for = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('datatables');// Load Library Ignited-Datatables        
        $this->load->model('crud_model','m_barang');
		$this->load->model('m_barang','m_barang1');
        // echo "a";
        $this->load->helper('form');
		$this->load->library('form_validation');        
    }

	public function index()
	{		
        // echo base_url();
		// print_r(base_url());
		$this->load->view('admin/crud_view');
	}

	function get_guest_json(){ //data data produk by JSON object
		// print_r("ss");
		header('Content-Type: application/json');
		echo $this->m_barang->get_all_barang();
        // die();
	}

	function getKategori(){        
		header('Content-Type: application/json');
		echo json_encode($this->m_barang->get_kategori());
	}

	function tambah_barang(){
		// if($this->session->userdata('akses')=='1'){
			$kobar=$this->m_barang1->get_kobar();			
			// $nabar=$this->input->post('nabar');
			$barang_nama= $this->input->post('barang_nama');
			print_r($kobar,$barang_nama);
		// 	$kat=$this->input->post('kategori');
		// 	$satuan=$this->input->post('satuan');
		// 	$harpok=str_replace(',', '', $this->input->post('harpok'));
		// 	$harjul=str_replace(',', '', $this->input->post('harjul'));		
		// 	$harjul_grosir=str_replace(',', '', $this->input->post('harjul_grosir'));
		// 	$harjul_grosir_umum=str_replace(',', '', $this->input->post('harjul_grosir_umum'));
		// 	$diskon_1=str_replace(',', '', $this->input->post('diskon_1'));
		// 	$diskon_2=str_replace(',', '', $this->input->post('diskon_2'));
		// 	$diskon_3=str_replace(',', '', $this->input->post('diskon_3'));
		// 	$stok=$this->input->post('stok');
		// 	$min_stok=$this->input->post('min_stok');
		// 	if ($diskon_1 == ""){
		// 		$diskon_1 = 0;
		// 	};
		// 	if ($diskon_2 == ""){
		// 		$diskon_2 = 0;
		// 	};
		// 	if ($diskon_3 == ""){
		// 		$diskon_3 = 0;
		// 	};
		// 	if ($harjul == ""){
		// 		$harjul = 0;
		// 	}
		// 	if ($harjul_grosir == ""){
		// 		$harjul_grosir = 0;
		// 	}
		// 	if ($harjul_grosir_umum == ""){
		// 		$harjul_grosir_umum = 0;
		// 	}
	
		// 	$this->M_barang->simpan_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$stok,$min_stok,$diskon_1,$diskon_2,$diskon_3,$harjul_grosir,$harjul_grosir_umum);
		// 	echo $this->session->set_flashdata('msg','<label class="label label-success">Data barang Berhasil ditambahkan</label>');			
		// 	redirect('admin/Barang');
		// // }else{
		// 	echo "Halaman tidak ditemukan";
		// }
	}

	public function edit($id)
	{
		// print_r($id);die();
		header('Content-Type: application/json');
		echo json_encode($this->m_barang->get_by_id($id));
	}

	public function delete($id)
	{
		$this->db->where('barang_id',$id);
		$this->db->delete('tbl_barang');
	}

	public function add()
	{
		$this->validation_for = 'add';
        $data = array();
		$data['status'] = TRUE;

		$cek = $this->input->post('barang_nama');

		// print_r($cek);
		// die();

		$this->_validate();
		// print

        if ($this->form_validation->run() == FALSE)
        {					
            $errors = array(				
                'barang_nama' 	=> form_error('barang_nama'),
                'barang_kategori_id'=> form_error('kategori'),
				'barang_satuan' => form_error('satuan'),
                'barang_stok' 		=> form_error('stok'),
				'barang_harpok'	=> form_error('harpok'),
				'barang_harjul'	=> form_error('eceran'),
				'barang_harjul_grosir'	=> form_error('grosir'),
				'barang_harjul_grosir_umum'	=> form_error('grosir_umum'),
				'barang_min_stok'	=> form_error('minstok'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );			
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }else{			
            $insert = array(
		// 		$kobar=$this->M_barang->get_kobar();
		// $nabar=$this->input->post('nabar');
		// $kat=$this->input->post('kategori');
		// $satuan=$this->input->post('satuan');
		// $harpok=str_replace(',', '', $this->input->post('harpok'));
		// $harjul=str_replace(',', '', $this->input->post('harjul'));		
		// $harjul_grosir=str_replace(',', '', $this->input->post('harjul_grosir'));
		// $harjul_grosir_umum=str_replace(',', '', $this->input->post('harjul_grosir_umum'));
		// $diskon_1=str_replace(',', '', $this->input->post('diskon_1'));
		// $diskon_2=str_replace(',', '', $this->input->post('diskon_2'));
		// $diskon_3=str_replace(',', '', $this->input->post('diskon_3'));

					'barang_id' 				=> $this->m_barang1->get_kobar(),
					'barang_nama'				=> $this->input->post('barang_nama'),
					'barang_kategori_id' 		=> $this->input->post('kategori'),
					'barang_satuan'				=> $this->input->post('satuan'),
					'barang_stok' 				=> str_replace(',', '', $this->input->post('stok')),
					'barang_harpok'				=> str_replace(',', '', $this->input->post('harpok')),
					'barang_harjul'				=> str_replace(',', '', $this->input->post('eceran')),
					'barang_harjul_grosir'		=> str_replace(',', '', $this->input->post('grosir')),
					'barang_harjul_grosir_umum'	=> str_replace(',', '', $this->input->post('grosir_umum')),
					'barang_min_stok'			=> str_replace(',', '', $this->input->post('minstok')),
				);			
			$this->db->insert('tbl_barang', $insert);
            $data['status'] = TRUE;
			// print_r($insert);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
	}

	public function update()
	{
		$this->validation_for = 'update';
		$data = array();
		$data['status'] = TRUE;

		$this->_validate();

        if ($this->form_validation->run() == FALSE){
			$errors = array(
				'barang_nama' 	=> form_error('barang_nama'),
                'barang_kategori_id'=> form_error('kategori'),
				'barang_satuan' => form_error('satuan'),
                'barang_stok' 		=> form_error('stok'),
				'barang_harpok'	=> form_error('harpok'),
				'barang_harjul'	=> form_error('eceran'),
				'barang_harjul_grosir'	=> form_error('grosir'),
				'barang_harjul_grosir_umum'	=> form_error('grosir_umum'),
				'barang_min_stok'	=> form_error('minstok'),

                // 'barang_nama' 	=> form_error('barang_nama'),
                // 'kategori' 		=> form_error('kategori'),
				// 'barang_satuan'	=> form_error('barang_satuan'),
                // 'stok' 		=> form_error('stok'),
				// 'barang_harpok' 		=> form_error('barang_harpok'),
				// 'barang_harjul' 		=> form_error('barang_harjul'),
				// 'barang_harjul_grosir' 		=> form_error('barang_harjul_grosir'),
				// 'barang_harjul_grosir_umum' => form_error('barang_harjul_grosir_umum'),
				// 'barang_min_stok' => form_error('barang_min_stok'),
			);
            $data = array(
                'status' 		=> FALSE,
				'errors' 		=> $errors
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}else{
			$update = array(				
					'barang_nama'				=> $this->input->post('barang_nama'),
					'barang_kategori_id' 		=> $this->input->post('kategori'),
					'barang_satuan'				=> $this->input->post('satuan'),
					'barang_stok' 				=> str_replace(',', '', $this->input->post('stok')),
					'barang_harpok'				=> str_replace(',', '', $this->input->post('harpok')),
					'barang_harjul'				=> str_replace(',', '', $this->input->post('eceran')),
					'barang_harjul_grosir'		=> str_replace(',', '', $this->input->post('grosir')),
					'barang_harjul_grosir_umum'	=> str_replace(',', '', $this->input->post('grosir_umum')),
					'barang_min_stok'			=> str_replace(',', '', $this->input->post('minstok')),

					// 'nama_barang'	=> $this->input->post('nama_barang'),
					// 'kategori_id' 	=> $this->input->post('kategori'),
					// 'barang_satuan' => $this->input->post('barang_satuan'),
					// 'stok' 			=> $this->input->post('stok'),
					// 'barang_harpok' 			=> $this->input->post('barang_harpok'),
					// 'barang_harjul' 			=> $this->input->post('barang_harjul'),
					// 'barang_harjul' 			=> $this->input->post('barang_harjul_grosir'),
					// 'barang_harjul_grosir_umum'	=> $this->input->post('barang_harjul_grosir_umum'),
					// 'barang_min_stok'	=> $this->input->post('barang_min_stok')
				);
			$this->db->where('barang_id', $this->input->post('id'));
			$this->db->update('tbl_barang', $update);
			$data['status'] = TRUE;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	private function _validate()
	{
		$this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('barang_nama', 'Nama Barang', 'trim|required|min_length[2]|max_length[30]');
        $this->form_validation->set_rules('kategori', 'Kategori Barang', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
		// $this->form_validation->set_rules('harpok', 'Harga Pokok', 'trim|required|numeric');
		// $this->form_validation->set_rules('eceran', 'Hrg Jual Eceran', 'trim|required|numeric');
		// $this->form_validation->set_rules('grosir', 'Hrg Jual Grosir', 'trim|required|numeric');
		// $this->form_validation->set_rules('grosir_umum', 'Hrg Jual Grosir Umum', 'trim|required|numeric');
		// $this->form_validation->set_rules('minstok', 'Minimal Stok', 'trim|required|numeric');
        // $this->form_validation->set_rules('stok', 'stok', 'trim|required|numeric');
	}

}