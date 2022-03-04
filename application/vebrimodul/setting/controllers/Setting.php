<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        // model
        $this->load->model('M_Setting');

        //Cek Apakah Sudah Login?
        if ($this->session->userdata('is_login') == false) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = array(
            'namamodule'                => "setting",
            'namafileview'              => "v_setting",
            'title'                     => "Setting",
            //Variabel
            'tampilNamaWebsite'         => $this->M_Setting->tampilNamaWebsite(),
            'tampilLogoWebsite'         => $this->M_Setting->tampilLogoWebsite(),
            'tampilEmailWebsite'        => $this->M_Setting->tampilEmailWebsite(),
            'tampilPswdEmailWebsite'    => $this->M_Setting->tampilPswdEmailWebsite(),
        );
        echo Modules::run('template/AdminTemplate', $data);
    }

    function edit($data_setting)
    {
        $this->M_Setting->Edit_Setting($data_setting);
        redirect('setting');
    }
}
