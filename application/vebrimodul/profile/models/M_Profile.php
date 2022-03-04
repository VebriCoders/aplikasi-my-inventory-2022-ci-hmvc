<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Profile extends CI_Model
{
    private $_table = "tbl_user";

    function tampilData()
    {
        $this->db->select('tbl_user.*, ')
            ->from('tbl_user')
            ->where('tbl_user.email', $this->session->userdata('email'))
            ->order_by('tbl_user.id', 'DESC');
        return $this->db->get();
    }

    function Edit_profile()
    {
        if (!empty($_FILES["image"]["name"])) {

            $nm_image = $this->input->post('image_lama');
            $this->_deleteImageLama($nm_image);

            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'image' => $this->_uploadImage(),
            ];
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
            ];
        }
        $this->db->where('id', $this->input->post('query_id'))->update($this->_table, $data);
    }

    function Edit_password($password_2)
    {
        $data = [
            'password' => password_hash($password_2, PASSWORD_DEFAULT),
        ];

        $this->db->where('id', $this->input->post('query_id'))->update($this->_table, $data);
    }

    private function _uploadImage()
    {
        $config['upload_path']          = 'assets/upload/images/user_management/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = "PHOTO_USER_" . time();
        $config['overwrite']            = true;
        $config['max_size']             = 5120; // 5MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }

        return "default.jpg";
    }

    private function _deleteImageLama($nm_image)
    {
        if ($nm_image != "default.jpg") {
            $filename = explode(".", $nm_image)[0];
            return array_map('unlink', glob(FCPATH . "assets/upload/images/user_management/$filename.*"));
        }
    }
}
