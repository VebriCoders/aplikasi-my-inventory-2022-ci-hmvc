<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        //library
        $this->load->library('form_validation');
        // model
        $this->load->model('M_Login');
    }


    public function index()
    {
        $logged = $this->session->userdata('is_login');

        if ($logged != true) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == false) {
                $data['title'] = "Login - " . $this->M_Setting->tampilNamaWebsite()['isi_setting'];
                $this->load->view('v_login', $data);
            } else {
                // validasinya success
                $this->_login();
            }
        } else {
            // print_r($this->session->userdata());
            redirect('dashboard');
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tbl_user', ['email' => $email])->row_array();

        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $userdata = array(
                        'is_login' => true,
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'image' => $user['image'],
                        'role_id' => $user['role_id']
                    );
                    $this->session->set_userdata($userdata);

                    //Redirect Halaman
                    if ($user['role_id'] == 1) {
                        redirect('dashboard');
                    } else {
                        redirect('dashboard');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Password Salah!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Email Belum Aktif!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Email Tidak Terdaftar!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('login');
        }
    }

    public function logout()
    {
        // date_default_timezone_set("Asia/Bangkok");
        // $id = $this->session->userdata('id');
        // $data = [
        //     'last_logout' => date('Y-m-d  H:i:s'),
        // ];
        // $this->db->where('id', $id)->update('tbl_user', $data);

        $this->session->sess_destroy();
        redirect('login');
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('tbl_user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('tbl_user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('tbl_user');

                    $this->db->delete('tbl_user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
                    $this->session->set_flashdata('message', ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>' . $email . ' Aktif!</strong> Silahkan Login.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('login');
                } else {
                    $this->db->delete('tbl_user', ['email' => $email]);
                    $this->db->delete('tbl_user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal Aktifikasi!</strong> Token Kamu Tidak Berlaku.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('message', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Token Salah!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Email Salah!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
            redirect('login');
        }
    }
}
