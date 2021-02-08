<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Register_model;
use Kenjis\CI3Compatible\Core\CI_Controller;
use Kenjis\CI3Compatible\Core\CI_Input;
use Kenjis\CI3Compatible\Library\CI_Form_validation;
use Kenjis\CI3Compatible\Library\CI_Session;

/**
 * @property Register_model $register
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 */
class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('register_model', 'register');
    }

    public function index(): void
    {
        $data['title']  = 'Register';
        $data['page']   = 'pages/auth/register';

        $this->load->view('layouts/app', $data);
    }

    public function register(): void
    {
        $this->form_validation->set_rules('name', 'Name', 'required', ['required' => 'Name is required']);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required'      => 'Email is required',
            'valid_email'   => 'Email not valid',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password is required']);
        $this->form_validation->set_rules('password2', 'Password confirmation', 'required|trim|matches[password]', [
            'required'      => 'Password confirmation is required',
            'matches'       => 'Password confirmation not same with password',
        ]);

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $data = [
                'name'      => $this->input->post('name'),
                'email'     => $this->input->post('email'),
                'password'  => hashEncrypt($this->input->post('password')),
                'role'      => 2,
            ];

            $this->register->register($data);
            $this->session->set_flashdata('success', 'Successfully registered, please login.');

            redirect_('login');
        }
    }
}

/* End of file Register.php */
