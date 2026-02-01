<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    private $table = 'produk';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        return $this->db
                    ->where('id_produk', $id)
                    ->get($this->table)
                    ->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id_produk', $id)
                        ->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id_produk', $id)
                        ->delete($this->table);
    }

    public function get_produk_bisa_dijual()
    {
        $this->db->select('produk.*, kategori.nama_kategori, status.nama_status');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.kategori_id');
        $this->db->join('status', 'status.id_status = produk.status_id');
        $this->db->where('status.nama_status', 'bisa dijual');
        return $this->db->get()->result();
    }

    function get_kategori($nama){
        return $this->db->get_where('kategori', ['nama_kategori'=>$nama])->row();
    }

    function get_status($nama){
        return $this->db->get_where('status', ['nama_status'=>$nama])->row();
    }

    function insert_produk($data){
        $this->db->insert('produk', $data);
    }
}