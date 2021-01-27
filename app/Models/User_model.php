<?php

declare(strict_types=1);

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getUsers()
    {
        $this->db->where('role !=', 1);

        return $this->db->get('users')->result_array();
    }

    public function deleteUser($id): void
    {
        $this->db->delete('users', ['id' => $id]);
    }
}

/* End of file User_model.php */
