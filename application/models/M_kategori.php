<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kategori extends CI_Model
{
    public function data_ventela()
    {
        return $this->db->get_where("menu", array('kat' => 'Ventela'));
    }
    public function data_jhonson()
    {
        return $this->db->get_where("menu", array('kat' => 'Jhonson'));
    }
    public function data_brodo()
    {
        return $this->db->get_where("menu", array('kat' => 'Brodo'));
    }
}
