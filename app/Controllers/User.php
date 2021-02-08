<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User_model;
use Kenjis\CI3Compatible\Core\CI_Controller;
use Kenjis\CI3Compatible\Library\CI_Session;

/**
 * @property User_model $user
 * @property CI_Session $session
 */
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin();
        $this->load->model('user_model', 'user');
    }

    public function index(): void
    {
        $data['title']  = 'Users Data';
        $data['page']   = 'pages/users/index';
        $data['users']  = $this->user->getUsers();
        $this->load->view('layouts/app', $data);
    }

    public function delete($id): void
    {
        $this->user->deleteUser($id);
        $this->session->set_flashdata('success', 'User succesfully deleted.');
        redirect_('user');
    }
}

/* End of file User.php */
