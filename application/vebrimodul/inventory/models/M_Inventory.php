<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Inventory extends CI_Model
{
    private $_table_inventory = "tbl_inventory";
    private $_table_inventory_detail = "tbl_inventory_barang";

    public function getById($id)
    {
        return $this->db->get_where($this->_table_inventory, ["id" => $id])->row();
    }

    function tampilDataPagination_Inventory($limit, $start)
    {
        return $this->db->order_by('tbl_inventory.id', 'DESC')->get($this->_table_inventory, $limit, $start)->result_array();
    }

    function jumlahDataInventory()
    {
        return $this->db->get($this->_table_inventory)->num_rows();
    }

    function tampilData_Inventory()
    {
        $this->db->select('tbl_inventory.*, ')
            ->from('tbl_inventory')
            ->order_by('tbl_inventory.id', 'DESC');
        return $this->db->get();
    }

    function Tambah()
    {
        //Nama File Custom Slug Model
        $file_name_sustom = $this->input->post('nama_inventory');
        $file_name_sustom = str_replace(array('[\', \']'), '', $file_name_sustom);
        $file_name_sustom = preg_replace('/\[.*\]/U', '', $file_name_sustom);
        $file_name_sustom = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $file_name_sustom);
        $file_name_sustom = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $file_name_sustom);
        $hasil_custom_slug = strtolower(trim($file_name_sustom, '-'));

        $data = [
            'slug' => $hasil_custom_slug,
            'nama_inventory' => $this->input->post('nama_inventory'),
            'kebutuhan' => $this->input->post('kebutuhan'),
            'deskripsi' => $this->input->post('deskripsi'),
            'images' => $this->_uploadImage(),
            'status' => $this->input->post('status'),
            'created_on' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert($this->_table_inventory, $data);
    }

    function Edit()
    {

        //Nama File Custom Slug Model
        $file_name_sustom = $this->input->post('nama_inventory');
        $file_name_sustom = str_replace(array('[\', \']'), '', $file_name_sustom);
        $file_name_sustom = preg_replace('/\[.*\]/U', '', $file_name_sustom);
        $file_name_sustom = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $file_name_sustom);
        $file_name_sustom = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $file_name_sustom);
        $hasil_custom_slug = strtolower(trim($file_name_sustom, '-'));

        if (!empty($_FILES["images"]["name"])) {

            $nm_images = $this->input->post('images_lama');
            $this->_deleteImageLama($nm_images);

            $data = [
                'slug' => $hasil_custom_slug,
                'nama_inventory' => $this->input->post('nama_inventory'),
                'kebutuhan' => $this->input->post('kebutuhan'),
                'deskripsi' => $this->input->post('deskripsi'),
                'images' => $this->_uploadImage(),
                'status' => $this->input->post('status'),
                'update_at' => date('Y-m-d H:i:s'),
            ];
        } else {
            $data = [
                'slug' => $hasil_custom_slug,
                'nama_inventory' => $this->input->post('nama_inventory'),
                'kebutuhan' => $this->input->post('kebutuhan'),
                'deskripsi' => $this->input->post('deskripsi'),
                'status' => $this->input->post('status'),
                'update_at' => date('Y-m-d H:i:s'),
            ];
        }
        $this->db->where('id', $this->input->post('query_id'))->update($this->_table_inventory, $data);
    }

    function Hapus($id)
    {
        $this->_deleteImage($id);

        $this->db->where('id', $id)->delete($this->_table_inventory);
        $this->db->where('id_inventory', $id)->delete($this->_table_inventory_detail);
    }

    private function _uploadImage()
    {
        $config['upload_path']          = 'assets/upload/images/inventory/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = "PHOTO_INVENTORY" . time();
        $config['overwrite']            = true;
        $config['max_size']             = 5120; // 5MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('images')) {
            return $this->upload->data("file_name");
        }

        return "default.jpg";
    }

    private function _deleteImageLama($nm_images)
    {
        if ($nm_images != "default.jpg") {
            $filename = explode(".", $nm_images)[0];
            return array_map('unlink', glob(FCPATH . "assets/upload/images/inventory/$filename.*"));
        }
    }

    private function _deleteImage($id)
    {
        $data_foto = $this->getById($id);
        if ($data_foto->images != "default.jpg") {
            $filename = explode(".", $data_foto->images)[0];
            return array_map('unlink', glob(FCPATH . "assets/upload/images/inventory/$filename.*"));
        }
    }
}
