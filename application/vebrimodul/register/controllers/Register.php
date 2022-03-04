<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        // model
        $this->load->model('M_Register');
    }


    public function index()
    {
        $logged = $this->session->userdata('is_login');

        if ($logged != true) {
            $data['title'] = "Register - " . $this->M_Setting->tampilNamaWebsite()['isi_setting'];
            $this->load->view('v_register', $data);
        } else {
            // print_r($this->session->userdata());
            redirect('dashboard');
        }
    }

    public function proses()
    {
        //Cek Email Apakah Sudah Terdaftar Apa Belum
        $cekemail = $this->input->post('email');
        $sql = $this->db->query("SELECT email FROM tbl_user where email='$cekemail'");
        $cekemail = $sql->num_rows();

        //Cek Password 1 & 2
        $pswd1 = $this->input->post('password1');
        $pswd2 = $this->input->post('password2');
        if ($pswd1 != $pswd2) {
            $cekpswd = false;
        } else {
            $cekpswd = true;
        }

        if ($cekemail > 0) {
            //Jika Email Yang Di Masukkan Sudah Ada User Akan Di Arahkan Ke Halaman Register Lagi
            $this->session->set_flashdata('message', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Email Sudah Terdaftar!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');

            $data['title'] = "Register - " . $this->M_Setting->tampilNamaWebsite()['isi_setting'];
            $this->load->view('v_register', $data);
        } else if ($cekpswd == false) {
            //Jika Password Tidak Sama Akan Di Arahkan Ke Halaman Register Lagi
            $this->session->set_flashdata('message', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Password Tidak Sama!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');

            $data['title'] = "Register - " . $this->M_Setting->tampilNamaWebsite()['isi_setting'];
            $this->load->view('v_register', $data);
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email', true);

            //Data User
            $data = [
                'name' => $name,
                'email' => $email,
                'image' => "default.jpg",
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2, // 1 admin 2 panitia (harap modif jika beda project)
                'is_active' => 0,
                'date_created' => time(),
            ];
            $this->db->insert('tbl_user', $data);

            // Token User
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'id' => uniqid(),
                'email' => $email,
                'token' => $token,
                'date_created' => time(),
            ];
            $this->db->insert('tbl_user_token', $user_token);

            //Kirim Email Aktifikasi
            $this->_sendEmail($email, $token, 'verify');

            echo "anjay";
            $this->session->set_flashdata('message', ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Anda Sudah Terdaftar!</strong> Silahkan Cek Inbox Email Kamu.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('login');
        }
    }

    private function _sendEmail($email, $token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'pradanaindustries.project@gmail.com',
            'smtp_pass' => 'PindusProjectBaru**PastiBaru2234',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('pradanaindustries.project@gmail.com', 'PINDUS PROJECT EMAIL AUTHENTICATION');
        $this->email->to($email);

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify you account : <a href="' . base_url() . 'login/verify?email=' . $email . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'forgot_password/proses?email=' . $email . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
}
