<?php

declare(strict_types=1);

namespace App\Controllers;

use Kenjis\CI3Compatible\Core\CI_Controller;
use Kenjis\CI3Compatible\Library\CI_Session;

/**
 * @property CI_Session $session
 */
class Logout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $this->session->sess_destroy();
        redirect_('home');
    }
}

/* End of file Logout.php */
