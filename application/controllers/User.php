<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->M_menu->tampil_data()->result();
        $this->load->view('user/index', $data);
    }

    public function order($id)
    {
        $menu = $this->M_menu->find($id);
        $data = array(
            'id' => $menu->id,
            'qty' => 1,
            'price' => $menu->harga,
            'name' => $menu->nama_menu
        );
        $this->cart->insert($data);
        redirect('user/index');
    }
    public function detail_order()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('user/order', $data);
    }
    public  function hapus_order()
    {
        $this->cart->destroy();
        redirect('user/index');
    }
    public function bayar()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('user/bayar', $data);
    }
    public function proses_pesan()
    {
        $is_processed = $this->M_invoice->index();
        if ($is_processed) {
            $this->cart->destroy();
            $this->session->set_flashdata('message', '<div class="text-center align-middle alert
            alert-success">Pesanan Anda Sedang Diproses Mohon Ditunggu</div>');
            redirect('user/index');
        } else {
            echo "Maaf Pesanan Anda Gagal Diproses";
        }
    }
    public function detail($id)
    {
        $data['menu'] = $this->M_menu->detail_menu($id);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('user/detail', $data);
    }
    public function ventela()
    {
        $data['ventela'] = $this->M_kategori->data_ventela()->result();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('user/ventela', $data);
    }
    public function jhonson()
    {
        $data['jhonson'] = $this->M_kategori->data_jhonson()->result();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('user/jhonson', $data);
    }
    public function brodo()
    {
        $data['brodo'] = $this->M_kategori->data_brodo()->result();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('user/brodo', $data);
    }
}
