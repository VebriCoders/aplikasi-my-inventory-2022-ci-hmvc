<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        // model
        $this->load->model('M_Template');

        //Cek Apakah Sudah Login?
        if ($this->session->userdata('is_login') == false) {
            redirect('login');
        }
    }


    public function index()
    {
        $data['title'] = 'Template';
        $this->load->view('index', $data);
    }

    public function AdminTemplate($data)
    {
        $this->load->view('v_admin_template', $data);
    }
}
