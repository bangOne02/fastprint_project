<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->database();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['produk'] = $this->Produk_model->get_produk_bisa_dijual();
        $this->load->view('produk/index', $data);
    }

    public function tambah()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('produk/form');
        } else {
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'kategori_id' => $this->input->post('kategori_id'),
                'status_id' => $this->input->post('status_id')
            ];
            $this->Produk_model->insert($data);
            redirect('produk');
        }
    }

    public function edit($id)
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $data['produk'] = $this->Produk_model->get_by_id($id);
            $this->load->view('produk/form', $data);
        } else {
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'kategori_id' => $this->input->post('kategori_id'),
                'status_id' => $this->input->post('status_id')
            ];
            $this->Produk_model->update($id, $data);
            redirect('produk');
        }
    }

    public function hapus($id)
    {
        $this->Produk_model->delete($id);
        redirect('produk');
    }

    private function _rules()
    {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
    }


    public function fetch_api(){
         $url = "https://recruitment.fastprint.co.id/tes/api_tes_programmer";

        // username dari soal
        $username = "tesprogrammer010226C13";

        // password sesuai aturan
        $password_plain = "bisacoding-01-02-26";
        $password = md5($password_plain);

        $postData = [
            'username' => $username,
            'password' => $password
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        // DEBUG jika gagal
        if(isset($data['error'])){
            echo $data['ket'];
            echo "<br>Password digunakan: ".$password_plain;
            return;
        }

        // SIMPAN KE DATABASE
        foreach($data as $item){

            $kategori = $this->produk->get_kategori($item['kategori']);
            if(!$kategori){
                $this->db->insert('kategori',['nama_kategori'=>$item['kategori']]);
                $kategori_id = $this->db->insert_id();
            }else{
                $kategori_id = $kategori->id_kategori;
            }

            $status = $this->produk->get_status($item['status']);
            if(!$status){
                $this->db->insert('status',['nama_status'=>$item['status']]);
                $status_id = $this->db->insert_id();
            }else{
                $status_id = $status->id_status;
            }

            $this->db->insert('produk',[
                'nama_produk' => $item['nama_produk'],
                'harga'       => $item['harga'],
                'kategori_id' => $kategori_id,
                'status_id'   => $status_id
            ]);
        }

        echo "✅ Data produk berhasil diambil & disimpan";
    }
}
