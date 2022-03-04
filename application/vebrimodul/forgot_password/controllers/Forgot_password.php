<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgot_password extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        // model
        $this->load->model('M_Forgot_password');
    }


    public function index()
    {
        $logged = $this->session->userdata('is_login');

        if ($logged != true) {
            $data['title'] = "Forgot Password - " . $this->M_Setting->tampilNamaWebsite()['isi_setting'];
            $this->load->view('v_forgot_password', $data);
        } else {
            // print_r($this->session->userdata());
            redirect('dashboard');
        }
    }

    public function proses()
    {
        //Cek Email
        $cekemail = $this->input->post('email');
        $sql = $this->db->query("SELECT email FROM tbl_user where email='$cekemail'");
        $cekemail = $sql->num_rows();

        if ($cekemail != 1) {
            //Jika Email Yang Di Masukkan Belum Terdaftar Akan Di Arahkan Ke Halaman Forgot Password Lagi
            $this->session->set_flashdata('message', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Email Belum Terdaftar!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');

            $data['title'] = "Forgot Password - " . $this->M_Setting->tampilNamaWebsite()['isi_setting'];
            $this->load->view('v_forgot_password', $data);
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('tbl_user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('tbl_user_token', $user_token);
                $this->_sendEmail($email, $token, 'forgot');

                $this->session->set_flashdata('message', ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Cek Inbox Email Kamu Untuk Reset Password!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('forgot_password');
            } else {
                $this->session->set_flashdata('message', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Email Tidak Terdaftar Atau Belum Di Aktifikasi!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('forgot_password');
            }
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
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'forgot_password/reset?email=' . $email . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function reset()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('tbl_user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('tbl_user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->change();
            } else {
                $this->session->set_flashdata('message', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Reset password failed! Wrong token!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Reset password failed! Wrong email!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect('login');
        }
    }

    public function change()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('login');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[7]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[7]|matches[password1]');
        $this->form_validation->set_message('matches', 'Password Tidak Sama!');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Forgot Password - " . $this->M_Setting->tampilNamaWebsite()['isi_setting'];
            $this->load->view('v_change', $data);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('tbl_user');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('tbl_user_token', ['email' => $email]);

            $this->session->set_flashdata('message', ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> Silahkan Login Kembali.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('login');
        }
    }
}
