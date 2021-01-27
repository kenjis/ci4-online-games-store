<?php

declare(strict_types=1);

defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $this->session->sess_destroy();
        redirect('home');
    }
}

/* End of file Logout.php */
