<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Login_model;
use Kenjis\CI3Compatible\Core\CI_Controller;
use Kenjis\CI3Compatible\Core\CI_Input;
use Kenjis\CI3Compatible\Library\CI_Form_validation;
use Kenjis\CI3Compatible\Library\CI_Session;

/**
 * @property Login_model $login
 * @property CI_Form_validation $form_validation
 * @property CI_Session $session
 * @property CI_Input $input
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model', 'login');
    }

    public function index(): void
    {
        $data['title']  = 'Login';
        $data['page']   = 'pages/auth/login';

        $this->load->view('layouts/app', $data);
    }

    public function login(): void
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Wrong email or password.');
            $this->index();
        } else {
            $email      = $this->input->post('email');
            $password   = $this->input->post('password');
            $user       = $this->login->checkEmail($email);

            // Cek email
            if (isset($user)) {
                // cek password
                if (hashEncryptVerify($password, $user['password']) == true) {
                    $this->session->set_userdata($user);
                    $this->session->set_userdata('login', true);

                    redirect_('home');
                } else {
                    // Jika password salah
                    $this->session->set_flashdata('error', 'Wrong email or password.');
                    redirect_('login');
                }
            } else {
                // Jika email tidak sesuai
                $this->session->set_flashdata('error', 'Wrong email or password.');
                redirect_('login');
            }
        }
    }
}

/* End of file Login.php */
