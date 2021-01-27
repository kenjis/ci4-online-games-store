<?php

declare(strict_types=1);

defined('BASEPATH') or exit('No direct script access allowed');

class Register_model extends CI_Model
{
    public function register($data): void
    {
        $this->db->insert('users', $data);
    }
}

/* End of file Register_model.php */
