<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_management extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        // model
        $this->load->model('M_User_management');

        //Cek Apakah Sudah Login?
        if ($this->session->userdata('is_login') == false) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = array(
            'namamodule'        => "user_management",
            'namafileview'      => "v_user_management",
            'title'             => "User Management",
            'tampilData'        => $this->M_User_management->tampilData(),
        );
        echo Modules::run('template/AdminTemplate', $data);
    }

    public function Tambah()
    {
        $this->M_User_management->Tambah();
        // $this->session->set_flashdata('simpan-data', 'simpan_data();');

        redirect('user_management');
    }

    public function Edit()
    {
        $this->M_User_management->Edit();
        // $this->session->set_flashdata('simpan-data', 'simpan_data();');

        redirect('user_management');
    }

    public function Edit_password()
    {

        $password_1 = $this->input->post('password_baru');
        $password_2 = $this->input->post('konfirmasi_password_baru');

        if ($password_1 != $password_2) {
            $this->session->set_flashdata('edit-profile', ' <div class="alert alert-danger">
                <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                <strong>Error!</strong> Password Tidak Sama Dengan Konfirmasi Password.
            </div>');
        } else {
            $this->M_User_management->Edit_password($password_2);
            // $this->session->set_flashdata('simpan-data', 'simpan_data();');
        }

        redirect('user_management');
    }

    public function Hapus($id)
    {
        $this->M_User_management->Hapus($id);
        // $this->session->set_flashdata('simpan-data', 'simpan_data();');

        redirect('user_management');
    }
}
