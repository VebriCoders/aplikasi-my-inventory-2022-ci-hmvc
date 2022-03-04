<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Setting extends CI_Model
{
    private $_table = "tbl_setting";

    function tampilNamaWebsite()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('tbl_setting.nama_setting', 'nama-aplikasi');
        $query = $this->db->get();
        return $query->row_array();
    }

    function tampilLogoWebsite()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('tbl_setting.nama_setting', 'logo-aplikasi');
        $query = $this->db->get();
        return $query->row_array();
    }

    function tampilEmailWebsite()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('tbl_setting.nama_setting', 'email-aplikasi');
        $query = $this->db->get();
        return $query->row_array();
    }

    function tampilPswdEmailWebsite()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('tbl_setting.nama_setting', 'password-email-aplikasi');
        $query = $this->db->get();
        return $query->row_array();
    }

    function Edit_Setting($data_setting)
    {
        if ($data_setting == 'nama-aplikasi') {
            $data = array(
                'isi_setting' => $this->input->post('isi_setting'),
            );
            $this->db->where('nama_setting', $data_setting)->update($this->_table, $data);
        } else if ($data_setting == 'logo-aplikasi') {
            if (!empty($_FILES["isi_setting"]["name"])) {
                $data = [
                    'isi_setting' => $this->_uploadImage(),
                ];
            }
            $this->db->where('nama_setting', $data_setting)->update($this->_table, $data);
        } else if ($data_setting == 'email-aplikasi') {
            $data = array(
                'isi_setting' => $this->input->post('isi_setting'),
            );
            $this->db->where('nama_setting', $data_setting)->update($this->_table, $data);
        } else if ($data_setting == 'password-email-aplikasi') {
            $data = array(
                'isi_setting' => $this->input->post('isi_setting'),
            );
            $this->db->where('nama_setting', $data_setting)->update($this->_table, $data);
        }
    }

    private function _uploadImage()
    {
        $config['upload_path']          = 'assets/img/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = "LogoWebsite_" . time();
        $config['overwrite']            = true;
        $config['max_size']             = 5120; // 5MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('isi_setting')) {
            return $this->upload->data("file_name");
        }

        return "image-upload-default.png";
    }
}
