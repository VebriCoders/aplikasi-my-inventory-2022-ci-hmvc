<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Dashboard extends CI_Model
{
    public function hitungJumlahInventory()
    {
        $query = $this->db->get('tbl_inventory');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function hitungJumlahBarang()
    {
        $query = $this->db->get('tbl_inventory_barang');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function hitungJumlahBarangTotal()
    {
        $this->db->select_sum('jumlah');
        $query = $this->db->get('tbl_inventory_barang');
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah;
        } else {
            return 0;
        }
    }

    public function hitungJumlahBarangTotalHarga()
    {
        $this->db->select_sum('total');
        $query = $this->db->get('tbl_inventory_barang');
        if ($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return 0;
        }
    }
}
