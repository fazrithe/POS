<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {
    public function get_kategori(){
        $result = $this->db->get('kategori');        
        return $result->result();
    }
    // public function get_all_barang() {
    //     $this->datatables->select('id_barang, nama_barang, stok, id_kategori, kategori_barang');
    //     $this->datatables->from('data_barang');
    //     $this->datatables->join('kategori', 'kategori_id=id_kategori');
    //     $this->datatables->add_column('view', '<button type="button" onclick="edit_barang($1)" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</button>  <button onclick="hapus_barang($1)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>','id_barang,nama_barang,stok,id_kategori,kategori_barang');
    //     return $this->datatables->generate();
    // }

    public function get_all_barang() {
        $this->datatables->select('barang_id,barang_nama,barang_satuan,barang_stok,barang_harpok,barang_harjul,barang_harjul_grosir,barang_harjul_grosir_umum,barang_min_stok,barang_kategori_id,kategori_barang');
        // print_r($a);
        $this->datatables->from('tbl_barang');
        $this->datatables->join('kategori', 'id_kategori=barang_kategori_id');
        $this->datatables->add_column('view', '<button type="button" onclick="edit_barang(`$1`)" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</button>  <button onclick="hapus_barang(`$1`)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>','barang_id,barang_nama,barang_satuan,barang_stok,barang_harpok,barang_harjul,barang_harjul_grosir,barang_harjul_grosir_umum,barang_min_stok,barang_kategori_id,kategori_barang');
        return $this->datatables->generate();
    }
    

    // public function get_all_barang() {
    //     $this->datatables->select('id_barang, nama_barang, stok, id_kategori, kategori_barang');
    //     $this->datatables->from('data_barang');
    //     $this->datatables->join('kategori', 'ang() {
    //     $this->datatables->select('id_barang, nama_barang, stok, id_kategori, kategori_barang');
    //     $this->datatables->from('data_barang');
    //     $this->datatables->join('kategori', 'kategori_id=id_kategori');
    //     $this->datatables->add_column('view', '<button type="button" onclick="edit_barang($1)" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</button>  <button onclick="hapus_barang($1)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>','id_barang,nama_barang,stok,id_kategori,kategori_barang');
    //     return $this->datatables->generate();
    // }kategori_id=id_kategori');
    //     $this->datatables->add_column('view', '<button type="button" onclick="edit_barang($1)" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</button>  <button onclick="hapus_barang($1)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>','id_barang,nama_barang,stok,id_kategori,kategori_barang');
    //     return $this->datatables->generate();
    // }

    
    public function get_by_id($id)
	{
        // print_r($id);
        $this->db->select('barang_id,barang_nama,barang_satuan,barang_stok,barang_harpok,barang_harjul,barang_harjul_grosir,barang_harjul_grosir_umum,barang_min_stok,barang_kategori_id');
		$this->db->from('tbl_barang');
		$this->db->where('barang_id',$id);
        // print_r($this->db);die();
		$query = $this->db->get();
        // print_r($query->row());die();
		return $query->row();
	}
}