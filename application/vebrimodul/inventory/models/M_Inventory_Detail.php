<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Inventory_Detail extends CI_Model
{

    private $_table_inventory = "tbl_inventory";
    private $_table_inventory_detail = "tbl_inventory_barang";

    public function getById($id)
    {
        return $this->db->get_where($this->_table_inventory_detail, ["id" => $id])->row();
    }

    function getDataInventory($slug_data)
    {
        return $this->db->get_where($this->_table_inventory, ["slug" => $slug_data])->row();
    }

    function tampilData_Detail($id_inventory)
    {
        $this->db->select('tbl_inventory_barang.*, ')
            ->from('tbl_inventory_barang')
            ->where('tbl_inventory_barang.id_inventory', $id_inventory)
            ->order_by('tbl_inventory_barang.id', 'DESC');
        return $this->db->get();
    }

    function Tambah_Barang()
    {
        //Menghapus Titik Pada Harga (Semua Karakter Kec Angka)
        $result_harga = preg_replace("/[^0-9]/", "", $this->input->post('harga'));

        //Mengkalikan Harga Dan Jumlah Untuk Total
        $result_total = $result_harga * $this->input->post('jumlah');

        $data = [
            'id_inventory' => $this->input->post('id_inventory'),
            'barang' => $this->input->post('barang'),
            'nama_barang' => $this->input->post('nama_barang'),
            'harga' => $result_harga,
            'jumlah' => $this->input->post('jumlah'),
            'total' => $result_total,
            'deskripsi' => $this->input->post('deskripsi'),
            'external_link' => $this->input->post('external_link'),
            'images' => $this->_uploadImageBarang(),
            'created_on' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert($this->_table_inventory_detail, $data);
    }

    function Edit_Barang()
    {
        //Menghapus Titik Pada Harga (Semua Karakter Kec Angka)
        $result_harga = preg_replace("/[^0-9]/", "", $this->input->post('harga'));

        //Mengkalikan Harga Dan Jumlah Untuk Total
        $result_total = $result_harga * $this->input->post('jumlah');

        if (!empty($_FILES["images"]["name"])) {

            $nm_images = $this->input->post('images_lama');
            $this->_deleteImageLamaBarang($nm_images);

            $data = [
                'barang' => $this->input->post('barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'harga' => $result_harga,
                'jumlah' => $this->input->post('jumlah'),
                'total' => $result_total,
                'deskripsi' => $this->input->post('deskripsi'),
                'external_link' => $this->input->post('external_link'),
                'images' => $this->_uploadImageBarang(),
                'update_at' => date('Y-m-d H:i:s'),
            ];
        } else {
            $data = [
                'barang' => $this->input->post('barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'harga' => $result_harga,
                'jumlah' => $this->input->post('jumlah'),
                'total' => $result_total,
                'deskripsi' => $this->input->post('deskripsi'),
                'external_link' => $this->input->post('external_link'),
                'update_at' => date('Y-m-d H:i:s'),
            ];
        }
        $this->db->where('id', $this->input->post('query_id'))->update($this->_table_inventory_detail, $data);
    }

    function Hapus_Barang($id)
    {
        $this->_deleteImageBarang($id);
        $this->db->where('id', $id)->delete($this->_table_inventory_detail);
    }

    private function _uploadImageBarang()
    {
        $config['upload_path']          = 'assets/upload/images/data_barang_inventory/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = "PHOTO_BARANG_INVENTORY_" . $this->input->post('slug_inventory') . "_" . time();
        $config['overwrite']            = true;
        $config['max_size']             = 5120; // 5MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('images')) {
            return $this->upload->data("file_name");
        }

        return "default.jpg";
    }

    private function _deleteImageLamaBarang($nm_images)
    {
        if ($nm_images != "default.jpg") {
            $filename = explode(".", $nm_images)[0];
            return array_map('unlink', glob(FCPATH . "assets/upload/images/data_barang_inventory/$filename.*"));
        }
    }

    private function _deleteImageBarang($id)
    {
        $data_foto = $this->getById($id);
        if ($data_foto->images != "default.jpg") {
            $filename = explode(".", $data_foto->images)[0];
            return array_map('unlink', glob(FCPATH . "assets/upload/images/data_barang_inventory/$filename.*"));
        }
    }

    public function hitungJumlahBarang($id_inventory)
    {
        $query = $this->db->where('id_inventory', $id_inventory)->get('tbl_inventory_barang');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function hitungJumlahBarangHarga($id_inventory)
    {
        $this->db->select_sum('total');
        $query = $this->db->where('id_inventory', $id_inventory)->get('tbl_inventory_barang');
        if ($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return 0;
        }
    }

    public function hitungJumlahBarangTotal($id_inventory)
    {
        $this->db->select_sum('jumlah');
        $query = $this->db->where('id_inventory', $id_inventory)->get('tbl_inventory_barang');
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah;
        } else {
            return 0;
        }
    }
}
