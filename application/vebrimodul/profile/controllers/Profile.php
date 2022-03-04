<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        // model
        $this->load->model('M_Profile');

        //Cek Apakah Sudah Login?
        if ($this->session->userdata('is_login') == false) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = array(
            'namamodule'     => "profile",
            'namafileview'     => "v_profile",
            'title'      => "Profile",
            'tampilData'        => $this->M_Profile->tampilData(),
        );
        echo Modules::run('template/AdminTemplate', $data);
    }

    public function Edit_profile()
    {
        $this->M_Profile->Edit_profile();
        $this->session->set_flashdata('edit-profile', '<div class="alert media alert-danger">
            <h4 class="alert-title">Profile Berhasil Di Simpan ! Saya Rekomendasikan Anda Untuk Login Ulang !</h4>
            <p class="alert-message">Silahkan Logi Ulang Untuk Experience Pengelolaan Data Dengan Baik, Klik Logout Dan Login Kembali Dengan Akun Anda !. <br>Jika Anda Merubah Email Atau Password Silahkan Login Dengan Perubahan Yang Sudah Anda Lakukan!.</p>
            <div class="mar-top">
                <a href=" ' . base_url('login/logout') . '" class="btn btn-dark">LOGOUT</a>
            </div>
        </div>');

        redirect('profile');
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
            $this->M_Profile->Edit_password($password_2);

            $this->session->set_flashdata('edit-profile', '<div class="alert media alert-danger">
                <h4 class="alert-title">Profile Berhasil Di Simpan ! Saya Rekomendasikan Anda Untuk Login Ulang !</h4>
                <p class="alert-message">Silahkan Logi Ulang Untuk Experience Pengelolaan Data Dengan Baik, Klik Logout Dan Login Kembali Dengan Akun Anda !. <br>Jika Anda Merubah Email Atau Password Silahkan Login Dengan Perubahan Yang Sudah Anda Lakukan!.</p>
                <div class="mar-top">
                    <a href=" ' . base_url('login/logout') . '" class="btn btn-dark">LOGOUT</a>
                </div>
            </div>');
        }

        redirect('profile');
    }
}
