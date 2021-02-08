<?php

declare(strict_types=1);

namespace App\Models;

use Kenjis\CI3Compatible\Core\CI_Model;
use Kenjis\CI3Compatible\Database\CI_DB_query_builder;

/**
 * @property CI_DB_query_builder $db
 */
class Profile_model extends CI_Model
{
    public function getProfile($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }

    public function updateProfile($id, $data): void
    {
        $this->db->update('users', $data, ['id' => $id]);
    }

    public function updatePassword($id, $data)
    {
        $this->db->update('users', $data, ['id' => $id]);

        return $this->db->affected_rows();
    }
}

/* End of file Profile_model.php */
