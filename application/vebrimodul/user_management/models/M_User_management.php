<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_User_management extends CI_Model
{
    private $_table = "tbl_user";

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    function tampilData()
    {
        $this->db->select('tbl_user.*, ')
            ->from('tbl_user')
            ->order_by('tbl_user.id', 'ASC');
        return $this->db->get();
    }

    function Tambah()
    {
        if (!empty($_FILES["image"]["name"])) {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role_id'),
                'image' => $this->_uploadImage(),
                'is_active' => $this->input->post('is_active'),
                'date_created' => date('Y-m-d H:i:s'),
            ];
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role_id'),
                'is_active' => $this->input->post('is_active'),
                'date_created' => date('Y-m-d H:i:s'),
            ];
        }
        $this->db->insert($this->_table, $data);
    }

    function Edit()
    {
        if (!empty($_FILES["image"]["name"])) {

            $nm_image = $this->input->post('image_lama');

            $this->_deleteImageLama($nm_image);

            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'role_id' => $this->input->post('role_id'),
                'image' => $this->_uploadImage(),
                'is_active' => $this->input->post('is_active'),
            ];
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'role_id' => $this->input->post('role_id'),
                'is_active' => $this->input->post('is_active'),
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

    function Hapus($id)
    {
        $this->_deleteImage($id);
        $this->db->where('id', $id)->delete($this->_table);
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

    private function _deleteImage($id)
    {
        $data_foto = $this->getById($id);
        if ($data_foto->image != "default.jpg") {
            $filename = explode(".", $data_foto->image)[0];
            return array_map('unlink', glob(FCPATH . "assets/upload/images/user_management/$filename.*"));
        }
    }
}
