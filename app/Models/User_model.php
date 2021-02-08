<?php

declare(strict_types=1);

namespace App\Models;

use Kenjis\CI3Compatible\Core\CI_Model;
use Kenjis\CI3Compatible\Database\CI_DB_query_builder;

/**
 * @property CI_DB_query_builder $db
 */
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
